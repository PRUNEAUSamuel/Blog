<?php


require "config.php";
require "function.php";

$id = $_GET["id"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["title"]) &&  isset($_POST["message"])) {
        echo "yo";
        modify_article($pdo, $id, $_POST["title"], $_POST["message"]);
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Modifier l'article <?= $_GET["title"] ?></h1>
    <form action="" method="post">
        <label for="title">Nouveau Titre : </label>
        <input type="text" name="title">
        <label for="message">Nouveau Contenu : </label>
        <input type="text" name="message">
        <input type="submit">
    </form>
</body>
</html>