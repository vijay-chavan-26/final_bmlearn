<?php
session_start();
include_once('../Includes/conn.php');

// for checking if we get id in url
if (isset($_GET['id']) && isset($_GET['delete-btn'])) {
    $id = $_GET['id'];
    
    // for deleting videos which are with this course
    $delete_video = "DELETE FROM video WHERE subject_id IN (SELECT id from subject where semester_id IN (SELECT id from semester where course_id = '$id'))";
    if (mysqli_query($conn, $delete_video)) {

        // for deleting subject which are with this course
        $delete_subject = "DELETE FROM subject WHERE semester_id IN (SELECT id from semester where course_id = '$id')";
        if (mysqli_query($conn, $delete_subject)) {

            // for deleting semesters which are with this course
            $delete_semester = "DELETE FROM semester WHERE course_id ='$id'";
            if (mysqli_query($conn, $delete_semester)) {

                // for deleting users which are created account with this course
                $delete_course = "DELETE FROM users WHERE course_id ='$id'";
                if (mysqli_query($conn, $delete_course)) {

                    // for deleting images of courses which is been uploaded
                    $result_array = mysqli_query($conn, "SELECT * FROM course WHERE id = '$id'");
                    if($result_array && mysqli_num_rows($result_array) > 0){
                        $row = mysqli_fetch_array($result_array);
                        $file_path = $row['img_path'];
                        unlink('../../'.$file_path);
                    }
                    
                    // for deleting course
                    $delete_course = "DELETE FROM course WHERE id ='$id'";
                    if (mysqli_query($conn, $delete_course)) {
                        $_SESSION['status_message'] = "Course Deleted Successfully!";
                        $_SESSION['status_reaction'] = 'Done!';
                        $_SESSION['status'] = 'success';
                        header("Location: ../courses.php");
                        exit(0);
                    } else {
                        echo "cant delete0";
                    }
                } else {
                    echo "cant delete1";
                }
            } else {
                echo "can't delete2";
            }
        } else {
            echo "can't delete3";
        }

    } else {
        echo "can't delete4";
    }
}else{
    $_SESSION['status_message'] = "Something went wrong!";
    $_SESSION['status_reaction'] = 'Oops!';
    $_SESSION['status'] = 'error';
    header("Location: ../courses.php");
    exit(0);
}
?>