<?php use Illuminate\Support\Facades\Auth; ?>

<nav class="bg-indigo-800 text-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Brand -->
            <div class="flex-shrink-0">
                <a href="/thesis" class="text-2xl font-extrabold tracking-tight hover:text-yellow-300 transition">
                    Uni<span class="text-yellow-400">Buddy</span>
                </a>
            </div>

            <!-- Navigation Links (Desktop only) -->
            <div class="flex space-x-6 items-center">
                <?php if (Auth::check()): ?>
                    <a href="/thesis/create" class="hover:text-yellow-300 transition">Create Post</a>
                    <a href="/thesis" class="hover:text-yellow-300 transition">Thesis Dashboard</a>
                    <a href="/thesis/my-posts" class="hover:text-yellow-300 transition">My Posts</a>
                    <a href="/thesis/requests" class="hover:text-yellow-300 transition">Requests</a>

                    <form action="/logout" method="POST" class="inline">
                        <?= csrf_field() ?>
                        <button type="submit" class="text-red-300 hover:text-red-500 transition">Logout</button>
                    </form>
                <?php else: ?>
                    <a href="/login" class="hover:text-yellow-300 transition">Login</a>
                    <a href="/register" class="hover:text-yellow-300 transition">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
