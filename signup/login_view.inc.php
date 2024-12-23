<?php

declare(strict_types=1);

function check_login_errors(){
if(isset($_SESSION["errors_login"])){
    $errors=$_SESSION["errors_login"];
echo"<br>";
foreach($errors as $eror){
    echo "<p class='form-error'>". $eror  ."</p>";

}
    unset($_SESSION["errors_login"]);
}
else if(isset($_GET['login']) && $_GET['login']==='success')
{
    echo'<br>';
    echo "<p class='form-succes'>.Signup success!</p>";

}
}


