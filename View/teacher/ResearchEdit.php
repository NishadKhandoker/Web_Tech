<?php
$title = $title ?? "Edit Research Topic";
$errors = $errorsForView ?? [];
$post = $post ?? [];

require __DIR__ . '/../layout/header.php';
require __DIR__ . '/../layout/navbar.php';
require __DIR__ . '/../layout/sidebar.php';
?>

<h2>Edit Research Topic</h2>

<?php if ($errors): ?>
  <div class="alert">
    <?php foreach ($errors as $e): ?><div><?= htmlspecialchars($e) ?></div><?php endforeach; ?>
  </div>
<?php endif; ?>

<div class="card">
  <form method="post" action="index.php?page=teacher.research.update" id="editResearchForm">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Csrf::token()) ?>">
    <input type="hidden" name="id" value="<?= (int)($post['id'] ?? 0) ?>">

    <label>Title</label>
    <input type="text" name="title" required minlength="5" value="<?= htmlspecialchars($post['title'] ?? '') ?>">

    <label>Domain</label>
    <input type="text" name="domain" required value="<?= htmlspecialchars($post['domain'] ?? '') ?>">

    <label>Description (max 100 words)</label>
    <textarea name="description" required rows="6"
      style="width:100%;padding:10px;border:1px solid var(--border);border-radius:10px;"
      oninput="limitWords(this)"><?= htmlspecialchars($post['description'] ?? '') ?></textarea>

    <small id="wordInfo" class="muted">0 / 100 words</small>

    <div style="margin-top:12px; display:flex; gap:10px; flex-wrap:wrap;">
      <button class="btn" type="submit">Save Changes</button>
      <a class="btn" style="background:#6b7280;" href="index.php?page=teacher.research.mine">Back</a>
    </div>
  </form>
</div>

<script>
function countWords(text){
  const words = text.trim().split(/\s+/).filter(w => w.length>0);
  return words.length;
}
function limitWords(el){
  const words = el.value.trim().split(/\s+/).filter(w => w.length>0);
  const wc = words.length;
  document.getElementById("wordInfo").innerText = wc + " / 100 words";
  if (wc > 100){
    el.value = words.slice(0,100).join(" ");
    document.getElementById("wordInfo").innerText = "100 / 100 words";
  }
}
document.addEventListener("DOMContentLoaded", ()=>{
  const ta = document.querySelector('textarea[name="description"]');
  if(ta) limitWords(ta);
});
</script>

<?php require __DIR__ . '/../layout/footer.php'; ?>
