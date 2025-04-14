<?php include(__DIR__ . '/../partials/head.php'); ?>
<?php include(__DIR__ . '/../partials/nav.php'); ?>

<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Create Thesis Post</h1>

    <form method="POST" action="/thesis" class="space-y-4 bg-white p-6 rounded shadow">
        <?= csrf_field() ?>
        <input type="text" name="department" placeholder="Department*" class="w-full border p-2 rounded" required>
        <input type="text" name="thesis_topic" placeholder="Thesis Topic" class="w-full border p-2 rounded">
        <input type="text" name="thesis_field" placeholder="Thesis Field*" class="w-full border p-2 rounded" required>
        <textarea name="details" placeholder="Details*" class="w-full border p-2 rounded" required></textarea>
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Post</button>
    </form>
</div>

<?php include(__DIR__ . '/../partials/tail.php'); ?>
