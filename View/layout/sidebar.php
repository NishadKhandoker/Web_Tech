<?php $user = $_SESSION['user'] ?? null; $role = $user['role'] ?? null; ?>
<div class="shell">
  <aside class="sidebar">
    <?php if ($user): ?>
      <div class="sidebar-card">
        <div class="sidebar-name"><?= htmlspecialchars($user['name'] ?? '') ?></div>
        <div class="sidebar-id"><?= htmlspecialchars($user['aiub_id'] ?? '') ?></div>
        <div class="sidebar-role"><?= strtoupper(htmlspecialchars($role ?? '')) ?></div>
      </div>

      <?php if ($role === 'student'): ?>
        <a class="side-link" href="index.php?page=student.dashboard">Dashboard</a>
        <a class="side-link" href="index.php?page=student.internships">Browse Internships</a>
        <a class="side-link" href="index.php?page=student.research.browse">Browse Research Topics</a>
        <a class="side-link" href="index.php?page=student.research.requests">My Research Requests</a>
        <a class="side-link" href="index.php?page=student.internship.applications">My Internship Applications</a>

        <!-- ✅ NEW (Student) -->
       <a class="side-link" href="index.php?page=student.messages">Messages</a>


        <a class="side-link" href="index.php?page=student.profile">Profile</a>

      <?php elseif ($role === 'teacher'): ?>
        <a class="side-link" href="index.php?page=teacher.dashboard">Dashboard</a>
        <a class="side-link" href="index.php?page=teacher.research.create">Post Research</a>
        <a class="side-link" href="index.php?page=teacher.research.mine">My Research Topics</a>
        <a class="side-link" href="index.php?page=teacher.requests">Research Requests</a>

        <!-- ✅ NEW (Teacher) -->
        <a class="side-link" href="index.php?page=teacher.groups">Create Groups</a>
        <a class="side-link" href="index.php?page=teacher.messages">Messages</a>


        <a class="side-link" href="index.php?page=teacher.internship.create">Post Internship</a>
        <a class="side-link" href="index.php?page=teacher.internship.list">My Internships</a>
        <a class="side-link" href="index.php?page=teacher.applicants">Applicants</a>

      <?php elseif ($role === 'alumni'): ?>
        <a class="side-link" href="index.php?page=alumni.dashboard">Dashboard</a>
        <a class="side-link" href="index.php?page=alumni.internship.create">Post Internship</a>
        <a class="side-link" href="index.php?page=alumni.internship.list">My Internships</a>
        <a class="side-link" href="index.php?page=alumni.applicants">Applicants</a>

      <?php elseif ($role === 'admin'): ?>
        <a class="side-link" href="index.php?page=admin.dashboard">Dashboard</a>
        <a class="side-link" href="index.php?page=admin.users">User Management</a>
        <a class="side-link" href="index.php?page=admin.reg.requests">Registration Requests</a>

      <?php endif; ?>

      <a class="side-link" href="index.php?page=logout">Logout</a>

    <?php else: ?>
      <div class="sidebar-card">
        <div class="sidebar-name">Guest</div>
        <div class="sidebar-id">AIUB Portal</div>
      </div>
      <a class="side-link" href="index.php?page=login">Login</a>
    <?php endif; ?>
  </aside>
  <main class="content">
