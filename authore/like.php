<?php
require_once '../signup/dbh.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['article_id'])) {
        $article_id = (int)$_POST['article_id'];

        $stmt = $pdo->prepare("SELECT * FROM likes WHERE article_id = :article_id");
        $stmt->bindParam(':article_id', $article_id, PDO::PARAM_INT);
        $stmt->execute();
        $like = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($like) {
            $stmt_update = $pdo->prepare("UPDATE likes SET number_likes = number_likes + 1 WHERE article_id = :article_id");
            $stmt_update->bindParam(':article_id', $article_id, PDO::PARAM_INT);
            $stmt_update->execute();
        } else {
            $stmt_insert = $pdo->prepare("INSERT INTO likes (article_id, number_likes) VALUES (:article_id, 1)");
            $stmt_insert->bindParam(':article_id', $article_id, PDO::PARAM_INT);
            $stmt_insert->execute();
        }

        header("Location: article.php?id=$article_id");
        exit();
    } else {
        echo "Error: Article ID not provided.";
    }
} else {
    echo "Error: Invalid request method.";
}
?>
