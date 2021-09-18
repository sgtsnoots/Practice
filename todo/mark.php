<?php

require_once 'app/init.php';

if(isset($_GET['as'], $_GET['item'])) {
    $as   = $_GET['as'];
    $item = $_GET['item']; 

    switch($as) {
        case 'done' :
            $doneQuery = $db->prepare("
                UPDATE todo_list
                SET done = 1
                WHERE id = :item 
                AND user = :user LIMIT 1

            ");

            $doneQuery->execute([
                'item' => $item,
                'user' => $_SESSION['user_id']
            
            ]);
            break;
            //undo the cross off
        case 'notdone':
            $doneQuery = $db->prepare("
                UPDATE todo_list
                SET done = 0
                WHERE id = :item 
                AND user = :user LIMIT 1

            ");

            $doneQuery->execute([
                'item' => $item,
                'user' => $_SESSION['user_id']
            
            ]);
    }
}

header('Location: index.php');

?>