<?php

session_start();

require "config.php";
require "function.php";

if(isset($_GET["deco"])) {
    session_unset();
    session_destroy();
    session_start();
}



if (isset($_SESSION["username"])) {
    header("Location: admin.php?status=connected");
}

$articles = get_articles($pdo);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <h1>Mon Blog</h1>
        <a href="login.php">Connexion Admin</a>
    </header>
    <?php foreach ($articles as $article): ?>
        <div>
            <h2><?= htmlspecialchars($article["title"]) ?></h2>
            <p><?= htmlspecialchars($article["content"]) ?></p>
            <p><?= htmlspecialchars($article["created_at"]) ?></p>
            <a href="article.php?id=<?=$article['id']?>">Lire plus</a>
        </div>
    <?php endforeach; ?>
</body>
</html>