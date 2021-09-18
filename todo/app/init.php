<?php 

session_start();

$_SESSION['user_id'] = 1;

$db = new PDO('mysql:dbname=jay_data;host=localhost', 'root', 'password');

//garbage seceruity
if(!isset($_SESSION['user_id'])) {
    die('youre not signed in');
}

?>