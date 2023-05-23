<?php 
session_start();

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
    session_unset();
    session_destroy();

    header('location: login.php');
    exit;
}else{
    header("Location: index.php");
    exit(0);
}

?>