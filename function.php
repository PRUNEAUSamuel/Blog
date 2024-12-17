<?php


require "config.php";


function get_articles($pdo) {
    $affichage = $pdo->query("SELECT id, title, SUBSTR(content, 1, 20) AS content, created_at FROM articles");
    return $affichage->fetchAll(PDO::FETCH_ASSOC);
}

function get_article($pdo, $id) {
    $affichage = $pdo->prepare("SELECT title, content, created_at FROM articles WHERE id = :id");
    $affichage->execute([":id" => $id]);
    return $affichage->fetch();
}

function get_article_commentaires($pdo, $id) {
    $affichage = $pdo->prepare("SELECT author, content, created_at FROM comments WHERE article_id = :id");
    $affichage->execute([":id" => $id]);
    return $affichage->fetchAll(PDO::FETCH_ASSOC);
}

function push_commentaire($pdo, $id, $author, $comm) {
    $comm_req = $pdo->prepare("INSERT INTO comments (article_id, author, content) VALUES (:id, :author, :content)");
    $comm_req->execute([":id" => $id, ":author" => $author, ":content" => $comm]);
    header("Location: article.php?id=" . $id . "&status=added");
}

function connexion($pdo, $username, $password) {
    $connexion_req = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $connexion_req->execute([":username" => $username]);
    $user = $connexion_req->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["username"] = $username;
        header("Location: admin.php");
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }
}

function push_article($pdo, $title, $message){
    $article_req = $pdo->prepare("INSERT INTO articles (title, content) VALUES (:title, :content)");
    $article_req->execute([":title" => $title, ":content" => $message]);
    header("Location: admin.php?status=added");
}

function del_article($pdo, $id){
    $del_comm_req = $pdo->prepare("DELETE FROM comments WHERE article_id = :id");
    $del_comm_req->execute([":id" => $id]);
    $del_article_req = $pdo->prepare("DELETE FROM articles WHERE id = :id");
    $del_article_req->execute([":id" => $id]);
}

function modify_article($pdo, $id, $title, $message){
    $modify_req = $pdo->prepare("UPDATE articles SET title = :title, content = :message WHERE id = :id");
    $modify_req->execute([":id" => $id, ":title" => $title, ":message"=> $message]);
    header("Location: admin.php?status=modified");
}