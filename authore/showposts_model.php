<?php

function get_postes(object $pdo): array {
    $query = 'SELECT * FROM `article` ORDER BY `article`.`views_count` DESC;';
    $stmt = $pdo->prepare($query);
   try{
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
return $result;
}
    catch(PDOException $e){ echo 'Database Error: ' . $e->getMessage();
        return [];
    
    }

    

  
}

