<?php
session_start();
include_once('../Includes/conn.php');

// for checking if we get id in url
if (isset($_GET['id']) && isset($_GET['delete-btn'])) {
    $id = $_GET['id'];
    echo $id;

    // for deleting images of subjects which is been uploaded
    $result_array = mysqli_query($conn, "SELECT * FROM video WHERE id = '$id'");
    if ($result_array && mysqli_num_rows($result_array) > 0) {
        $row = mysqli_fetch_array($result_array);
        $file_path1 = $row['img_path'];
        $file_path2 = $row['video_path'];
        unlink('../../' . $file_path1);
        unlink('../../' . $file_path2);
    }

    // for deleting videos 
    $delete_video = "DELETE FROM video WHERE id = '$id'";
    if (mysqli_query($conn, $delete_video)) {
        $_SESSION['status_message'] = "Video Deleted Successfully!";
        $_SESSION['status_reaction'] = 'Done!';
        $_SESSION['status'] = 'success';
        header("Location: ../videos.php");
        exit(0);
    } else {
        echo "can't delete4";
    }
} else {
    $_SESSION['status_message'] = "Something went wrong!";
    $_SESSION['status_reaction'] = 'Oops!';
    $_SESSION['status'] = 'error';
    header("Location: ../videos.php");
    exit(0);
}
?>