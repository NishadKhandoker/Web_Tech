<?php
$title = "Post Internship";
$errors = $errorsForView ?? [];
require __DIR__ . '/../layout/header.php';
require __DIR__ . '/../layout/navbar.php';
require __DIR__ . '/../layout/sidebar.php';
?>

<h2>Post Internship</h2>
<p class="muted">Post an internship opportunity for AIUB students.</p>

<?php if ($errors): ?>
  <div class="alert">
    <?php foreach ($errors as $e): ?><div><?= htmlspecialchars($e) ?></div><?php endforeach; ?>
  </div>
<?php endif; ?>

<div class="card">
  <form method="post" action="index.php?page=alumni.internship.store" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Csrf::token()) ?>">

    <label>Title</label>
    <input type="text" name="title" required minlength="3">

    <label style="margin-top:10px;">Company</label>
    <input type="text" name="company" required minlength="2">

    <label style="margin-top:10px;">Requirements</label>
    <textarea name="requirements" rows="3" required minlength="5"
      style="width:100%;padding:10px;border:1px solid var(--border);border-radius:10px;"></textarea>

    <label style="margin-top:10px;">Internship Circular (PDF, max 5MB) (optional)</label>
    <input type="file" name="circular_file" accept="application/pdf">

    <label style="margin-top:10px;">Apply Link (optional)</label>
    <input type="url" name="apply_link" placeholder="https://example.com/apply">

    <label style="margin-top:10px;">Deadline</label>
    <input type="date" name="deadline" required>

    <div style="margin-top:14px;">
      <button class="btn" type="submit">Publish Internship</button>
      <a class="btn" style="background:#6b7280;margin-left:8px;" href="index.php?page=alumni.dashboard">Cancel</a>
    </div>
  </form>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
