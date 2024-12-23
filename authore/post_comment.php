<?php
require_once '../signup/dbh.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['article_id'], $_POST['comment'], $_POST['vstr_name'])) {
    $article_id = (int)$_POST['article_id'];
    $comment = htmlspecialchars($_POST['comment']);
    $vstr_name = htmlspecialchars($_POST['vstr_name']);

    $stmt = $pdo->prepare("INSERT INTO commentes (article_id, comment,vstr_name) VALUES (:article_id, :comment, :vstr_name)");
    $stmt->bindParam(':article_id', $article_id, PDO::PARAM_INT);
    $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
    $stmt->bindParam(':vstr_name', $vstr_name, PDO::PARAM_STR);

    if ($stmt->execute()) {
        header("Location: article.php?id=" . $article_id);
        exit();
    } else {
        echo "Failed to post comment.";
    }
} else {
    header("Location: ../main_page.php");
    exit();
}
