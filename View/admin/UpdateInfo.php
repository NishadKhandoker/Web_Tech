<?php
$title = $title ?? "Update Information";
require __DIR__ . '/../layout/header.php';
require __DIR__ . '/../layout/navbar.php';
require __DIR__ . '/../layout/sidebar.php';

$errorsForView = $errorsForView ?? [];
?>

<h2>Update Admin Information</h2>
<p class="muted">Admin can only update password.</p>

<?php if (!empty($errorsForView)): ?>
  <div class="alert">
    <?php foreach ($errorsForView as $e): ?>
      <div><?= htmlspecialchars($e) ?></div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<div class="card" style="max-width:520px;">
  <form method="post" action="index.php?page=admin.update.post">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Csrf::token()) ?>">

    <label>New Password</label>
    <input type="password" name="password" minlength="8" required>

    <label>Confirm Password</label>
    <input type="password" name="confirm_password" minlength="8" required>

    <button class="btn" type="submit">Update Password</button>
  </form>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
