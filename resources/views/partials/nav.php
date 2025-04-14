<nav class="bg-white shadow-md p-4 flex justify-between items-center">
    <a href="/" class="text-xl font-bold">Uni-Buddy</a>
    <div class="space-x-4">
        <?php if (session('user_id')): ?>
            <a href="/thesis/create" class="text-blue-500">Create Post</a>
            <a href="/thesis/my-posts" class="text-blue-500">My Posts</a>
            <a href="/thesis/requests" class="text-blue-500">View Requests</a>
            <a href="/logout" class="text-red-500">Logout</a>
        <?php else: ?>
            <a href="/login" class="text-blue-500">Login</a>
            <a href="/register" class="text-blue-500">Register</a>
        <?php endif; ?>
    </div>
</nav>
