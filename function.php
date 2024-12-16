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

function get_commentaires($pdo, $id) {
    $affichage = $pdo->prepare("SELECT author, content, created_at FROM comments WHERE article_id = :id");
    $affichage->execute([":id" => $id]);
    return $affichage->fetchAll(PDO::FETCH_ASSOC);
}