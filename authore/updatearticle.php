<?php require_once '../signup/dbh.inc.php'; 

include '../signup/header_author.php';
require_once 'add_view.php';
require_once '../signup/config_seesion.inc.php';  
if (!isset($_SESSION['user_id'])) {
    header('Location: ../signup/sign_index.php?error=unauthorized');
    exit();
}

if($_SERVER['REQUEST_METHOD']==='POST'){


    $art_id=$_POST['id'];
    $url_img=$_POST['url_img'];
    $contnt=$_POST['content'];
$title=$_POST['title'];

try{
    $sql = 'UPDATE article  SET title = :ttl, 
     content = :cnt, 
        url_img = :img 
    WHERE id = :id;';


$stmt=$pdo->prepare($sql);
$stmt->bindParam(':id',$art_id,PDO::PARAM_INT);
$stmt->bindParam(':ttl',$title);
$stmt->bindParam(':img',$url_img);
$stmt->bindParam(':cnt',$contnt);
$stmt->execute();


header('location:../authore/dashbord.php');
exit();

}
catch(PDOException $e){
    echo 'did not work' . $e->getMessage();
}

}