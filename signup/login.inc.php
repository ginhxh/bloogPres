<?php 
if($_SERVER['REQUEST_METHOD']==="POST"){
    $username=$_POST['username'];
    $pwd=$_POST['pwd'];
try{
    require_once'dbh.inc.php';
    require_once'login_model.inc.php';
    require_once'login_contr.inc.php';



        /////error handlers


        $errores=[];
        if( is_input_empty($username,$pwd)){
    $errores['empty_input']='fill in all fildes';
        }
    
        $results=get_user($pdo,$username);
        
        if(is_username_wrong($results)){
            $errores['login_icorrect']='incorrect login info';
        }
        if (!is_username_wrong($results) && is_pwd_wrong($pwd, $results['pwd'])) {


            $errores['login_incorrect'] = 'incorrect password';
        }
        



        require_once'config_seesion.inc.php';
        if($errores){
            $_SESSION['errors_login']=$errores;
     
    
            header('location:sign_index.php');
            die();
        
        }

        $newsession_id=session_create_id();
        $session_id=$newsession_id. "_" .$results["id"];

        session_id($session_id);


        $_SESSION['user_id']=$results["id"];
        $_SESSION['user_username']= htmlspecialchars($results["username"]);
        $_SESSION['last_regenertion']=time();

        header("location:../authore/dashbord.php?login=success");

$pdo=null;
$stmt=null;
die();
}
catch(PDOException $e){
die("Query failed:".$e->getMessage());
}

}
else{
    header("location:sign_index.php");
    die();
}





?>