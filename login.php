<?php
session_start();


require "config.php";
require "function.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["username"]) && strlen($_POST["username"]) < 50 && isset($_POST["password"]) && strlen($_POST["password"]) < 255) {
        connexion($pdo, $_POST["username"], $_POST["password"]);
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
    <a href="index.php">Blog</a>
    <form action="" method="post">
        <label for="username">Username : </label>
        <input type="text" name="username">
        <label for="password">Password : </label>
        <input type="password" name="password">
        <input type="submit">
    </form>
</body>
</html>