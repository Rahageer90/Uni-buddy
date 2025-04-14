<?php include __DIR__ . '/../partials/head.php'; ?>
<?php include __DIR__ . '/../partials/nav.php'; ?>

<div class="max-w-md mx-auto mt-10 p-6 bg-white shadow rounded">
    <h2 class="text-2xl font-semibold mb-4">Register</h2>
    <form action="/register" method="POST">
        <?php echo csrf_field(); ?>
        <input type="text" name="name" placeholder="Name" required class="w-full mb-3 p-2 border rounded">
        <input type="email" name="email" placeholder="Email" required class="w-full mb-3 p-2 border rounded">
        <input type="password" name="password" placeholder="Password" required class="w-full mb-3 p-2 border rounded">
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required class="w-full mb-3 p-2 border rounded">
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Register</button>
    </form>
</div>

<?php include __DIR__ . '/../partials/tail.php'; ?>
