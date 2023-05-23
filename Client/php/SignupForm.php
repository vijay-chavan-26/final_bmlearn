<?php
session_start();

if (isset($_POST["signup"])) {
    include_once('conn.php');
    include_once('HelpingFunctions.php');

    $username = strip_tags($_POST["username"]);
    $email = strip_tags($_POST["email"]);
    $course = strip_tags($_POST["course"]);
    $password = strip_tags($_POST["password"]);

    // sanitizing data
    $username = strtolower(mysqli_real_escape_string($conn, $_POST["username"]));
    $email = strtolower(mysqli_real_escape_string($conn, $_POST["email"]));
    $course = mysqli_real_escape_string($conn, $_POST["course"]);

    // encrypting password into md5
    $password = md5($password);
    $token = rand(10000, 99999);

    // sql query to check whether username and email are already exist or not
    $check_username_and_email_query = "select * from users where username='$username' or email='$email'";
    $check_username_and_email_query = mysqli_query($conn, $check_username_and_email_query);


    if (mysqli_num_rows($check_username_and_email_query) > 0) {
        // if username or email already exist

        $row = mysqli_fetch_array($check_username_and_email_query);

        // to pop up a msg on login form that your account is not verified to very your account please login to get verification code
        if ($row['status'] == 0) {
            $_SESSION['status_message'] = 'please login with your credentials to get verification OTP!';
            $_SESSION['status_reaction'] = 'Not verified!';
            $_SESSION['status'] = 'info';
        } else {
            $_SESSION['status_message'] = 'Username or Email already exist!';
            $_SESSION['status_reaction'] = 'Opps!';
            $_SESSION['status'] = 'error';
        }

        header("Location: ../login.php");
        exit(0);
    } else {
        // if username and email both are new

        // insert user data into database
        $insert_query = "INSERT INTO users (username, email, course_id, password, token) VALUES ('$username', '$email', '$course', '$password', '$token')";

        $insert_query_run = mysqli_query($conn, $insert_query);
        if ($insert_query_run) {
            // if query runs successfully
            
            sendEmailVerify($username, $email, $token);
            header("Location: OtpForm.php?email=$email");
            exit(0);
            
        } else {
            // if query fails

            $_SESSION['status_message'] = 'Something went wrong!';
            $_SESSION['status_reaction'] = 'Error!';
            $_SESSION['status'] = 'error';

            header("Location: ../login.php");
            exit(0);
        }
    }

}