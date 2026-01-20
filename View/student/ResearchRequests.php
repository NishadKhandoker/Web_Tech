<?php
$title = $title ?? "My Research Requests";
require __DIR__ . '/../layout/header.php';
require __DIR__ . '/../layout/navbar.php';
require __DIR__ . '/../layout/sidebar.php';
?>

<h2>My Research Requests</h2>

<div class="card">
  <?php if (empty($requests)): ?>
    <p class="muted">No requests yet.</p>
  <?php else: ?>
    <table style="width:100%; border-collapse:collapse;">
      <thead>
        <tr style="text-align:left;">
          <th style="padding:10px;border-bottom:1px solid var(--border);">Topic</th>
          <th style="padding:10px;border-bottom:1px solid var(--border);">Domain</th>
          <th style="padding:10px;border-bottom:1px solid var(--border);">Teacher</th>
          <th style="padding:10px;border-bottom:1px solid var(--border);">Status</th>
          <th style="padding:10px;border-bottom:1px solid var(--border);">Teacher Comment</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($requests as $r): ?>
          <tr>
            <td style="padding:10px;border-bottom:1px solid var(--border);">
              <?= htmlspecialchars($r['title'] ?? '') ?>
            </td>

            <td style="padding:10px;border-bottom:1px solid var(--border);">
              <?= htmlspecialchars($r['domain'] ?? '') ?>
            </td>

            <td style="padding:10px;border-bottom:1px solid var(--border);">
              <?= htmlspecialchars($r['teacher_name'] ?? '') ?>
              (<?= htmlspecialchars($r['teacher_aiub_id'] ?? '') ?>)
            </td>

            <td style="padding:10px;border-bottom:1px solid var(--border);">
              <?= htmlspecialchars($r['status'] ?? '') ?>
            </td>

            <td style="padding:10px;border-bottom:1px solid var(--border);">
              <?php if (!empty($r['teacher_comment'])): ?>
                <?= htmlspecialchars($r['teacher_comment']) ?>
              <?php else: ?>
                <span class="muted">—</span>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
