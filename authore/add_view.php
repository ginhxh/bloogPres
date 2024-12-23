<?php
declare(strict_types=1);
function check_post_errors(){

if(isset($_SESSION["errors_post"])){
    $erores=$_SESSION["errors_post"];

echo"<br>";
foreach($erores as $error){

    echo "<p class='post-errore'>". $error  ."</p>";

}    unset($_SESSION["errors_post"]);



}else if(isset($_GET['post'])&&$_GET['post']==='success'){
    echo "<p class='post-succes'>.post success!</p>";

}
}