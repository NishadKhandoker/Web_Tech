<?php
require_once __DIR__ . '/../../core/Csrf.php';
$title = $title ?? 'AIUB Portal ';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= htmlspecialchars($title) ?></title>
  <link rel="stylesheet" href="assets/css/style.css">
  <script>
    window.CSRF_TOKEN = "<?= htmlspecialchars(Csrf::token()) ?>";
  </script>

</head>
<body>
<div class="topbar">
  <div class="topbar-inner">
    <div class="topbar-left">AMERICAN INTERNATIONAL UNIVERSITY-BANGLADESH</div>
    <div class="topbar-right">
      <a href="index.php?page=home">Home</a>
      <?php if (!empty($_SESSION['user'])): ?>
        <span class="sep">|</span><a href="index.php?page=logout">Logout</a>
      <?php else: ?>
        <span class="sep">|</span><a href="index.php?page=login">Login</a>
      <?php endif; ?>
    </div>
  </div>
</div>
