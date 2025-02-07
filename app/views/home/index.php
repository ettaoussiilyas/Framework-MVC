<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-4">
                    <a href="/" class="flex items-center py-4 px-2 text-gray-700 hover:text-gray-900">
                        <span class="font-bold">Home</span>
                    </a>
                    <a href="/articles" class="flex items-center py-4 px-2 text-gray-700 hover:text-gray-900">
                        Articles
                    </a>
                </div>

                <div class="flex items-center space-x-4">
                    <?php if(isset($_SESSION['user'])): ?>
                        <a href="/logout" class="py-2 px-4 bg-red-500 hover:bg-red-600 text-white rounded-lg transition duration-300">
                            Logout
                        </a>
                    <?php else: ?>
                        <a href="/login" class="py-2 px-4 text-gray-700 hover:text-gray-900">
                            Login
                        </a>
                        <a href="/register" class="py-2 px-4 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition duration-300">
                            Register
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Welcome to Our Articles Place</h1>
            <p class="text-gray-600">This is the home page of our application.</p>
        </div>
    </div>
</body>
</html> 