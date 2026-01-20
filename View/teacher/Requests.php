<?php
$title = $title ?? "Research Requests";
require __DIR__ . '/../layout/header.php';
require __DIR__ . '/../layout/navbar.php';
require __DIR__ . '/../layout/sidebar.php';

require_once __DIR__ . '/../../core/Csrf.php';
?>

<h2>Research Requests</h2>
<p class="muted">Teacher can download student CV & Proposal submitted with the request.</p>

<!-- Ensure CSRF token exists for AJAX on this page -->
<script>
  window.CSRF_TOKEN = "<?= htmlspecialchars(Csrf::token()) ?>";
</script>

<div class="card">
  <?php if (empty($requests)): ?>
    <p class="muted">No requests yet.</p>
  <?php else: ?>
    <table style="width:100%; border-collapse:collapse;">
      <thead>
        <tr style="text-align:left;">
          <th style="padding:10px;border-bottom:1px solid var(--border);">Student</th>
          <th style="padding:10px;border-bottom:1px solid var(--border);">Student ID</th>
          <th style="padding:10px;border-bottom:1px solid var(--border);">Topic</th>
          <th style="padding:10px;border-bottom:1px solid var(--border);">Files</th>
          <th style="padding:10px;border-bottom:1px solid var(--border);">Status</th>
          <th style="padding:10px;border-bottom:1px solid var(--border);">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($requests as $r):
          $id = (int)($r['id'] ?? 0);
        ?>
          <tr id="req-<?= $id ?>">
            <td style="padding:10px;border-bottom:1px solid var(--border);">
              <?= htmlspecialchars((string)($r['student_name'] ?? '')) ?>
            </td>

            <td style="padding:10px;border-bottom:1px solid var(--border);">
              <?= htmlspecialchars((string)($r['student_aiub_id'] ?? '')) ?>
            </td>

            <td style="padding:10px;border-bottom:1px solid var(--border);">
              <?= htmlspecialchars((string)($r['title'] ?? '')) ?>
            </td>

            <td style="padding:10px;border-bottom:1px solid var(--border);">
              <?php if (!empty($r['cv_path'])): ?>
                <a class="btn" href="download.php?type=cv&req=<?= $id ?>">CV</a>
              <?php else: ?>
                <span class="muted">No CV</span>
              <?php endif; ?>

              <?php if (!empty($r['proposal_path'])): ?>
                <a class="btn" style="margin-left:6px;background:#6b7280;" href="download.php?type=proposal&req=<?= $id ?>">Proposal</a>
              <?php else: ?>
                <span class="muted" style="margin-left:6px;">No Proposal</span>
              <?php endif; ?>
            </td>

            <td style="padding:10px;border-bottom:1px solid var(--border);" class="statusCell">
              <?= htmlspecialchars((string)($r['status'] ?? '')) ?>
            </td>

            <td style="padding:10px;border-bottom:1px solid var(--border);">
              <input
                type="text"
                id="cmt-<?= $id ?>"
                placeholder="Comment/Reason (optional)"
                style="width:220px;padding:8px;border:1px solid var(--border);border-radius:10px;margin-right:6px;"
              >

              <button class="btn actBtn" onclick="updateReq(<?= $id ?>,'accepted')">Accept</button>
              <button class="btn actBtn" style="background:#b91c1c;margin-left:6px;" onclick="updateReq(<?= $id ?>,'rejected')">Reject</button>

              <div class="muted" style="font-size:12px;margin-top:6px;display:none;" id="msg-<?= $id ?>"></div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>

<script>
async function updateReq(reqId, status){
  const row = document.getElementById("req-" + reqId);
  if(!row) return alert("Row not found");

  const comment = document.getElementById("cmt-" + reqId)?.value || "";
  const msgBox = document.getElementById("msg-" + reqId);

  // disable buttons while sending
  row.querySelectorAll(".actBtn").forEach(b => b.disabled = true);

  const out = await postJSON("index.php?page=teacher.request.update.ajax", {
    req_id: reqId,
    status: status,
    comment: comment
  });

  if(out && out.ok){
    // ✅ instant UI update
    const statusCell = row.querySelector(".statusCell");
    if(statusCell) statusCell.innerText = out.status || status;

    if(msgBox){
      msgBox.style.display = "block";
      if((out.comment || "").trim() !== ""){
        msgBox.innerHTML = "<b>Saved comment:</b> " + escapeHtml(out.comment);
      } else {
        msgBox.innerHTML = "<b>Updated.</b>";
      }
    }
  } else {
    alert((out && out.error) ? out.error : "Failed");
    // re-enable on failure
    row.querySelectorAll(".actBtn").forEach(b => b.disabled = false);
  }
}

function escapeHtml(str){
  return String(str || "")
    .replaceAll("&","&amp;")
    .replaceAll("<","&lt;")
    .replaceAll(">","&gt;")
    .replaceAll('"',"&quot;")
    .replaceAll("'","&#039;");
}
</script>

<?php require __DIR__ . '/../layout/footer.php'; ?>
