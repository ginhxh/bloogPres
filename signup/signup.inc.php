<?php
echo "test";
var_dump($_POST);

if($_SERVER['REQUEST_METHOD']==='POST'){
    $username=$_POST['username'];
    $pwd=$_POST['pwd'];
    $email=$_POST['email'];

try{


    require_once'dbh.inc.php';
    require_once'signup_model.inc.php';

    require_once'signup_contr.inc.php';

    /////error handlers


    $errores=[];
    if( isinput_empty($username,$pwd,$email)){
$errores['empty_input']='fill in all fildes';
    }
    if (isemail_invalid($email)){
        $errores['invalid_email']='invalid_email useed';

    }
    if (is_username_taken( $pdo, $username)){
        $errores['username_taken']='sorry username taken';

    }
    if (is_email_taken( $pdo,  $email)){
        $errores['email_taken']='sorry email alerday register';

    }
    require_once'config_seesion.inc.php';
    if($errores){
        $_SESSION['error_signup']=$errores;
 
    $signupData=[
'username'=>$username,
'email'=>$email];
$_SESSION['signup_data']=$signupData;


        header('location:./sign_index.php');
        die();
    
    }

    creat_user($pdo, $username, $pwd,  $email);


    header('location: sign_index.php?signup=success');
$pdo=null;
$stmt=null;
die();
}
catch(PDOException $e){
    die('Query failed' . $e-> getMessage());
}

}
else{

header('location: sign_index.php');
die();
}