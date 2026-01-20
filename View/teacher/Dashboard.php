<?php
$title = $title ?? "Teacher Dashboard";
require __DIR__ . '/../layout/header.php';
require __DIR__ . '/../layout/navbar.php';
require __DIR__ . '/../layout/sidebar.php';

$u = $_SESSION['user'] ?? [];
$profile = $profile ?? [];
$stats = $stats ?? ['topics_posted'=>0,'pending_requests'=>0];
?>

<h2>Teacher Dashboard</h2>
<p class="muted">Welcome, <?= htmlspecialchars($u['name'] ?? '') ?> (<?= htmlspecialchars($u['aiub_id'] ?? '') ?>)</p>

<div style="display:grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap:12px; margin:12px 0;">
  <div class="card">
    <div class="muted">Topics Posted</div>
    <div style="font-size:28px; font-weight:800; margin-top:6px; color: #00f;"><?= (int)$stats['topics_posted'] ?></div>
  </div>
  <div class="card">
    <div class="muted">Pending Requests</div>
    <div style="font-size:28px; font-weight:800; margin-top:6px; color: #f00;"><?= (int)$stats['pending_requests'] ?></div>
  </div>

 <!-- ✅ NEW -->
  <div class="card">
    <div class="muted">Internships Posted</div>
    <div class="value" style="font-size:28px; font-weight:800; margin-top:6px;color: #00f;"><?= (int)$internshipsPosted ?></div>
  </div>

  <div class="card">
    <div class="muted">Pending Internship Applicants</div>
    <div class="value" style="font-size:28px; font-weight:800; margin-top:6px;color: #f00;" ><?= (int)$pendingInternshipApplicants ?></div>
  </div>

</div>

<div class="card" style="margin-top:12px;">
  <div style="display:flex; justify-content:space-between; align-items:center; gap:12px;">
    <div>
      <h3 style="margin:0;">My Information</h3>
     
    </div>
    <a class="btn" href="index.php?page=teacher.update">Update Information</a>
  </div>

  <div style="display:grid; grid-template-columns: 1fr 1fr; gap:12px; margin-top:14px;">
    <div>
      <div class="muted">Email</div>
      <div><?= htmlspecialchars($u['email'] ?? '') ?></div>
    </div>
    <div>
      <div class="muted">Department</div>
      <div><?= htmlspecialchars($profile['department'] ?? '') ?></div>
    </div>

    <div>
      <div class="muted">Links</div>
      <div style="display:flex; gap:8px; flex-wrap:wrap;">
        <?php if (!empty($profile['linkedin_url'])): ?>
           <a class="btn"
   target="_blank"
   rel="noopener"
   href="<?= htmlspecialchars($profile['linkedin_url']) ?>"
   style="
     background: #6b7280 url('/aiub-portal/assets/img/link-logo.png') no-repeat 10px center;
     background-size: 40px;
     padding-left: 50px;
     color: #fff;
     text-decoration: none;
   ">
   LinkedIn
</a>
        <?php endif; ?>
        <?php if (!empty($profile['researchgate_url'])): ?>
          <a class="btn"
   target="_blank"
   rel="noopener"
   href="<?= htmlspecialchars($profile['researchgate_url']) ?>"
   style="
     background: #6b7280 url('/aiub-portal/assets/img/scholler-logo.png') no-repeat 10px center;
     background-size: 40px;
     padding-left: 50px;
     color: #fff;
     text-decoration: none;
   ">
   Google Scholar
</a>
        <?php endif; ?>
        <?php if (empty($profile['linkedin_url']) && empty($profile['researchgate_url'])): ?>
          <span class="muted">N/A</span>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>

