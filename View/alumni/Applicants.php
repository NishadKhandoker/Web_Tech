<?php
$title = "Applicants";
require __DIR__ . '/../layout/header.php';
require __DIR__ . '/../layout/navbar.php';
require __DIR__ . '/../layout/sidebar.php';
?>
<h2>Applicants</h2>
<p class="muted">List of student who applied for internships.</p>

<div class="card">
  <?php if (empty($apps)): ?>
    <p class="muted">No applications yet.</p>
  <?php else: ?>
    <table style="width:100%; border-collapse:collapse;">
      <thead>
        <tr style="text-align:left;">
          <th style="padding:10px;border-bottom:1px solid var(--border);">Student</th>
          <th style="padding:10px;border-bottom:1px solid var(--border);">Student ID</th>
          <th style="padding:10px;border-bottom:1px solid var(--border);">Internship</th>
          <th style="padding:10px;border-bottom:1px solid var(--border);">CV</th>
          <th style="padding:10px;border-bottom:1px solid var(--border);">Status</th>
          <th style="padding:10px;border-bottom:1px solid var(--border);">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($apps as $a):
          $appId = (int)$a['app_id'];
        ?>
          <tr id="row-<?= $appId ?>">
            <td style="padding:10px;border-bottom:1px solid var(--border);"><?= htmlspecialchars($a['student_name']) ?></td>
            <td style="padding:10px;border-bottom:1px solid var(--border);"><?= htmlspecialchars($a['student_aiub_id']) ?></td>
            <td style="padding:10px;border-bottom:1px solid var(--border);"><?= htmlspecialchars($a['internship_title']) ?></td>

            <td style="padding:10px;border-bottom:1px solid var(--border);">
              <?php if (!empty($a['cv_path'])): ?>
                <a class="btn" href="download.php?type=cv&app=<?= $appId ?>">Download CV</a>
              <?php else: ?>
                <span class="muted">No CV</span>
              <?php endif; ?>
            </td>

            <td style="padding:10px;border-bottom:1px solid var(--border);" class="status">
              <?= htmlspecialchars($a['status']) ?>
            </td>

            <td style="padding:10px;border-bottom:1px solid var(--border);">
              <button class="btn" onclick="updateApp(<?= $appId ?>,'shortlisted')">Shortlist</button>
              <button class="btn" style="background:#b91c1c;margin-left:6px;" onclick="updateApp(<?= $appId ?>,'rejected')">Reject</button>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>

<script>
async function updateApp(appId, status){
  const out = await postJSON("index.php?page=alumni.applicant.update.ajax", { app_id: appId, status });
  if(out.ok){
    document.querySelector("#row-"+appId+" .status").innerText = status;
  } else {
    alert(out.error || "Failed");
  }
}
</script>

<?php require __DIR__ . '/../layout/footer.php'; ?>
