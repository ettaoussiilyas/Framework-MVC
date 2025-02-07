<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Admin Navigation -->
    <nav class="bg-gray-800 text-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-xl font-bold">Admin Panel</span>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="/admin/dashboard" class="px-3 py-2 rounded-md hover:bg-gray-700">Dashboard</a>
                    <a href="/admin/articles" class="px-3 py-2 rounded-md hover:bg-gray-700">Articles</a>
                    <a href="/admin/users" class="px-3 py-2 rounded-md hover:bg-gray-700">Users</a>
                    <a href="/logout" class="px-3 py-2 bg-red-600 rounded-md hover:bg-red-700">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 py-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Stats Cards -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-xl font-semibold mb-2">Total Users</h3>
                <p class="text-3xl font-bold text-blue-600">5</p>
            </div>
            
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-xl font-semibold mb-2">Total Articles</h3>
                <p class="text-3xl font-bold text-green-600">10</p>
            </div>
            
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-xl font-semibold mb-2">New Users Today</h3>
                <p class="text-3xl font-bold text-purple-600">2</p>
            </div>
        </div>
    </div>
</body>
</html>
