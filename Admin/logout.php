<?php 
session_start();

if(isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] == true){
    session_unset();
    session_destroy();

    header("Location: ../Client/login.php");
    exit(0);
}else{
    header("Location: ../Client/login.php");
    exit(0);
}

?>