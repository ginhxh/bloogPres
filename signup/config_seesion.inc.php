<?php
ini_set('session.use_only_cookies',1);
ini_set('session.use_strict_mode',1);

session_set_cookie_params([
    'lifetime'=>1800,
    'domain'=>'localhost',
    'path'=>'/',
    'secure'=>true,
    'httponly'=>true
]);
session_start();
if(isset($_SESSION['user_id'])){

    if(!isset($_SESSION['last_regenertion']))
{
    rgenert_session_id_loggedin();

}
else{
    $interval=60*30;
    if(time()-$_SESSION['last_regenertion']>=$interval)
    {
        rgenert_session_id_loggedin();
    }
}
}
else{if(!isset($_SESSION['last_regenertion']))
    {
        rgenert_session_id();
    
    }
    else{
        $interval=60*30;
        if(time()-$_SESSION['last_regenertion']>=$interval)
        {
            rgenert_session_id();
        }
    }}






    function  rgenert_session_id_loggedin(){
        session_regenerate_id(true);
        $userID=$_SESSION['user_id'];
        $newsession_id=session_create_id();
        $session_id=$newsession_id. "_" .  $userID;

        session_id($session_id);
        $_SESSION['last_regenertion']=time();
    }

function rgenert_session_id(){
    session_regenerate_id(true);
    $_SESSION['last_regenertion']=time();
}