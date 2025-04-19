<?php include(__DIR__ . '/../partials/head.php'); ?>
<?php include(__DIR__ . '/../partials/nav.php'); ?>

<!-- Include Alpine.js -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<div class="container mx-auto mt-8 max-w-3xl">

    <h1 class="text-3xl font-bold mb-6 text-center">My Thesis Posts</h1>

    <!-- Flash Message -->
    <?php if (session('success')): ?>
        <div class="bg-green-100 text-green-800 border border-green-300 px-4 py-2 rounded mb-4">
            <?= session('success') ?>
        </div>
    <?php endif; ?>

    <?php foreach ($posts as $post): ?>
        <div class="bg-white p-4 mb-6 rounded shadow" x-data="{ editMode: false }">
            <!-- View Mode -->
            <template x-if="!editMode">
                <div>
                    <p><strong>Department:</strong> <?= $post->department ?></p>
                    <p><strong>Topic:</strong> <?= $post->thesis_topic ?></p>
                    <p><strong>Field:</strong> <?= $post->thesis_field ?></p>
                    <p><strong>Details:</strong> <?= $post->details ?></p>

                    <div class="mt-3 space-x-2">
                        <button @click="editMode = true" class="bg-blue-500 text-white px-4 py-2 rounded">Edit</button>

                        <form action="/thesis/delete/<?= $post->id ?>" method="POST" class="inline">
                        <input type="hidden" name="_token" value="<?= csrf_token() ?>">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
                        </form>
                    </div>
                </div>
            </template>

            <!-- Edit Mode -->
            <template x-if="editMode">
                <form action="/thesis/update/<?= $post->id ?>" method="POST" class="space-y-3 mt-2">
                    <?= csrf_field() ?>
                    <div>
                        <label class="block font-semibold mb-1">Department</label>
                        <input type="text" name="department" value="<?= $post->department ?>" class="w-full border p-2 rounded" required>
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Thesis Topic</label>
                        <input type="text" name="thesis_topic" value="<?= $post->thesis_topic ?>" class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Thesis Field</label>
                        <input type="text" name="thesis_field" value="<?= $post->thesis_field ?>" class="w-full border p-2 rounded" required>
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Details</label>
                        <textarea name="details" class="w-full border p-2 rounded" required><?= $post->details ?></textarea>
                    </div>

                    <div class="flex space-x-3 mt-3">
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Save</button>
                        <button type="button" @click="editMode = false" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Cancel</button>
                    </div>
                </form>
            </template>
        </div>
    <?php endforeach; ?>

    <?php if (count($posts) === 0): ?>
        <p class="text-gray-500">You haven’t posted anything yet.</p>
    <?php endif; ?>
</div>

<?php include(__DIR__ . '/../partials/tail.php'); ?>
