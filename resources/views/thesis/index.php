<?php include(__DIR__ . '/../partials/head.php'); ?>
<?php include(__DIR__ . '/../partials/nav.php'); ?>

<?php use Illuminate\Support\Facades\Session; ?>
<?php use Illuminate\Support\Facades\Auth; ?>
<?php use App\Models\ThesisRequest; ?>

<div class="container mx-auto mt-8">
    <h1 class="text-3xl font-bold text-center text-indigo-700 mb-6">Thesis Posts</h1>
    
    <?php foreach ($posts as $post): ?>
        <div class="bg-white p-6 mb-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
            <p><strong class="text-indigo-600">Posted by:</strong> <?= $post->user->name ?></p>
            <p><strong class="text-indigo-600">Department:</strong> <?= $post->department ?></p>
            <p><strong class="text-indigo-600">Thesis Topic:</strong> <?= $post->thesis_topic ?: 'N/A' ?></p>
            <p><strong class="text-indigo-600">Field:</strong> <?= $post->thesis_field ?></p>
            <p><strong class="text-indigo-600">Details:</strong> <?= $post->details ?></p>

            <?php
                $authId = Auth::id();
                $alreadyRequested = ThesisRequest::where('post_id', $post->id)
                                    ->where('sender_id', $authId)
                                    ->exists();
            ?>

            <?php if ($authId != $post->posted_by && !$alreadyRequested): ?>
                <form action="/thesis/request/<?= $post->id ?>" method="POST" class="mt-4">
                    <?= csrf_field() ?>
                    <textarea name="message" placeholder="Send your message" required class="w-full border-2 border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none mb-4"></textarea>
                    <button type="submit" class="w-full py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-300">Send Request</button>
                </form>
            <?php elseif ($authId != $post->posted_by): ?>
                <p class="text-green-600 mt-2">Request already sent.</p>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>

<?php include(__DIR__ . '/../partials/tail.php'); ?>