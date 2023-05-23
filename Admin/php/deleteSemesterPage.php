<?php
session_start();
include_once('../Includes/conn.php');

// for checking if we get id in url
if (isset($_GET['id']) && isset($_GET['delete-btn'])) {
    $id = $_GET['id'];

    // for deleting videos which are with this semester
    $delete_video = "DELETE FROM video WHERE subject_id IN (SELECT id from subject where semester_id = '$id')";
    if (mysqli_query($conn, $delete_video)) {

        // for deleting subject which are with this semester
        $delete_subject = "DELETE FROM subject WHERE semester_id = '$id'";
        if (mysqli_query($conn, $delete_subject)) {

            // for deleting images of semesters which is been uploaded
            $result_array = mysqli_query($conn, "SELECT * FROM semester WHERE id = '$id'");
            if ($result_array && mysqli_num_rows($result_array) > 0) {
                $row = mysqli_fetch_array($result_array);
                $file_path = $row['img_path'];
                unlink('../../' . $file_path);
            }

            // for deleting semesters which are with this course
            $delete_semester = "DELETE FROM semester WHERE id ='$id'";
            if (mysqli_query($conn, $delete_semester)) {

                $_SESSION['status_message'] = "Semester Deleted Successfully!";
                $_SESSION['status_reaction'] = 'Done!';
                $_SESSION['status'] = 'success';
                header("Location: ../semesters.php");
                exit(0);
            } else {
                echo "can't delete2";
            }
        } else {
            echo "can't delete3";
        }

    } else {
        echo "can't delete4";
    }
} else {
    $_SESSION['status_message'] = "Something went wrong!";
    $_SESSION['status_reaction'] = 'Oops!';
    $_SESSION['status'] = 'error';
    header("Location: ../semesters.php");
    exit(0);
}
?>