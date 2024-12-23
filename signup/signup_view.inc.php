<?php

declare(strict_types=1);

function signup_inputs(){

if(isset($_SESSION['signup_data']['username'])&& !isset($_SESSION['error_signup']['username_taken'])){
echo '<input type="text" name="username" placeholder="Username" value="'. $_SESSION['signup_data']['username'] .'">'
;}else{
echo '<input type="text" name="username" placeholder="Username">';}

echo '<input type="password" name="pwd" placeholder="Password">';

if(isset($_SESSION['signup_data']['email'])&& !isset($_SESSION['error_signup']['email_taken'])&& !isset($_SESSION['error_signup']['invalid_email'])){
    echo  '<input type="text" name="email" placeholder="E-mail" value="'. $_SESSION['signup_data']['email'] .'">'
    ;
 }else{
            echo '<input type="text" name="email" placeholder="email">'    ;
        }
    }


function check_signup_errors(){
if(isset($_SESSION['error_signup'])){
$errores=$_SESSION['error_signup'];
echo'<br>';
foreach($errores as $erorr){
    echo "<p class='form-error'>". $erorr  ."</p>";
}
unset($_SESSION['error_signup']);
}
else if(isset($_GET['signup'])&& $_GET['signup']==='success' ){
    echo'<br>';
    echo "<p class='form-succes'>. Signup success!</p>";

}

}

