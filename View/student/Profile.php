<?php
$title = "Student Profile";
$errors = $errorsForView ?? [];
$profile = $profile ?? [];

require __DIR__ . '/../layout/header.php';
require __DIR__ . '/../layout/navbar.php';
require __DIR__ . '/../layout/sidebar.php';

$u = $_SESSION['user'] ?? [];
?>

<h2>Student Profile</h2>
<p class="muted">
  Welcome, <?= htmlspecialchars($u['name'] ?? '') ?> (<?= htmlspecialchars($u['aiub_id'] ?? '') ?>)
</p>

<?php if ($errors): ?>
  <div class="alert">
    <?php foreach ($errors as $e): ?><div><?= htmlspecialchars($e) ?></div><?php endforeach; ?>
  </div>
<?php endif; ?>

<div class="card">
  <h3 style="margin-top:0;">Documents</h3>

  

  <form method="post" action="index.php?page=student.upload.post" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Csrf::token()) ?>">

    <!-- CV -->
    <label style="display:block;margin-top:10px;">
     <b>CV (PDF)</b>  <span class="muted">(Max 5MB)</span>
    </label>
    <div class="muted" style="font-size:12px; margin:6px 0 8px 0;">
      ✅ Update your CV here if your CV changes (this CV will be attached with your supervision requests).
    </div>
    <input type="file" name="cv_file" accept="application/pdf">

    <?php if (!empty($profile['cv_path'])): ?>
      
    <?php else: ?>
      <div class="muted" style="margin-top:8px;">No CV uploaded yet.</div>
    <?php endif; ?>

    <!-- Proposal -->
    <label style="display:block;margin-top:18px;">
      <b>Proposal (PDF)</b> <span class="muted">(Optional)</span>
    </label>
    
    <input type="file" name="proposal_file" accept="application/pdf">

    <?php if (!empty($profile['proposal_path'])): ?>
      
    <?php else: ?>
      <div class="muted" style="margin-top:8px;">No profile proposal uploaded.</div>
    <?php endif; ?>

    <div style="margin-top:18px;">
      <button class="btn" type="submit">Save / Update Files</button>
    </div>
  </form>
</div>



<?php require __DIR__ . '/../layout/footer.php'; ?>
