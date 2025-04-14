<?php include(__DIR__ . '/../partials/head.php'); ?>
<?php include(__DIR__ . '/../partials/nav.php'); ?>

<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Requests Received</h1>
    <?php foreach ($requests as $request): ?>
        <div class="bg-white p-4 mb-4 rounded shadow">
            <p><strong>From:</strong> <?= $request->sender->name ?></p>
            <p><strong>Post:</strong> <?= $request->post->thesis_topic ?: 'N/A' ?></p>
            <p><strong>Message:</strong> <?= $request->message ?></p>
        </div>
    <?php endforeach; ?>
</div>

<?php include(__DIR__ . '/../partials/tail.php'); ?>
