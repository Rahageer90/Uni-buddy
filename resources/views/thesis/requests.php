<?php include(__DIR__ . '/../partials/head.php'); ?>
<?php include(__DIR__ . '/../partials/nav.php'); ?>

<div class="container mx-auto mt-8">
    <h1 class="text-3xl font-bold text-center text-indigo-700 mb-6">Requests Received</h1>
    
    <?php foreach ($requests as $request): ?>
        <div class="bg-white p-6 mb-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
            <p><strong class="text-indigo-600">From:</strong> <?= $request->sender->name ?></p>
            <p><strong class="text-indigo-600">Email:</strong> 
                <a href="https://mail.google.com/mail/?view=cm&fs=1&to=<?= urlencode($request->sender->email) ?>" 
                   target="_blank" 
                   class="text-blue-600 hover:underline">
                    <?= $request->sender->email ?>
                </a>
            </p>
            <p><strong class="text-indigo-600">Post:</strong> <?= $request->post->thesis_topic ?: 'N/A' ?></p>
            <p><strong class="text-indigo-600">Message:</strong> <?= $request->message ?></p>
        </div>
    <?php endforeach; ?>
</div>

<?php include(__DIR__ . '/../partials/tail.php'); ?>
