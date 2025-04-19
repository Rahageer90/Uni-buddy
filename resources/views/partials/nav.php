<?php use Illuminate\Support\Facades\Auth; ?>

<nav class="bg-white shadow-md p-4 flex justify-between items-center">
    <a href="/thesis" class="text-xl font-bold">Uni-Buddy</a>
    <div class="space-x-4">
        <?php if (Auth::check()): ?>
            <a href="/thesis/create" class="text-blue-500">Create Post</a>
            <a href="/thesis" class="text-blue-500">Thesis Dashboard</a>
            <a href="/thesis/my-posts" class="text-blue-500">My Posts</a>
            <a href="/thesis/requests" class="text-blue-500">View Requests</a>
            <form action="/logout" method="POST" class="inline">
                <?= csrf_field() ?>
                <button type="submit" class="text-red-500">Logout</button>
            </form>
        <?php else: ?>
            <a href="/login" class="text-blue-500">Login</a>
            <a href="/register" class="text-blue-500">Register</a>
        <?php endif; ?>
    </div>
</nav>
