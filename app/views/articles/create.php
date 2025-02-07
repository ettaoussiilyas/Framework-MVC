<!DOCTYPE html>
<html>
<head>
    <title>Create Article</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h1 class="text-2xl font-bold mb-6">Create New Article</h1>

            <?php if(isset($_SESSION['errors'])): ?>
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <?php foreach($_SESSION['errors'] as $error): ?>
                        <p><?= $error ?></p>
                    <?php endforeach; ?>
                    <?php unset($_SESSION['errors']); ?>
                </div>
            <?php endif; ?>

            <form action="/articles" method="POST">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                        Title
                    </label>
                    <input 
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="title"
                        type="text"
                        name="title"
                        required
                        placeholder="Enter article title"
                    >
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="content">
                        Content
                    </label>
                    <textarea 
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="content"
                        name="content"
                        required
                        rows="6"
                        placeholder="Enter article content"
                    ></textarea>
                </div>

                <div class="flex items-center justify-between">
                    <button 
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit"
                    >
                        Create Article
                    </button>
                    <a href="/articles" class="text-gray-600 hover:text-gray-800">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html> 