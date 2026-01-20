<?php
$title = $title ?? "Update Information";
require __DIR__ . '/../layout/header.php';
require __DIR__ . '/../layout/navbar.php';
require __DIR__ . '/../layout/sidebar.php';

$errorsForView = $errorsForView ?? [];
?>

<h2>Update Information</h2>
<p class="muted">Teacher can update only password.</p>

<div class="card">
  <?php if (!empty($errorsForView)): ?>
    <div class="alert">
      <?php foreach ($errorsForView as $e): ?><div><?= htmlspecialchars($e) ?></div><?php endforeach; ?>
    </div>
  <?php endif; ?>

  <form method="post" action="index.php?page=teacher.update.post" id="teacherUpdateForm">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Csrf::token()) ?>">

    <label>New Password</label>
    <input type="password" name="password" minlength="8" required>

    <label>Confirm Password</label>
    <input type="password" name="confirm_password" minlength="8" required>

    <div style="margin-top:14px;display:flex;gap:10px;">
      <button class="btn" type="submit">Save Changes</button>
      <a class="btn" style="background:#6b7280;" href="index.php?page=teacher.dashboard">Cancel</a>
    </div>
  </form>
</div>

<script>
document.getElementById('teacherUpdateForm').addEventListener('submit', function(e){
  if (this.password.value !== this.confirm_password.value) {
    e.preventDefault();
    alert("Confirm password does not match.");
  }
});
</script>

<?php require __DIR__ . '/../layout/footer.php'; ?>
