<?php
$title = $title ?? "Update Information";
require __DIR__ . '/../layout/header.php';
require __DIR__ . '/../layout/navbar.php';
require __DIR__ . '/../layout/sidebar.php';

$u = $_SESSION['user'] ?? [];
$profile = $profile ?? ['major'=>'','cgpa'=>'','credits_completed'=>''];
$errorsForView = $errorsForView ?? [];
?>

<h2>Update Information</h2>
<p class="muted">You can update only: Password, Major, CGPA, Credits Completed.</p>

<div class="card">
  <?php if (!empty($errorsForView)): ?>
    <div class="alert">
      <?php foreach ($errorsForView as $e): ?><div><?= htmlspecialchars($e) ?></div><?php endforeach; ?>
    </div>
  <?php endif; ?>

  <form method="post" action="index.php?page=student.update.post" id="studentUpdateForm">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Csrf::token()) ?>">

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
      <div>
        <label>Major</label>
        <input type="text" name="major" required value="<?= htmlspecialchars((string)($profile['major'] ?? '')) ?>">
      </div>
      <div>
        <label>CGPA</label>
        <input type="text" name="cgpa" required value="<?= htmlspecialchars((string)($profile['cgpa'] ?? '')) ?>" placeholder="e.g., 3.75">
      </div>
      <div>
        <label>Credits Completed</label>
        <input type="number" name="credits_completed" required min="0" max="200"
               value="<?= htmlspecialchars((string)($profile['credits_completed'] ?? '')) ?>">
      </div>
    </div>

    <hr style="margin:14px 0;border:none;border-top:1px solid var(--border);">

    <p class="muted" style="margin-top:0;">Change password (optional). Leave blank to keep current password.</p>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
      <div>
        <label>New Password</label>
        <input type="password" name="password" minlength="8" placeholder="Minimum 8 characters">
      </div>
      <div>
        <label>Confirm Password</label>
        <input type="password" name="confirm_password" minlength="8">
      </div>
    </div>

    <div style="margin-top:14px;display:flex;gap:10px;">
      <button class="btn" type="submit">Save Changes</button>
      <a class="btn" style="background:#6b7280;" href="index.php?page=student.dashboard">Cancel</a>
    </div>
  </form>
</div>

<script>
document.getElementById('studentUpdateForm').addEventListener('submit', function(e){
  const p = this.password.value.trim();
  const c = this.confirm_password.value.trim();
  if ((p !== '' || c !== '') && p !== c) {
    e.preventDefault();
    alert("Confirm password does not match.");
  }
});
</script>

<?php require __DIR__ . '/../layout/footer.php'; ?>
