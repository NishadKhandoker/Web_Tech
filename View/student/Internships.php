<?php
$title = "Browse Internships";
require __DIR__ . '/../layout/header.php';
require __DIR__ . '/../layout/navbar.php';
require __DIR__ . '/../layout/sidebar.php';
?>

<h2>Browse Internships</h2>


<div class="card" style="margin-bottom:12px;">
  <div style="display:flex; gap:12px; flex-wrap:wrap; align-items:flex-end;">
    <div style="flex:1; min-width:220px;">
      <label>Search (Title / Company / Requirements)</label>
      <input type="text" id="internQ" placeholder="Type to search..." style="width:100%;">
    </div>

    <div style="min-width:220px;">
      <label>Filter</label>
      <select id="internFilter" style="width:100%;padding:10px;border:1px solid var(--border);border-radius:10px;">
        <option value="all">All</option>
        <option value="applied">Applied</option>
        <option value="not_applied">Not Applied</option>
      </select>
    </div>

    <div class="muted" id="internCount" style="min-width:140px;"></div>
  </div>
</div>

<div class="card">
  <table style="width:100%; border-collapse:collapse;">
    <thead>
      <tr style="text-align:left;">
        <th style="padding:10px;border-bottom:1px solid var(--border);">Title</th>
        <th style="padding:10px;border-bottom:1px solid var(--border);">Company</th>
        <th style="padding:10px;border-bottom:1px solid var(--border);">Deadline</th>
        <th style="padding:10px;border-bottom:1px solid var(--border);">Posted By</th>
        <th style="padding:10px;border-bottom:1px solid var(--border);">Requirements</th>
        <th style="padding:10px;border-bottom:1px solid var(--border);">Circular</th>
        <th style="padding:10px;border-bottom:1px solid var(--border);">Apply Link</th>
        <th style="padding:10px;border-bottom:1px solid var(--border);">Action</th>
      </tr>
    </thead>

    <tbody id="internBody">
      <?php if (empty($internships)): ?>
        <tr><td colspan="8" class="muted" style="padding:12px;">No internships available.</td></tr>
      <?php else: ?>
        <?php foreach ($internships as $i):
          $id = (int)($i['id'] ?? 0);
          $applied = !empty($i['applied_id']);
          $applyLink = trim((string)($i['apply_link'] ?? ''));
        ?>
          <tr id="row-<?= $id ?> ">
            <td style="padding:10px;border-bottom:1px solid var(--border);"><?= htmlspecialchars((string)($i['title'] ?? '')) ?></td>
            <td style="padding:10px;border-bottom:1px solid var(--border);"><?= htmlspecialchars((string)($i['company'] ?? '')) ?></td>
            <td style="padding:10px;border-bottom:1px solid var(--border);"><?= htmlspecialchars((string)($i['deadline'] ?? '')) ?></td>

            <td style="padding:10px;border-bottom:1px solid var(--border);">
              <?= htmlspecialchars((string)($i['poster_name'] ?? '')) ?>
              <span class="muted">(<?= htmlspecialchars((string)($i['poster_aiub_id'] ?? '')) ?>)</span>
              <div class="muted" style="font-size:12px;">
                <?= htmlspecialchars(strtoupper((string)($i['poster_role'] ?? ''))) ?>
              </div>
            </td>

            <td style="padding:10px;border-bottom:1px solid var(--border);">
              <div style="max-width:420px; white-space:pre-wrap; line-height:1.4;">
                <?= htmlspecialchars((string)($i['requirements'] ?? '')) ?>
              </div>
            </td>

            <td style="padding:10px;border-bottom:1px solid var(--border);">
              <?php if (!empty($i['circular_path'])): ?>
                <a class="btn" style="background:#6b7280;" href="download.php?type=circular&internship=<?= $id ?>">Download</a>
              <?php else: ?>
                <span class="muted">N/A</span>
              <?php endif; ?>
            </td>

            <td style="padding:10px;border-bottom:1px solid var(--border);">
              <?php if ($applyLink !== '' && filter_var($applyLink, FILTER_VALIDATE_URL)): ?>
                <a class="btn" target="_blank" rel="noopener noreferrer" href="<?= htmlspecialchars($applyLink) ?>">Open</a>
              <?php else: ?>
                <span class="muted">N/A</span>
              <?php endif; ?>
            </td>

            <td style="padding:10px;border-bottom:1px solid var(--border);" class="actionCell">
              <?php if ($applied): ?>
                <span class="muted">Applied ✅</span>
              <?php else: ?>
                <button class="btn" onclick="applyInternship(<?= $id ?>)">Apply</button>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<script>
let internTimer = null;

function updateInternCount(n){
  const el = document.getElementById("internCount");
  if(el) el.textContent = "Showing: " + n;
}

async function runInternSearch(){
  const q = document.getElementById("internQ")?.value || "";
  const filter = document.getElementById("internFilter")?.value || "all";

  const res = await postJSON("index.php?page=student.internships.search.ajax", { q, filter });
  if(res.ok){
    document.getElementById("internBody").innerHTML = res.html || "";
    updateInternCount(res.count ?? 0);
  } else {
    alert(res.error || "Failed");
  }
}

document.getElementById("internQ")?.addEventListener("input", () => {
  clearTimeout(internTimer);
  internTimer = setTimeout(runInternSearch, 250);
});
document.getElementById("internFilter")?.addEventListener("change", runInternSearch);

async function applyInternship(internshipId){
  const out = await postJSON("index.php?page=student.apply.ajax", { internship_id: internshipId });
  if(out.ok){
    const cell = document.querySelector("#row-"+internshipId+" .actionCell");
    if(cell) cell.innerHTML = '<span class="muted">Applied ✅</span>';
  } else {
    alert(out.error || "Failed");
  }
}
</script>

<?php require __DIR__ . '/../layout/footer.php'; ?>
