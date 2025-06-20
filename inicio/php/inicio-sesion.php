<?php

if (!isset ($_SESSION)){
    session_start();
}

$auth = $_SESSION['login'] ?? false;


if(!$auth){
    //header('Location: index.php');
    header('Location: http://www.selisar.com/portfolio/medidor/',TRUE, 301);
    exit();
}

?>