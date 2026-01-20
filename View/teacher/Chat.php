<?php
$title    = $title ?? "Chat";
$group    = $group ?? null;
$messages = $messages ?? [];
$me       = $_SESSION['user'] ?? [];
$meId     = (int)($me['id'] ?? 0);

$groupId = (int)($_GET['group_id'] ?? ($group['id'] ?? 0));

require __DIR__ . '/../layout/header.php';
require __DIR__ . '/../layout/navbar.php';
require __DIR__ . '/../layout/sidebar.php';

$lastId = 0;
foreach ($messages as $m) {
  $mid = (int)($m['id'] ?? 0);
  if ($mid > $lastId) $lastId = $mid;
}

function renderMessageRow(array $m, int $meId): string {
  $senderId   = (int)($m['sender_id'] ?? 0);
  $isMine     = ($senderId === $meId);

  $senderName = (string)($m['sender_name'] ?? 'Unknown');
  $senderRole = strtoupper((string)($m['sender_role'] ?? ''));
  $text       = (string)($m['message'] ?? '');
  $time       = (string)($m['created_at'] ?? '');

  $wrapStyle  = $isMine
    ? 'display:flex;justify-content:flex-end;'
    : 'display:flex;justify-content:flex-start;';

  $bubbleStyle = $isMine
    ? 'max-width:70%; background:#dcfce7; color:#14532d; border:1px solid #86efac; padding:10px 12px; border-radius:14px;'
    : 'max-width:70%; background:#f3f4f6; color:#111827; border:1px solid var(--border); padding:10px 12px; border-radius:14px;';

  $out  = '<div style="'.$wrapStyle.' margin:8px 0;">';
  $out .= '  <div style="'.$bubbleStyle.'">';
  $out .= '    <div style="font-size:12px; font-weight:700; margin-bottom:4px;">'
        . htmlspecialchars($senderName)
        . ' <span class="muted" style="font-weight:600;">(' . htmlspecialchars($senderRole) . ')</span>'
        . '</div>';
  $out .= '    <div style="white-space:pre-wrap; line-height:1.4;">' . htmlspecialchars($text) . '</div>';
  $out .= '    <div class="muted" style="font-size:11px; margin-top:6px;">' . htmlspecialchars($time) . '</div>';
  $out .= '  </div>';
  $out .= '</div>';

  return $out;
}
?>

<h2>Chat</h2>

<?php if (!$groupId || empty($group)): ?>
  <div class="card"><p class="muted">Group not found or you don’t have access.</p></div>
  <?php require __DIR__ . '/../layout/footer.php'; exit; ?>
<?php endif; ?>

<div class="card" style="margin-bottom:12px;">
  <div style="display:flex; justify-content:space-between; align-items:center; gap:12px; flex-wrap:wrap;">
    <div>
      <div class="muted" style="font-size:12px;">Group</div>
      <div style="font-size:18px; font-weight:800;"><?= htmlspecialchars((string)($group['group_name'] ?? '')) ?></div>
    </div>
    <a class="btn" style="background:#6b7280;" href="index.php?page=teacher.messages">Back</a>
  </div>
</div>

<div class="card">
  <div id="chatBox" style="height:420px; overflow:auto; border:1px solid var(--border); border-radius:12px; padding:12px; background:#fff;">
    <div id="chatMessages">
      <?php if (empty($messages)): ?>
        <div class="muted" style="padding:12px;">No messages yet.</div>
      <?php else: ?>
        <?php foreach ($messages as $m): ?>
          <?= renderMessageRow($m, $meId) ?>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>

  <div style="margin-top:12px; display:flex; gap:10px; align-items:flex-start;">
    <textarea id="msgText" placeholder="Type a message..."
      style="flex:1; min-height:48px; max-height:120px; resize:vertical; padding:10px; border:1px solid var(--border); border-radius:12px;"></textarea>
    <button class="btn" type="button" onclick="sendMsg()">Send</button>
  </div>

  <div id="sendInfo" class="muted" style="margin-top:8px; font-size:12px;"></div>
</div>

<script>
const GROUP_ID = <?= (int)$groupId ?>;
let afterId = <?= (int)$lastId ?>;
let timer = null;

function scrollToBottom(){
  const box = document.getElementById("chatBox");
  if(!box) return;
  box.scrollTop = box.scrollHeight;
}
function isNearBottom(){
  const box = document.getElementById("chatBox");
  if(!box) return true;
  return (box.scrollHeight - box.scrollTop - box.clientHeight) < 80;
}

function escapeHtml(str){
  return String(str)
    .replaceAll('&','&amp;')
    .replaceAll('<','&lt;')
    .replaceAll('>','&gt;')
    .replaceAll('"','&quot;')
    .replaceAll("'","&#039;");
}

function renderMsg(m){
  const isMine = (parseInt(m.sender_id,10) === <?= (int)$meId ?>);

  const wrapStyle = isMine ? 'display:flex;justify-content:flex-end;' : 'display:flex;justify-content:flex-start;';
  const bubbleStyle = isMine
    ? 'max-width:70%; background:#dcfce7; color:#14532d; border:1px solid #86efac; padding:10px 12px; border-radius:14px;'
    : 'max-width:70%; background:#f3f4f6; color:#111827; border:1px solid var(--border); padding:10px 12px; border-radius:14px;';

  return `
    <div style="${wrapStyle} margin:8px 0;">
      <div style="${bubbleStyle}">
        <div style="font-size:12px; font-weight:700; margin-bottom:4px;">
          ${escapeHtml(m.sender_name)} <span class="muted" style="font-weight:600;">(${escapeHtml(String(m.sender_role).toUpperCase())})</span>
        </div>
        <div style="white-space:pre-wrap; line-height:1.4;">${escapeHtml(m.message)}</div>
        <div class="muted" style="font-size:11px; margin-top:6px;">${escapeHtml(m.created_at)}</div>
      </div>
    </div>
  `;
}

async function poll(){
  try{
    const nearBottom = isNearBottom();
    const res = await postJSON("index.php?page=teacher.chat.fetch.ajax", {
      group_id: GROUP_ID,
      after_id: afterId
    });
    if(!res.ok) return;

    if(Array.isArray(res.messages) && res.messages.length){
      const container = document.getElementById("chatMessages");
      // remove "No messages yet"
      const firstMuted = container.querySelector(".muted");
      if(firstMuted && firstMuted.textContent.includes("No messages yet")) container.innerHTML = "";

      res.messages.forEach(m => {
        container.insertAdjacentHTML("beforeend", renderMsg(m));
        const mid = parseInt(m.id, 10);
        if(mid > afterId) afterId = mid;
      });

      if(nearBottom) scrollToBottom();
    }
  }catch(e){}
}

async function sendMsg(){
  const textEl = document.getElementById("msgText");
  const infoEl = document.getElementById("sendInfo");
  const msg = (textEl.value || "").trim();

  if(msg === ""){
    infoEl.textContent = "Type something first.";
    return;
  }

  infoEl.textContent = "Sending...";
  const out = await postJSON("index.php?page=teacher.chat.send.ajax", {
    group_id: GROUP_ID,
    message: msg
  });

  if(out.ok){
    textEl.value = "";
    infoEl.textContent = "";
    await poll(); // quick refresh
    scrollToBottom();
  }else{
    infoEl.textContent = "";
    alert(out.error || "Failed");
  }
}

scrollToBottom();
poll();
timer = setInterval(poll, 2000);
</script>

<?php require __DIR__ . '/../layout/footer.php'; ?>
