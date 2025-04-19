<?php include(__DIR__ . '/../partials/head.php'); ?>
<?php include(__DIR__ . '/../partials/nav.php'); ?>

<div class="container mx-auto mt-8 max-w-4xl">
    <h1 class="text-3xl font-bold text-center text-indigo-700 mb-6">My Thesis Posts</h1>

    <!-- Flash Message -->
    <?php if (session('success')): ?>
        <div class="bg-green-100 text-green-800 border border-green-300 px-6 py-3 rounded-lg mb-6">
            <?= session('success') ?>
        </div>
    <?php endif; ?>

    <?php foreach ($posts as $post): ?>
        <div class="bg-white p-6 mb-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300" x-data="{ editMode: false }">
            <!-- View Mode -->
            <template x-if="!editMode">
                <div>
                    <p><strong class="text-indigo-600">Department:</strong> <?= $post->department ?></p>
                    <p><strong class="text-indigo-600">Topic:</strong> <?= $post->thesis_topic ?></p>
                    <p><strong class="text-indigo-600">Field:</strong> <?= $post->thesis_field ?></p>
                    <p><strong class="text-indigo-600">Details:</strong> <?= $post->details ?></p>

                    <div class="mt-4 flex space-x-4">
                        <button @click="editMode = true" class="bg-yellow-500 text-white px-6 py-3 rounded-lg hover:bg-yellow-600 transition duration-300">Edit</button>

                        <form action="/thesis/delete/<?= $post->id ?>" method="POST" class="inline">
                            <input type="hidden" name="_token" value="<?= csrf_token() ?>">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="bg-red-500 text-white px-6 py-3 rounded-lg hover:bg-red-600 transition duration-300">Delete</button>
                        </form>
                    </div>
                </div>
            </template>

            <!-- Edit Mode -->
            <template x-if="editMode">
                <form action="/thesis/update/<?= $post->id ?>" method="POST" class="space-y-6 mt-4">
                    <?= csrf_field() ?>
                    <div>
                        <label class="block font-semibold mb-2 text-indigo-600">Department</label>
                        <input type="text" name="department" value="<?= $post->department ?>" class="w-full border-2 border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
                    </div>
                    <div>
                        <label class="block font-semibold mb-2 text-indigo-600">Thesis Topic</label>
                        <input type="text" name="thesis_topic" value="<?= $post->thesis_topic ?>" class="w-full border-2 border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    </div>
                    <div>
                        <label class="block font-semibold mb-2 text-indigo-600">Thesis Field</label>
                        <input type="text" name="thesis_field" value="<?= $post->thesis_field ?>" class="w-full border-2 border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
                    </div>
                    <div>
                        <label class="block font-semibold mb-2 text-indigo-600">Details</label>
                        <textarea name="details" class="w-full border-2 border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" required><?= $post->details ?></textarea>
                    </div>

                    <div class="flex space-x-6 mt-4">
                        <button type="submit" class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition duration-300">Save</button>
                        <button type="button" @click="editMode = false" class="bg-gray-400 text-white px-6 py-3 rounded-lg hover:bg-gray-500 transition duration-300">Cancel</button>
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
