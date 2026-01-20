<?php
$title = $title ?? "Admin Dashboard";
$stats = $stats ?? [
  'total_users' => 0,
  'active_users' => 0,
  'disabled_users' => 0,
  'pending_requests' => 0
];

require __DIR__ . '/../layout/header.php';
require __DIR__ . '/../layout/navbar.php';
require __DIR__ . '/../layout/sidebar.php';

$u = $_SESSION['user'] ?? [];
?>

<h2>Admin Dashboard</h2>
<p class="muted">Overview of the system.</p>

<div class="card" style="display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:12px;">
  <div class="card" style="margin:0;">
    <div class="muted">Total Users</div>
    <div style="font-size:28px;font-weight:700;"><?= (int)$stats['total_users'] ?></div>
  </div>
  <div class="card" style="margin:0;">
    <div class="muted">Active Users</div>
    <div style="font-size:28px;font-weight:700;"><?= (int)$stats['active_users'] ?></div>
  </div>
  <div class="card" style="margin:0;">
    <div class="muted">Disabled Users</div>
    <div style="font-size:28px;font-weight:700;"><?= (int)$stats['disabled_users'] ?></div>
  </div>
  <div class="card" style="margin:0;">
    <div class="muted">Pending Requests</div>
    <div style="font-size:28px;font-weight:700;"><?= (int)$stats['pending_requests'] ?></div>
  </div>
</div>

<div class="card" style="margin-top:12px;">
  <h3 style="margin-top:0;">Admin Info</h3>
  <div class="muted" style="line-height:1.8;">
    <div><b>Name:</b> <?= htmlspecialchars($u['name'] ?? '') ?></div>
    <div><b>AIUB ID:</b> <?= htmlspecialchars($u['aiub_id'] ?? '') ?></div>
    <div><b>Email:</b> <?= htmlspecialchars($u['email'] ?? '') ?></div>
    <div><b>Role:</b> <?= htmlspecialchars(strtoupper($u['role'] ?? '')) ?></div>
  </div>

  <div style="margin-top:12px;">
    <a class="btn" href="index.php?page=admin.users">User Management</a>
    <a class="btn" style="margin-left:8px;background:#6b7280;" href="index.php?page=admin.reg.requests">Registration Requests</a>
  </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
