<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">User Dashboard</h1>
            <div class="space-x-4">
                <a href="/articles/create" class="bg-green-500 px-4 py-2 rounded hover:bg-green-600">New Article</a>
                <a href="/logout" class="bg-red-500 px-4 py-2 rounded hover:bg-red-600">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-8 p-4">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold mb-4">Articles</h2>
            
            <?php if(empty($articles)): ?>
                <p class="text-gray-500">No articles found.</p>
            <?php else: ?>
                <div class="grid gap-4">
                    <?php foreach($articles as $article): ?>
                        <div class="border p-4 rounded">
                            <h3 class="font-bold"><?= htmlspecialchars($article->title) ?></h3>
                            <p class="text-gray-600"><?= htmlspecialchars($article->content) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>