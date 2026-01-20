<?php
$title = "My Internships";
require __DIR__ . '/../layout/header.php';
require __DIR__ . '/../layout/navbar.php';
require __DIR__ . '/../layout/sidebar.php';
?>

<h2>My Internship Posts</h2>

<div class="card">
  <a class="btn" href="index.php?page=teacher.internship.create">+ Post New Internship</a>
  <a class="btn" style="margin-left:10px;background:#6b7280;" href="index.php?page=teacher.applicants">View Applicants</a>
</div>

<div class="card" style="margin-top:12px;">
  <?php if (empty($internships)): ?>
    <p class="muted">No internships posted yet.</p>
  <?php else: ?>
    <table style="width:100%; border-collapse:collapse;">
      <thead>
        <tr style="text-align:left;">
          <th style="padding:10px;border-bottom:1px solid var(--border);">Title</th>
          <th style="padding:10px;border-bottom:1px solid var(--border);">Company</th>
          <th style="padding:10px;border-bottom:1px solid var(--border);">Deadline</th>
          <th style="padding:10px;border-bottom:1px solid var(--border);">Status</th>
          <th style="padding:10px;border-bottom:1px solid var(--border);">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($internships as $p): ?>
          <tr>
            <td style="padding:10px;border-bottom:1px solid var(--border);"><?= htmlspecialchars($p['title']) ?></td>
            <td style="padding:10px;border-bottom:1px solid var(--border);"><?= htmlspecialchars($p['company']) ?></td>
            <td style="padding:10px;border-bottom:1px solid var(--border);"><?= htmlspecialchars($p['deadline']) ?></td>
            <td style="padding:10px;border-bottom:1px solid var(--border);">
              <?= ((int)$p['is_active'] === 1) ? 'Active' : 'Closed' ?>
            </td>

            <td style="padding:10px;border-bottom:1px solid var(--border);">
              <a class="btn" href="index.php?page=teacher.internship.edit&id=<?= (int)$p['id'] ?>">Edit</a>

              <form method="post" action="index.php?page=teacher.internship.delete" style="display:inline;">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Csrf::token()) ?>">
                <input type="hidden" name="id" value="<?= (int)$p['id'] ?>">
                <button class="btn" style="background:#b91c1c;margin-left:6px;" type="submit"
                        onclick="return confirm('Delete this internship?');">
                  Delete
                </button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
