<?php
require_once '../signup/config_seesion.inc.php';  
require_once '../signup/dbh.inc.php'; 

if (!isset($_SESSION['user_id'])) {
    header('Location: ../signup/sign_index.php?error=unauthorized');
    exit();
}

include '../signup/header_author.php';

if($_SERVER['REQUEST_METHOD']==='GET'){

$article_id=$_GET['id'];

try{
    $sql = "DELETE FROM commentes WHERE article_id = :article_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':article_id', $article_id, PDO::PARAM_INT);
    $stmt->execute();
    $sql = "DELETE FROM likes WHERE article_id = :article_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':article_id', $article_id, PDO::PARAM_INT);
    $stmt->execute();
   

$sql='DELETE from article WHERE id=:id';
$stmt=$pdo->prepare($sql);
$stmt->bindParam('id',$article_id, PDO::PARAM_INT);
$stmt->execute();

echo 'deleted done';
header('location:../authore/dashbord.php');
exit();

}catch(PDOException $e){

    echo 'connection failed' . $e->getMessage();
}

}