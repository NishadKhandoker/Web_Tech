<?php
$title = "Post Internship";
$errors = $errorsForView ?? [];
require __DIR__ . '/../layout/header.php';
require __DIR__ . '/../layout/navbar.php';
require __DIR__ . '/../layout/sidebar.php';
?>
<h2>Post Internship Opportunity</h2>
<?php if ($errors): ?>
  <div class="alert"><?php foreach ($errors as $e): ?><div><?= htmlspecialchars($e) ?></div><?php endforeach; ?></div>
<?php endif; ?>
<div class="card">
  <form method="post" action="index.php?page=alumni.internship.store" id="internshipForm">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Csrf::token()) ?>">
    <label>Title</label>
    <input type="text" name="title" required minlength="5" placeholder="e.g., Cybersecurity Intern">
    <label>Company</label>
    <input type="text" name="company" required placeholder="e.g., ABC Tech Ltd.">
    <label>Requirements</label>
    <input type="text" name="requirements" required minlength="10" placeholder="e.g., Linux, networking, teamwork">
    <label>Deadline</label>
    <input type="date" name="deadline" required>
    <button class="btn" type="submit">Publish Internship</button>
  </form>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>
