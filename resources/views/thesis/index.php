<?php include(__DIR__ . '/../partials/head.php'); ?>
<?php include(__DIR__ . '/../partials/nav.php'); ?>

<?php use Illuminate\Support\Facades\Session; ?>

<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Thesis Posts</h1>
    <?php foreach ($posts as $post): ?>
        <div class="bg-white p-4 mb-4 rounded shadow">
            <p><strong>Posted by:</strong> <?= $post->user->name ?></p>
            <p><strong>Department:</strong> <?= $post->department ?></p>
            <p><strong>Thesis Topic:</strong> <?= $post->thesis_topic ?: 'N/A' ?></p>
            <p><strong>Field:</strong> <?= $post->thesis_field ?></p>
            <p><strong>Details:</strong> <?= $post->details ?></p>
            <?php if (Session::get('user_id') != $post->posted_by): ?>
                <form action="/thesis/request/<?= $post->id ?>" method="POST" class="mt-2">
                    <?= csrf_field() ?>
                    <textarea name="message" placeholder="Send your message" required class="w-full border rounded p-2 mb-2"></textarea>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Send Request</button>
                </form>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>

<?php include(__DIR__ . '/../partials/tail.php'); ?>
