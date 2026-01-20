<?php $errors = $errors ?? []; ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Student Registration</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <?php require_once __DIR__ . '/../../core/Csrf.php'; ?>
</head>
<body>
<div class="topbar">
  <div class="topbar-inner">
    <div class="topbar-left">AMERICAN INTERNATIONAL UNIVERSITY-BANGLADESH</div>
    <div class="topbar-right"><a href="index.php?page=login">Login</a></div>
  </div>
</div>

<div class="container">
  <div class="card">
    <h2>Student Registration</h2>
    <p class="muted">After submission, wait for admin approval.</p>

    <?php if (!empty($errors)): ?>
      <div class="alert">
        <?php foreach ($errors as $e): ?><div><?= htmlspecialchars($e) ?></div><?php endforeach; ?>
      </div>
    <?php endif; ?>

    <form method="post" action="index.php?page=register.student.post">
      <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Csrf::token()) ?>">

      <label>Name</label>
      <input type="text" name="name" required>

      <label>AIUB ID</label>
      <input type="text" name="aiub_id" required>

      <label>Email (Login Email)</label>
      <input type="email" name="email" required>

      <label>Password</label>
      <input type="password" name="password" required minlength="6">

      <label>Confirm Password</label>
      <input type="password" name="confirm_password" required minlength="6">

      <label>Department</label>
      <input type="text" name="department" required>

      <label>Major</label>
      <input type="text" name="major" required>

      <label>CGPA</label>
      <input type="text" name="cgpa" placeholder="e.g., 3.75" required>

      <label>Credits Completed</label>
      <input type="number" name="credits_completed" min="0" required>

      <label>LinkedIn URL (optional)</label>
      <input type="text" name="linkedin_url" placeholder="https://...">

      <label>ResearchGate URL (optional)</label>
      <input type="text" name="researchgate_url" placeholder="https://...">

      <button class="btn" type="submit">Submit Registration</button>
      <a class="btn" style="margin-left:10px;background:#6b7280;" href="index.php?page=role">Back</a>
    </form>
  </div>
</div>
</body>
</html>
