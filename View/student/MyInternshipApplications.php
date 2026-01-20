<?php
$title = $title ?? "My Internship Applications";
require __DIR__ . '/../layout/header.php';
require __DIR__ . '/../layout/navbar.php';
require __DIR__ . '/../layout/sidebar.php';
?>

<h2>My Internship Applications</h2>
<p class="muted">Track your application status (Pending / Shortlisted / Rejected).</p>

<div class="card">
  <?php if (empty($apps)): ?>
    <p class="muted">You have not applied to any internships yet.</p>
  <?php else: ?>
    <table style="width:100%; border-collapse:collapse;">
      <thead>
        <tr style="text-align:left;">
          <th style="padding:10px;border-bottom:1px solid var(--border);">Internship</th>
          <th style="padding:10px;border-bottom:1px solid var(--border);">Company</th>
          <th style="padding:10px;border-bottom:1px solid var(--border);">Deadline</th>
          <th style="padding:10px;border-bottom:1px solid var(--border);">Posted By</th>
          <th style="padding:10px;border-bottom:1px solid var(--border);">Status</th>
          <th style="padding:10px;border-bottom:1px solid var(--border);">Applied On</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($apps as $a):
          $status = $a['status'] ?? 'pending';
          $badgeStyle = "background:#e5e7eb;color:#111827;"; // pending
          if ($status === 'shortlisted') $badgeStyle = "background:#dcfce7;color:#166534;";
          if ($status === 'rejected') $badgeStyle = "background:#fee2e2;color:#991b1b;";
        ?>
          <tr>
            <td style="padding:10px;border-bottom:1px solid var(--border);">
              <?= htmlspecialchars($a['title'] ?? '') ?>
            </td>
            <td style="padding:10px;border-bottom:1px solid var(--border);">
              <?= htmlspecialchars($a['company'] ?? '') ?>
            </td>
            <td style="padding:10px;border-bottom:1px solid var(--border);">
              <?= htmlspecialchars($a['deadline'] ?? '') ?>
            </td>
            <td style="padding:10px;border-bottom:1px solid var(--border);">
              <?= htmlspecialchars($a['alumni_name'] ?? '') ?>
              <span class="muted">(<?= htmlspecialchars($a['alumni_aiub_id'] ?? '') ?>)</span>
            </td>
            <td style="padding:10px;border-bottom:1px solid var(--border);">
              <span style="padding:4px 10px;border-radius:999px;<?= $badgeStyle ?>">
                <?= htmlspecialchars($status) ?>
              </span>
            </td>
            <td style="padding:10px;border-bottom:1px solid var(--border);">
              <?= htmlspecialchars($a['created_at'] ?? '') ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
