<?php

if (!isset ($_SESSION)){
    session_start();
}

$auth = $_SESSION['login'] ?? false;

$admin = $_SESSION['admin'];

if(!$auth){
    //header('Location: index.php');
    header('Location: http://www.selisar.com/portfolio/medidor/',TRUE, 301);
    exit();
}

?>