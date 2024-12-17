<?php
session_start();

require "config.php";
require "function.php";

if(isset($_GET["id"])) {
    $id = $_GET["id"];
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["author"]) && isset($_POST["comm"])) {
        push_commentaire($pdo, $id, $_POST["author"], $_POST["comm"]); 
    }
}

$article = get_article($pdo, $id);
$commentaires = get_article_commentaires($pdo, $id);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article</title>
</head>
<body>
    <a href="index.php">Blog</a>
    <h1><?= htmlspecialchars($article["title"]) ?></h1>
    <p><?= htmlspecialchars($article["content"]) ?></p>
    <p><?= htmlspecialchars($article["created_at"]) ?></p>
    <form action="" method="post">
        <label for="author">Auteur : </label>
        <input type="text" name="author" required>
        <label for="comm">Commentaire : </label>
        <input type="text" name="comm" required>
        <input type="submit">
    </form>
    <?php if (isset($commentaires)) {
        foreach ($commentaires as $commentaire) {
            echo "<h3>" . htmlspecialchars($commentaire["author"]) . "</h3>";
            echo "<p>" . htmlspecialchars($commentaire["content"]) . "</p>";
            echo "<p>" . htmlspecialchars($commentaire["created_at"]) . "</p>";
        }
    }
    ?>
</body>
</html>