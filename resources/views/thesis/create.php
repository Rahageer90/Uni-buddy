<?php include(__DIR__ . '/../partials/head.php'); ?>
<?php include(__DIR__ . '/../partials/nav.php'); ?>

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-center text-indigo-600 mb-6">Create Thesis Post</h1>

    <form method="POST" action="/thesis" class="space-y-6 bg-gradient-to-r from-indigo-400 via-indigo-500 to-indigo-600 p-8 rounded-lg shadow-lg">
        <?= csrf_field() ?>
        
        <input type="text" name="department" placeholder="Department*" class="w-full border-2 border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none" required>
        
        <input type="text" name="thesis_topic" placeholder="Thesis Topic" class="w-full border-2 border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none">
        
        <input type="text" name="thesis_field" placeholder="Thesis Field*" class="w-full border-2 border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none" required>
        
        <textarea name="details" placeholder="Details*" class="w-full border-2 border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none" required></textarea>
        
        <button type="submit" class="w-full py-3 bg-gradient-to-r from-green-400 to-green-500 text-white font-semibold rounded-lg hover:bg-green-600 transition duration-300">Post</button>
    </form>
</div>

<?php include(__DIR__ . '/../partials/tail.php'); ?>
