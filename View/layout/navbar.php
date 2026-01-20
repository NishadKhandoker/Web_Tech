<?php $user = $_SESSION['user'] ?? null; $role = $user['role'] ?? null; ?>
<div class="nav">
  <div class="nav-inner">
    <div class="brand">
      <img src="assets/img/aiub-logo.png" class="brand-logo" alt="AIUB logo">
      <div class="brand-text">
        <div class="brand-title">AIUB Portal</div>
        <div class="brand-sub">Research & Internship Management </div>
      </div>
    </div>
    <div class="nav-links">
      <?php if (!$user): ?>
        <a href="index.php?page=login">Login</a>
        <a href="index.php?page=home">Home</a>

      <?php else: ?>
        <?php if ($role === 'student'): ?>
          <a href="index.php?page=student.dashboard">Dashboard</a>
          <a href="index.php?page=student.profile">Profile</a>
        <?php elseif ($role === 'teacher'): ?>
          <a href="index.php?page=teacher.dashboard">Dashboard</a>
          <a href="index.php?page=teacher.research.create">Post Research</a>
        <?php elseif ($role === 'alumni'): ?>
          <a href="index.php?page=alumni.dashboard">Dashboard</a>
          <a href="index.php?page=alumni.internship.list">My Internships</a>
        <?php elseif ($role === 'admin'): ?>
          <a href="index.php?page=admin.dashboard">Dashboard</a>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </div>
</div>
