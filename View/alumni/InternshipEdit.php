<?php
$title = $title ?? "Edit Internship";
$errors = $errorsForView ?? [];
$in = $internship ?? [];

require __DIR__ . '/../layout/header.php';
require __DIR__ . '/../layout/navbar.php';
require __DIR__ . '/../layout/sidebar.php';
?>

<h2>Edit Internship</h2>

<?php if ($errors): ?>
  <div class="alert">
    <?php foreach ($errors as $e): ?><div><?= htmlspecialchars($e) ?></div><?php endforeach; ?>
  </div>
<?php endif; ?>

<div class="card">
  <form method="post" action="index.php?page=alumni.internship.update" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Csrf::token()) ?>">
    <input type="hidden" name="id" value="<?= (int)($in['id'] ?? 0) ?>">

    <label>Title</label>
    <input type="text" name="title" required minlength="3" value="<?= htmlspecialchars($in['title'] ?? '') ?>">

    <label style="margin-top:10px;">Company</label>
    <input type="text" name="company" required minlength="2" value="<?= htmlspecialchars($in['company'] ?? '') ?>">

    <label style="margin-top:10px;">Requirements</label>
    <textarea name="requirements" rows="5" required minlength="5"
      style="width:100%;padding:10px;border:1px solid var(--border);border-radius:10px;"><?= htmlspecialchars($in['requirements'] ?? '') ?></textarea>

    <label style="margin-top:10px;">Deadline</label>
    <input type="date" name="deadline" required value="<?= htmlspecialchars($in['deadline'] ?? '') ?>">

    <label style="margin-top:10px;">Replace Circular (PDF, max 5MB) (optional)</label>
    <input type="file" name="circular_file" accept="application/pdf">

    <?php if (!empty($in['circular_path'])): ?>
      <div style="margin-top:8px;">
        <a class="btn" style="background:#6b7280;" href="download.php?type=proposal&file=internship&id=<?= (int)$in['id'] ?>">Download Current Circular</a>
        <span class="muted" style="margin-left:8px; font-size:12px;">
          Saved: <?= htmlspecialchars(basename($in['circular_path'])) ?>
        </span>
      </div>
    <?php endif; ?>

    <div style="margin-top:14px;">
      <button class="btn" type="submit">Update</button>
      <a class="btn" style="background:#6b7280;margin-left:8px;" href="index.php?page=alumni.internship.list">Cancel</a>
    </div>
  </form>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
