<?php
$title = "Post Research";
$errors = $errorsForView ?? [];

require __DIR__ . '/../layout/header.php';
require __DIR__ . '/../layout/navbar.php';
require __DIR__ . '/../layout/sidebar.php';
?>

<h2>Post Research Topic</h2>

<?php if ($errors): ?>
  <div class="alert">
    <?php foreach ($errors as $e): ?><div><?= htmlspecialchars($e) ?></div><?php endforeach; ?>
  </div>
<?php endif; ?>

<div class="card">
  <form method="post" action="index.php?page=teacher.research.store" id="researchForm">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Csrf::token()) ?>">

    <label>Title</label>
    <input type="text" name="title" required minlength="5">

    <label>Domain</label>
    <input type="text" name="domain" required>

    <label>Description (max 100 words)</label>
<textarea name="description"
          required
          rows="6"
          maxlength="700"
          oninput="checkWordLimit(this)"
          style="width:100%;padding:10px;border:1px solid var(--border);border-radius:10px;"></textarea>

<small id="wordInfo" class="muted">0 / 100 words</small>


    <button class="btn" type="submit">Publish</button>
  </form>
</div>
<script>
function checkWordLimit(el){
  const words = el.value.trim().split(/\s+/).filter(w => w.length > 0);
  document.getElementById("wordInfo").innerText = words.length + " / 100 words";

  if(words.length > 100){
    el.value = words.slice(0,100).join(" ");
    document.getElementById("wordInfo").innerText = "100 / 100 words";
  }
}
</script>


<?php require __DIR__ . '/../layout/footer.php'; ?>
