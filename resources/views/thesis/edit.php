<?php include(__DIR__ . '/../partials/head.php'); ?>
<?php include(__DIR__ . '/../partials/nav.php'); ?>

<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Edit Thesis Post</h1>

    <form method="POST" action="/thesis/update/<?= $post->id ?>" class="space-y-4 bg-white p-6 rounded shadow">
        <?= csrf_field() ?>
        <input type="text" name="department" value="<?= $post->department ?>" required class="w-full border p-2 rounded">
        <input type="text" name="thesis_topic" value="<?= $post->thesis_topic ?>" class="w-full border p-2 rounded">
        <input type="text" name="thesis_field" value="<?= $post->thesis_field ?>" required class="w-full border p-2 rounded">
        <textarea name="details" required class="w-full border p-2 rounded"><?= $post->details ?></textarea>
        <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>

<?php include(__DIR__ . '/../partials/tail.php'); ?>
