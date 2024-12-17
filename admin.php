<?php
session_start();


require "config.php";
require "function.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["title"]) &&  isset($_POST["message"])) {
        push_article($pdo, $_POST["title"], $_POST["message"]);
    }
}

if(isset($_GET["status"])){
    if($_GET["status"] === "del") {
        del_article($pdo, $_GET["id"]);
    }
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
    <div>
        <a href="index.php?deco=deco">Déconnexion</a>
        <h1>Ajouter un article</h1>
        <form action="" method="POST">
            <label for="title">Titre de l'article : </label>
            <input type="text" name="title">
            <label for="message">Contenu : </label>
            <input type="text" name="message">
            <input type="submit">
        </form>
    </div>
    <?php foreach ($articles as $article): ?>
        <div>
            <h2><?= htmlspecialchars($article["title"]) ?></h2>
            <p><?= htmlspecialchars($article["content"]) ?></p>
            <p><?= htmlspecialchars($article["created_at"]) ?></p>
            <a href="article.php?id=<?=$article['id']?>">Lire plus</a>
            <a href="modify.php?title=<?=$article['title']?>&id=<?=$article['id']?>">Modifier l'article</a>
            <a href="admin.php?status=del&id=<?=$article['id']?>">Supprimer l'article</a>
        </div>
    <?php endforeach; ?>
</body>
</html>