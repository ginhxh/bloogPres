<?php

declare(strict_types=1);


function get_username(object $pdo, string $username)
{

$query='SELECT username FROM author where username= :username;';
$stmt=$pdo->prepare($query);
$stmt->bindParam(':username', $username);

$stmt->execute();
$result=$stmt->fetch(PDO::FETCH_ASSOC);
return $result;

}
function get_email(object $pdo,string $email){
    $query='SELECT username FROM author where email= :email;';
$stmt=$pdo->prepare($query);
$stmt->bindParam(':email', $email);
$stmt->execute();
$result=$stmt->fetch(PDO::FETCH_ASSOC);
return $result;

}

function set_user (object $pdo,string $username,string $pwd, string $email){




    $query='INSERT into author  (username,pwd,email)
    VALUES (:username, :pwd, :email);';
    $stmt=$pdo->prepare($query);
$option=[
    'cost' => 12
];
$hashedpwd=password_hash($pwd,PASSWORD_BCRYPT,$option);


$stmt->bindParam(':username', $username);
    $stmt->bindParam(':pwd', $hashedpwd);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result=$stmt->fetch(PDO::FETCH_ASSOC);
    return $result;




}

