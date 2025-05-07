<?php use Illuminate\Support\Facades\Auth; ?>

<nav class="bg-gradient-to-r from-indigo-800 to-purple-900 text-white shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <!-- Logo -->
            <div class="flex items-center">
                <a href="/thesis" class="flex items-center">
                    <i class="fas fa-graduation-cap text-2xl text-yellow-400 mr-2"></i>
                    <span class="text-2xl font-extrabold tracking-tight hover:text-yellow-300 transition">
                        Uni<span class="text-yellow-400">Buddy</span>
                    </span>
                </a>
            </div>

            <!-- Mobile Menu -->
            <div class="md:hidden" x-data="{ open: false }">
                <button @click="open = !open" class="text-white p-2 focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>

                <div x-show="open" @click.outside="open = false" class="absolute top-16 right-0 left-0 bg-indigo-900 shadow-lg p-4">
                    <?php if (Auth::check()): ?>
                        <a href="/" class="block py-2 text-white hover:text-yellow-300">Dashboard</a>
                        <a href="/schedule" class="block py-2 text-white hover:text-yellow-300">My Schedule</a>
                        <a href="/schedule/search" class="block py-2 text-white hover:text-yellow-300">Find Mates</a>
                        <a href="/notifications" class="block py-2 text-white hover:text-yellow-300">Notifications</a>
                        <a href="/thesis" class="block py-2 text-white hover:text-yellow-300">Thesis</a>
                        <a href="/housing" class="block py-2 text-white hover:text-yellow-300">Housing</a>
                        <div class="border-t border-indigo-700 my-2"></div>
                        <?php if (Auth::user()->is_admin): ?>
                            <a href="/admin" class="block py-2 text-yellow-400 hover:text-yellow-300 font-semibold">Admin Dashboard</a>
                            <div class="border-t border-indigo-700 my-2"></div>
                        <?php endif; ?>
                        <form action="/logout" method="POST">
                            <?= csrf_field() ?>
                            <button type="submit" class="block w-full text-left py-2 text-red-300 hover:text-red-400">Logout</button>
                        </form>
                    <?php else: ?>
                        <a href="/login" class="block py-2 text-white hover:text-yellow-300">Login</a>
                        <a href="/register" class="block py-2 text-white hover:text-yellow-300">Register</a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex space-x-6 items-center">
                <?php if (Auth::check()): ?>
                    <a href="/" class="hover:text-yellow-300 transition">Dashboard</a>
                    <a href="/schedule" class="hover:text-yellow-300 transition">My Schedule</a>
                    <a href="/schedule/search" class="hover:text-yellow-300 transition">Find Mates</a>

                    <!-- Notifications -->
                    <a href="/notifications" class="relative hover:text-yellow-300 transition">
                        Notifications
                        <?php
                            //$unread = Auth::user()->notifications()->where('is_read', false)->count();
                            if ($unread > 0):
                        ?>
                            <span class="ml-1 px-2 py-0.5 rounded-full text-xs font-medium bg-red-500 text-white"><?= $unread ?></span>
                        <?php endif; ?>
                    </a>

                    <!-- Dropdown: Thesis -->
                    <div class="relative group" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-1 hover:text-yellow-300 transition">
                            <i class="fas fa-book-open mr-1"></i>
                            <span>Thesis</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        <div x-show="open" @click.outside="open = false" class="absolute z-10 mt-2 w-48 bg-white text-gray-800 rounded shadow-md overflow-hidden">
                            <a href="/thesis" class="flex items-center px-4 py-2 hover:bg-indigo-100"><i class="fas fa-search text-indigo-600 mr-2"></i>Browse</a>
                            <a href="/thesis/create" class="flex items-center px-4 py-2 hover:bg-indigo-100"><i class="fas fa-plus text-indigo-600 mr-2"></i>Create</a>
                            <a href="/thesis/my-posts" class="flex items-center px-4 py-2 hover:bg-indigo-100"><i class="fas fa-clipboard-list text-indigo-600 mr-2"></i>My Posts</a>
                            <a href="/thesis/requests" class="flex items-center px-4 py-2 hover:bg-indigo-100"><i class="fas fa-envelope text-indigo-600 mr-2"></i>Requests</a>
                        </div>
                    </div>

                    <!-- Dropdown: Housing -->
                    <div class="relative group" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-1 hover:text-yellow-300 transition">
                            <i class="fas fa-home mr-1"></i>
                            <span>Housing</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        <div x-show="open" @click.outside="open = false" class="absolute z-10 mt-2 w-48 bg-white text-gray-800 rounded shadow-md overflow-hidden">
                            <a href="/housing" class="flex items-center px-4 py-2 hover:bg-indigo-100"><i class="fas fa-search text-indigo-600 mr-2"></i>Browse</a>
                            <a href="/housing/create" class="flex items-center px-4 py-2 hover:bg-indigo-100"><i class="fas fa-plus text-indigo-600 mr-2"></i>Post</a>
                            <a href="/housing/my-posts" class="flex items-center px-4 py-2 hover:bg-indigo-100"><i class="fas fa-clipboard-list text-indigo-600 mr-2"></i>My Posts</a>
                        </div>
                    </div>

                    <!-- Admin -->
                    <?php if (Auth::user()->is_admin): ?>
                        <a href="/admin" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition"><i class="fas fa-cog mr-1"></i>Admin</a>
                    <?php endif; ?>

                    <!-- Logout -->
                    <form action="/logout" method="POST">
                        <?= csrf_field() ?>
                        <button type="submit" class="px-3 py-1 text-red-300 hover:text-red-400 transition">Logout</button>
                    </form>
                <?php else: ?>
                    <a href="/login" class="hover:text-yellow-300 transition">Login</a>
                    <a href="/register" class="hover:text-yellow-300 transition">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
