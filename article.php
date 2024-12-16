<?php

require "config.php";
require "function.php";

$article = get_article($pdo, $_GET["id"]);
$commentaires = get_commentaires($pdo, $_GET["id"]);

var_dump($commentaires);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article</title>
</head>
<body>
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