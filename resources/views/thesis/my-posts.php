<?php include(__DIR__ . '/../partials/head.php'); ?>
<?php include(__DIR__ . '/../partials/nav.php'); ?>

<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">My Thesis Posts</h1>
    <?php foreach ($posts as $post): ?>
        <div class="bg-white p-4 mb-4 rounded shadow">
            <p><strong>Department:</strong> <?= $post->department ?></p>
            <p><strong>Topic:</strong> <?= $post->thesis_topic ?></p>
            <p><strong>Field:</strong> <?= $post->thesis_field ?></p>
            <p><strong>Details:</strong> <?= $post->details ?></p>

            <a href="/thesis/edit/<?= $post->id ?>" class="text-blue-500 underline">Edit</a>
            <form action="/thesis/delete/<?= $post->id ?>" method="POST" class="inline">
                <?= csrf_field() ?>
                <button type="submit" class="text-red-500 ml-2">Delete</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>

<?php include(__DIR__ . '/../partials/tail.php'); ?>
