<?php
$title = $title ?? "Messages";
$groups = $groups ?? [];

require __DIR__ . '/../layout/header.php';
require __DIR__ . '/../layout/navbar.php';
require __DIR__ . '/../layout/sidebar.php';
?>

<h2>Messages</h2>
<p class="muted">Groups where you were selected by a teacher.</p>

<div class="card">
  <?php if (empty($groups)): ?>
    <p class="muted">You are not in any group yet.</p>
  <?php else: ?>
    <table style="width:100%; border-collapse:collapse;">
      <thead>
        <tr style="text-align:left;">
          <th style="padding:10px;border-bottom:1px solid var(--border);">Group</th>
          <th style="padding:10px;border-bottom:1px solid var(--border);">Teacher</th>
          <th style="padding:10px;border-bottom:1px solid var(--border);">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($groups as $g): ?>
          <tr>
            <td style="padding:10px;border-bottom:1px solid var(--border);">
              <?= htmlspecialchars((string)$g['group_name']) ?>
            </td>
            <td style="padding:10px;border-bottom:1px solid var(--border);">
              <?= htmlspecialchars((string)$g['teacher_name']) ?>
              <span class="muted">(<?= htmlspecialchars((string)$g['teacher_aiub_id']) ?>)</span>
            </td>
            <td style="padding:10px;border-bottom:1px solid var(--border);">
              <a class="btn" href="index.php?page=student.chat&group_id=<?= (int)$g['id'] ?>">Open Chat</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
