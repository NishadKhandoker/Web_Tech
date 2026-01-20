<?php
$title = $title ?? "User Management";
require __DIR__ . '/../layout/header.php';
require __DIR__ . '/../layout/navbar.php';
require __DIR__ . '/../layout/sidebar.php';

$q = trim((string)($_GET['q'] ?? ''));
$roleFilter = trim((string)($_GET['role'] ?? ''));
$statusFilter = trim((string)($_GET['status'] ?? ''));
?>

<h2>User Management</h2>


<div class="card" style="margin-bottom:14px;">
  <form method="get" action="index.php" style="display:flex; gap:10px; flex-wrap:wrap; align-items:end;">
    <input type="hidden" name="page" value="admin.users">

    <div style="flex:1; min-width:220px;">
      <label>Search (Name / Email / AIUB ID)</label>
      <input type="text" name="q" value="<?= htmlspecialchars($q) ?>" placeholder="e.g. Monish / 21-45573-3 / email">
    </div>

    <div style="min-width:160px;">
      <label>Role</label>
      <select name="role">
        <option value="">All</option>
        <option value="student" <?= $roleFilter==='student'?'selected':'' ?>>Student</option>
        <option value="teacher" <?= $roleFilter==='teacher'?'selected':'' ?>>Teacher</option>
        <option value="alumni"  <?= $roleFilter==='alumni'?'selected':'' ?>>Alumni</option>
        <option value="admin"   <?= $roleFilter==='admin'?'selected':'' ?>>Admin</option>
      </select>
    </div>

    <div style="min-width:160px;">
      <label>Status</label>
      <select name="status">
        <option value="">All</option>
        <option value="active" <?= $statusFilter==='active'?'selected':'' ?>>Active</option>
        <option value="disabled" <?= $statusFilter==='disabled'?'selected':'' ?>>Disabled</option>
      </select>
    </div>

    <div>
      <button class="btn" type="submit">Search</button>
      <a class="btn" style="background:#6b7280;" href="index.php?page=admin.users">Reset</a>
    </div>
  </form>
</div>

<div class="card">
  <?php if (empty($users)): ?>
    <p class="muted">No users found.</p>
  <?php else: ?>
    <table style="width:100%; border-collapse:collapse;">
      <thead>
        <tr style="text-align:left;">
          <th style="padding:10px;border-bottom:1px solid var(--border);">Name</th>
          <th style="padding:10px;border-bottom:1px solid var(--border);">AIUB ID</th>
          <th style="padding:10px;border-bottom:1px solid var(--border);">Email</th>
          <th style="padding:10px;border-bottom:1px solid var(--border);">Role</th>
          <th style="padding:10px;border-bottom:1px solid var(--border);">Status</th>
          <th style="padding:10px;border-bottom:1px solid var(--border);">Actions</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($users as $u): ?>
          <?php
            $id = (int)($u['id'] ?? 0);
            $isActive = ((int)($u['is_active'] ?? 1) === 1);
            $isMe = ((int)($_SESSION['user']['id'] ?? 0) === $id);
          ?>
          <tr>
            <td style="padding:10px;border-bottom:1px solid var(--border);">
              <?= htmlspecialchars($u['name'] ?? '') ?>
              <?php if ($isMe): ?>
                <span class="muted" style="margin-left:6px;">(You)</span>
              <?php endif; ?>
            </td>

            <td style="padding:10px;border-bottom:1px solid var(--border);">
              <?= htmlspecialchars($u['aiub_id'] ?? '') ?>
            </td>

            <td style="padding:10px;border-bottom:1px solid var(--border);">
              <?= htmlspecialchars($u['email'] ?? '') ?>
            </td>

            <td style="padding:10px;border-bottom:1px solid var(--border);">
              <?= htmlspecialchars($u['role'] ?? '') ?>
            </td>

            <td style="padding:10px;border-bottom:1px solid var(--border);">
              <?php if ($isActive): ?>
                <span style="padding:4px 10px;border-radius:999px;background:#dcfce7;color:#166534;">Active</span>
              <?php else: ?>
                <span style="padding:4px 10px;border-radius:999px;background:#fee2e2;color:#991b1b;">Disabled</span>
              <?php endif; ?>
            </td>

            <td style="padding:10px;border-bottom:1px solid var(--border); white-space:nowrap;">
              <!-- Toggle Active -->
              <form method="post" action="index.php?page=admin.users.toggle" style="display:inline;">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Csrf::token()) ?>">
                <input type="hidden" name="user_id" value="<?= $id ?>">

                <?php if ($isMe): ?>
                  <button class="btn" style="background:#9ca3af;" type="button" disabled title="You cannot disable your own account">
                    Disable
                  </button>
                <?php else: ?>
                  <?php if ($isActive): ?>
                    <button class="btn" style="background:#b91c1c;" type="submit"
                            onclick="return confirm('Disable this user?');">
                      Disable
                    </button>
                  <?php else: ?>
                    <button class="btn" type="submit"
                            onclick="return confirm('Activate this user?');">
                      Activate
                    </button>
                  <?php endif; ?>
                <?php endif; ?>
              </form>

              <!-- Delete User -->
              <form method="post" action="index.php?page=admin.user.delete" style="display:inline; margin-left:6px;">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Csrf::token()) ?>">
                <input type="hidden" name="user_id" value="<?= $id ?>">

                <?php if ($isMe): ?>
                  <button class="btn" style="background:#9ca3af;" type="button" disabled title="You cannot delete your own account">
                    Delete
                  </button>
                <?php else: ?>
                  <button class="btn" style="background:#111827;" type="submit"
                          onclick="return confirm('Delete this user permanently? This cannot be undone.');">
                    Delete
                  </button>
                <?php endif; ?>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
