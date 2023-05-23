<?php
session_start();
include_once('../Includes/conn.php');

// for checking if we get id in url
if (isset($_GET['id']) && isset($_GET['delete-btn'])) {
    $id = $_GET['id'];

    // for deleting videos which are with this semester
    $delete_video = "DELETE FROM users WHERE id = '$id'";
    if (mysqli_query($conn, $delete_video)) {
        $_SESSION['status_message'] = "User Deleted Successfully!";
        $_SESSION['status_reaction'] = 'Done!';
        $_SESSION['status'] = 'success';
        header("Location: ../index.php");
        exit(0);
    } else {
        echo "can't delete4";
    }
} else {
    $_SESSION['status_message'] = "Something went wrong!";
    $_SESSION['status_reaction'] = 'Oops!';
    $_SESSION['status'] = 'error';
    header("Location: ../index.php");
    exit(0);
}
?>