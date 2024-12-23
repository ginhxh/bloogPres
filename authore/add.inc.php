<?php
require_once '../signup/config_seesion.inc.php';  
 if (!isset($_SESSION['user_id'])) {
    header('Location: ../signup/sign_index.php?error=unauthorized');
   exit();
 }
$session_id=$_SESSION['user_id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title =$_POST['title'];
    $url_img=$_POST['url_img'];
     $content_txt=$_POST['content'];
     $author_id = $session_id;

     echo $session_id;

try{

    require_once'../signup/dbh.inc.php';
    require_once'add_model.php';

    require_once'add_contr.php';
$errors=[];
$title = trim($_POST['title']);
$content_txt = trim($_POST['content']);
if( isinput_empty($title,$content_txt,$url_img)){
    $errors['empty_input']='fill in all fildes';
        }
        if($errors){
            $_SESSION['errors_post']=$errors;
     
            header("location:../authore/creat_post.php?post=failed");
exit();
            die();
        
        }
        creat_post($pdo, $title, $content_txt,  $author_id,$url_img);
        header("location:../authore/creat_post.php?post=sucesses");

        $pdo=null;
        $stmt=null;
        die();

}
catch(PDOException $e){

die('Query failed '.$e->getMessage());

}}
else{
    header("location:creat_post.php");
    die();
}
