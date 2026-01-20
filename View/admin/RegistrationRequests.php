<?php
$title = $title ?? "Registration Requests";
require __DIR__ . '/../layout/header.php';
require __DIR__ . '/../layout/navbar.php';
require __DIR__ . '/../layout/sidebar.php';
?>

<h2>Registration Requests</h2>
<p class="muted">Approve or deny new accounts. Approved users can log in.</p>

<div class="card">
  <?php if (empty($requests)): ?>
    <p class="muted">No pending registration requests.</p>
  <?php else: ?>
    <table style="width:100%; border-collapse:collapse;">
      <thead>
        <tr style="text-align:left;">
          <th style="padding:10px;border-bottom:1px solid var(--border);">Role</th>
          <th style="padding:10px;border-bottom:1px solid var(--border);">Name</th>
          <th style="padding:10px;border-bottom:1px solid var(--border);">AIUB ID</th>
          <th style="padding:10px;border-bottom:1px solid var(--border);">Email</th>
          <th style="padding:10px;border-bottom:1px solid var(--border);">Dept</th>
          <th style="padding:10px;border-bottom:1px solid var(--border);">Details</th>
          <th style="padding:10px;border-bottom:1px solid var(--border);">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($requests as $r): ?>
          <tr>
            <td style="padding:10px;border-bottom:1px solid var(--border);"><?= htmlspecialchars($r['role']) ?></td>
            <td style="padding:10px;border-bottom:1px solid var(--border);"><?= htmlspecialchars($r['name']) ?></td>
            <td style="padding:10px;border-bottom:1px solid var(--border);"><?= htmlspecialchars($r['aiub_id']) ?></td>
            <td style="padding:10px;border-bottom:1px solid var(--border);"><?= htmlspecialchars($r['email']) ?></td>
            <td style="padding:10px;border-bottom:1px solid var(--border);"><?= htmlspecialchars($r['department']) ?></td>

            <td style="padding:10px;border-bottom:1px solid var(--border);">
              <?php if ($r['role'] === 'student'): ?>
                <div class="muted">Major: <?= htmlspecialchars($r['major'] ?? '') ?></div>
                <div class="muted">CGPA: <?= htmlspecialchars($r['cgpa'] ?? '') ?></div>
                <div class="muted">Credits: <?= htmlspecialchars((string)($r['credits_completed'] ?? '')) ?></div>
              <?php else: ?>
                <div class="muted">LinkedIn: <?= htmlspecialchars($r['linkedin_url'] ?? '') ?></div>
                <div class="muted">ResearchGate: <?= htmlspecialchars($r['researchgate_url'] ?? '') ?></div>
              <?php endif; ?>
            </td>

            <td style="padding:10px;border-bottom:1px solid var(--border);">
              <form method="post" action="index.php?page=admin.reg.approve" style="display:inline;">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Csrf::token()) ?>">
                <input type="hidden" name="req_id" value="<?= (int)$r['id'] ?>">
                <button class="btn" type="submit" onclick="return confirm('Approve this registration?');">Approve</button>
              </form>

              <form method="post" action="index.php?page=admin.reg.deny" style="display:inline;margin-left:6px;">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Csrf::token()) ?>">
                <input type="hidden" name="req_id" value="<?= (int)$r['id'] ?>">
                <input type="text" name="admin_note" placeholder="Reason (optional)" style="width:180px;padding:8px;border:1px solid var(--border);border-radius:10px;">
                <button class="btn" style="background:#b91c1c;margin-left:6px;" type="submit"
                        onclick="return confirm('Deny this registration?');">Deny</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
