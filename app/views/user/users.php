<!DOCTYPE html>
<html>
<head>
    <title>Users List</title>
</head>
<body>
    <h1>Users and Their Articles</h1>
    
    <?php foreach($users as $user): ?>
        <div class="user">
            <h2><?= htmlspecialchars($user->name) ?></h2>
            <p>Email: <?= htmlspecialchars($user->email) ?></p>
            
            <h3>Articles:</h3>
            <ul>
                <?php foreach($user->articles as $article): ?>
                    <li>
                        <?= htmlspecialchars($article->title) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endforeach; ?>
</body>
</html> 