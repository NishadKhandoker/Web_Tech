<?php
$title = $title ?? "My Research Topics";
require __DIR__ . '/../layout/header.php';
require __DIR__ . '/../layout/navbar.php';
require __DIR__ . '/../layout/sidebar.php';

$updated = isset($_GET['updated']);
$deleted = isset($_GET['deleted']);
?>

<h2>My Research Topics</h2>

<?php if ($updated): ?>
  <div class="alert" style="border-color:#86efac;color:#065f46;">Updated successfully.</div>
<?php endif; ?>
<?php if ($deleted): ?>
  <div class="alert" style="border-color:#86efac;color:#065f46;">Deleted successfully (removed from students too).</div>
<?php endif; ?>

<div class="card">
  <a class="btn" href="index.php?page=teacher.research.create">+ Post New Topic</a>
</div>

<div style="margin-top:12px;">
  <?php if (empty($posts)): ?>
    <div class="card"><p class="muted">No topics posted yet.</p></div>
  <?php else: ?>
    <?php foreach ($posts as $p): ?>
      <div class="card" style="margin-bottom:12px;">
        <h3 style="margin:0;"><?= htmlspecialchars($p['title']) ?></h3>
        <div class="muted" style="margin-top:6px;">Domain: <b><?= htmlspecialchars($p['domain']) ?></b></div>

        <div style="margin-top:10px;background:#fff;border:1px solid var(--border);border-radius:10px;padding:12px;">
          <div style="font-weight:700;margin-bottom:6px;">Description</div>
          <div style="white-space:pre-wrap; line-height:1.5;"><?= htmlspecialchars($p['description']) ?></div>
        </div>

        <div style="margin-top:12px; display:flex; gap:10px; flex-wrap:wrap;">
          <a class="btn" href="index.php?page=teacher.research.edit&id=<?= (int)$p['id'] ?>">Edit</a>

          <form method="post" action="index.php?page=teacher.research.delete" onsubmit="return confirm('Delete this topic? This will also remove related student requests.');">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Csrf::token()) ?>">
            <input type="hidden" name="id" value="<?= (int)$p['id'] ?>">
            <button class="btn" type="submit" style="background:#b91c1c;">Delete</button>
          </form>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
