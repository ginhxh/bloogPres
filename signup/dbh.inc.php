<?php
$dsn='mysql:host=localhost;dbname=bloog';
$dbusername='toto';
$dbpassword='';
try{
$pdo=new PDO($dsn,$dbusername,$dbpassword);
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){
    die('connection failed' . $e-> getMessage());
}