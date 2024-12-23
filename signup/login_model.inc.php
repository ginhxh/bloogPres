<?php

function get_user(object $pdo, string $username) {
    $query = 'SELECT * FROM author WHERE username = :username;';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
        echo "No user found for username: " . htmlspecialchars($username);
    }

    return $result;
    print_r($result);
}

