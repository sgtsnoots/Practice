<?php
require_once 'app/init.php';

if($_GET['delete'] && isset($_GET['item'])){

   $id =  $_GET['item'];
   

    $deleteQuery = $db->prepare("
    DELETE 
    FROM todo_list
    WHERE id = :id
    AND user = :user LIMIT 1
    ");

    $deleteQuery->execute([
        'id' => $id,
        'user' => $_SESSION['user_id']
    ]);

}

header('Location: index.php');
?>