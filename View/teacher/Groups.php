<?php
$title = $title ?? "Create Research Groups";
$errors = $errorsForView ?? [];
$students = $students ?? [];

require __DIR__ . '/../layout/header.php';
require __DIR__ . '/../layout/navbar.php';
require __DIR__ . '/../layout/sidebar.php';
?>

<h2>Create Groups</h2>
<p class="muted">Only students with <b>accepted</b> research requests are shown.</p>

<?php if ($errors): ?>
  <div class="alert">
    <?php foreach ($errors as $e): ?><div><?= htmlspecialchars($e) ?></div><?php endforeach; ?>
  </div>
<?php endif; ?>

<div class="card">
  <?php if (empty($students)): ?>
    <p class="muted">No accepted students found.</p>
  <?php else: ?>
    <form method="post" action="index.php?page=teacher.groups.create">
      <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Csrf::token()) ?>">

      <label style="display:block;margin-bottom:10px;">
        <b>Group Name</b>
      </label>
      <input type="text" name="group_name" placeholder="e.g., Thesis Group A" style="width:100%;max-width:420px;" required>

      <div style="margin-top:16px;">
        <b>Select Students</b>
        <div class="muted" style="font-size:12px;margin-top:6px;">You can select multiple students.</div>
      </div>

      <div style="margin-top:12px; overflow:auto;">
        <table style="width:100%; border-collapse:collapse;">
          <thead>
            <tr style="text-align:left;">
              <th style="padding:10px;border-bottom:1px solid var(--border);">Select</th>
              <th style="padding:10px;border-bottom:1px solid var(--border);">Research Title</th>
              <th style="padding:10px;border-bottom:1px solid var(--border);">Student</th>
              <th style="padding:10px;border-bottom:1px solid var(--border);">AIUB ID</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($students as $s):
              $sid = (int)($s['student_id'] ?? 0);
              $rid = (int)($s['research_post_id'] ?? 0);
              $key = $sid . ":" . $rid;
            ?>
              <tr>
                <td style="padding:10px;border-bottom:1px solid var(--border);">
                  <input type="checkbox" name="student_keys[]" value="<?= htmlspecialchars($key) ?>">
                </td>
                <td style="padding:10px;border-bottom:1px solid var(--border);">
                  <?= htmlspecialchars((string)($s['research_title'] ?? '')) ?>
                </td>
                <td style="padding:10px;border-bottom:1px solid var(--border);">
                  <?= htmlspecialchars((string)($s['student_name'] ?? '')) ?>
                </td>
                <td style="padding:10px;border-bottom:1px solid var(--border);">
                  <?= htmlspecialchars((string)($s['student_aiub_id'] ?? '')) ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

      <div style="margin-top:16px;">
        <button class="btn" type="submit">Create Group</button>
      </div>
    </form>
  <?php endif; ?>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
