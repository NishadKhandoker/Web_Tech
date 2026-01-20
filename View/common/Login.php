<?php
$errors = $errors ?? [];

$msg = $_GET['msg'] ?? '';
if ($msg === 'disabled') {
  $errors[] = "Your account is disabled. Please contact the admin.";
}
if ($msg === 'reg_pending') {
  $errors[] = "Registration submitted. Please wait for admin approval.";
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>AIUB Portal Login (Unofficial)</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <?php require_once __DIR__ . '/../../core/Csrf.php'; ?>
</head>
<body>
  <div class="topbar">
    <div class="topbar-inner">
      <div class="topbar-left">AMERICAN INTERNATIONAL UNIVERSITY-BANGLADESH</div>
      <div class="topbar-right"><a href="index.php?page=home">Home</a></div>
    </div>
  </div>

  <div class="container">
    <div class="card login-card">
      <div class="brand">
        <img src="assets/img/aiub-logo.png" alt="AIUB Logo" class="logo">
        <div>
          <h1>AIUB  Research & Internship Management Portal</h1>
          <p class="muted"></p>
        </div>
      </div>

      <?php if (!empty($errors)): ?>
        <div class="alert">
          <?php foreach ($errors as $e): ?>
            <div><?= htmlspecialchars($e) ?></div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <form method="post" action="index.php?page=login.post" id="loginForm">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Csrf::token()) ?>">
        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required minlength="6">

        <button class="btn" style="display:inline-block" type="submit">Login</button>
      </form>

      <div style="margin-top:12px;">
        <a class="btn" style="background:#6b7280;display:inline-block;" href="index.php?page=role">Register</a>
        <span class="muted" style="margin-left:8px; font-size:12px;">
          New user? Create an account.
      </div>
    </div>

    <footer class="footer"> student project </footer>
  </div>
  <script src="assets/js/validation.js"></script>
</body>
</html>
