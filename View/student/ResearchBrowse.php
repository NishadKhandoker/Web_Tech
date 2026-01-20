<?php
$title = $title ?? "Browse Research Topics";
require __DIR__ . '/../layout/header.php';
require __DIR__ . '/../layout/navbar.php';
require __DIR__ . '/../layout/sidebar.php';
?>

<h2>Browse Research Topics</h2>


<?php if (empty($hasCv)): ?>
  <div class="alert" style="border-color:#fca5a5;color:#7f1d1d;">
    You must upload your <b>CV (PDF)</b> first from <b>Profile</b>, otherwise you cannot request a supervisor.
    <div style="margin-top:10px;">
      <a class="btn" href="index.php?page=student.profile">Go to Profile</a>
    </div>
  </div>
<?php endif; ?>

<div class="card" style="margin-bottom:12px;">
  <div style="display:flex; gap:12px; flex-wrap:wrap; align-items:flex-end;">
    <div style="flex:1; min-width:220px;">
      <label>Search (Topic / Domain)</label>
      <input type="text" id="topicQ" placeholder="Type to search..." style="width:100%;">
    </div>

    <div style="min-width:220px;">
      <label>Filter</label>
      <select id="topicFilter" style="width:100%;padding:10px;border:1px solid var(--border);border-radius:10px;">
        <option value="all">All</option>
        <option value="not_requested">Not requested yet</option>
      </select>
    </div>

    <div class="muted" id="topicCount" style="min-width:140px;"></div>
  </div>
</div>

<div id="topicList">
  <?php if (empty($topics)): ?>
    <div class="card"><p class="muted">No research topics available now.</p></div>
  <?php else: ?>
    <?php foreach ($topics as $t):
      $id = (int)$t['id'];
      $status = $requestMap[$id] ?? null;
    ?>
      <div class="card" style="margin-bottom:20px; border-color: blue;">
        <div style="display:flex;justify-content:space-between;gap:12px;flex-wrap:wrap;">
          <div>
            <h3 style="margin:0;color: rgb(255, 64, 0)"><?= htmlspecialchars($t['title']) ?></h3>
            <div class="muted" style="margin-top:6px;">
              Domain: <b><?= htmlspecialchars($t['domain']) ?></b> •
              Teacher: <?= htmlspecialchars($t['teacher_name']) ?> (<?= htmlspecialchars($t['teacher_aiub_id']) ?>)
            </div>
          </div>

          <div class="actionCell" id="action-<?= $id ?>" style="min-width:280px;">
            <?php if ($status): ?>
              <span class="muted">Requested: <?= htmlspecialchars($status) ?></span>
            <?php else: ?>
              <div style="display:flex; flex-direction:column; gap:8px;">
                <button class="btn" type="button" onclick="openProposalPicker(<?= $id ?>)" <?= empty($hasCv) ? 'disabled' : '' ?>>
                  Upload Proposal (PDF)
                </button>

                <input type="file"
                       id="proposalFile-<?= $id ?>"
                       accept="application/pdf"
                       style="display:none"
                       onchange="onProposalSelected(<?= $id ?>)" />

                <div id="info-<?= $id ?>" class="muted" style="font-size:12px; line-height:1.4;">
                  Upload proposal for this topic (max 5MB). Your CV will be taken from Profile.
                </div>

                <button class="btn"
                        id="reqBtn-<?= $id ?>"
                        type="button"
                        style="display:none"
                        onclick="sendRequest(<?= $id ?>)"
                        <?= empty($hasCv) ? 'disabled' : '' ?>>
                  Request Supervisor
                </button>
              </div>
            <?php endif; ?>
          </div>
        </div>

        <div style="margin-top:12px;background:#fff;border:1px solid var(--border);border-radius:10px;padding:12px;">
          <div style="font-weight:700;margin-bottom:6px;">Description</div>
          <div style="white-space:pre-wrap; line-height:1.5;">
            <?= htmlspecialchars($t['description']) ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>

<script>
let topicTimer = null;

function updateTopicCount(n){
  const el = document.getElementById("topicCount");
  if(el) el.textContent = "Showing: " + n;
}

async function runTopicSearch(){
  const q = document.getElementById("topicQ")?.value || "";
  const filter = document.getElementById("topicFilter")?.value || "all";

  const res = await postJSON("index.php?page=student.research.search.ajax", { q, filter });
  if(res.ok){
    document.getElementById("topicList").innerHTML = res.html || "";
    updateTopicCount(res.count ?? 0);
  } else {
    alert(res.error || "Failed");
  }
}

document.getElementById("topicQ")?.addEventListener("input", () => {
  clearTimeout(topicTimer);
  topicTimer = setTimeout(runTopicSearch, 250);
});
document.getElementById("topicFilter")?.addEventListener("change", runTopicSearch);

// keep your existing functions (they still work after dynamic HTML injection)
function openProposalPicker(postId){
  const input = document.getElementById("proposalFile-" + postId);
  if(input) input.click();
}

function onProposalSelected(postId){
  const input = document.getElementById("proposalFile-" + postId);
  const file = input?.files?.[0];
  const info = document.getElementById("info-" + postId);
  const btn  = document.getElementById("reqBtn-" + postId);

  if(!file){
    info.innerText = "Upload proposal for this topic (max 5MB). Your CV will be taken from Profile.";
    btn.style.display = "none";
    return;
  }

  if(file.size > 5 * 1024 * 1024){
    alert("Proposal must be <= 5MB.");
    input.value = "";
    btn.style.display = "none";
    return;
  }
  if(!file.name.toLowerCase().endsWith(".pdf")){
    alert("Only PDF allowed.");
    input.value = "";
    btn.style.display = "none";
    return;
  }

  info.innerHTML = "✅ Proposal selected: <b>" + escapeHtml(file.name) + "</b><br>✅ Your CV will be taken from your Profile.";
  btn.style.display = "inline-block";
}

async function sendRequest(postId){
  const input = document.getElementById("proposalFile-" + postId);
  const file = input?.files?.[0];
  if(!file){
    alert("Please upload/select a Proposal PDF first.");
    return;
  }

  const fd = new FormData();
  fd.append("research_post_id", postId);
  fd.append("proposal_file", file);

  const res = await postFormData("index.php?page=student.research.request.ajax", fd);

  if(res.ok){
    document.getElementById("action-" + postId).innerHTML =
      '<span class="muted">Requested: pending</span>';
  }else{
    alert(res.error || "Failed");
  }
}

function escapeHtml(str){
  return String(str).replace(/[&<>"']/g, s => ({
    "&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#039;"
  }[s]));
}
</script>

<?php require __DIR__ . '/../layout/footer.php'; ?>
