<?php
session_start();


if (isset($_POST["login"])) {
  include("conn.php");
  include_once('HelpingFunctions.php');

  $username = strtolower($_POST["login-username"]);
  $password = $_POST["login-password"];

  // sanitixe data
  $username = mysqli_real_escape_string($conn, $username);
  $password = mysqli_real_escape_string($conn, $password);

  // hashing password
  $password = md5($password);

  $select_query = "SELECT * from users where email = '$username' or username = '$username'";

  $select_query_run = mysqli_query($conn, $select_query);
  if ($select_query_run) {
    if (mysqli_num_rows($select_query_run) > 0) {
      $result_array = mysqli_fetch_assoc($select_query_run);

      if ($result_array['status'] == 1) {
        // username or email exist check for password
        if (strcmp($password, $result_array['password']) == 0) {
          $_SESSION['logged_in'] = true;
          $_SESSION['username'] = $result_array['username'];
          $_SESSION['email'] = $result_array['email'];
          $_SESSION['course_id'] = $result_array['course_id'];
          header('location: ../index.php');
          exit(0);
        } else {
          $_SESSION['status_message'] = 'Incorrect password!';
          $_SESSION['status_reaction'] = 'Error!';
          $_SESSION['status'] = 'error';
          header("Location: ../login.php");
          exit(0);
        }
      } else {

        $token = rand(10000, 99999);
        $username = $result_array['username'];
        $email = $result_array['email'];
        $update_query = "UPDATE users SET token = '$token' WHERE email = '$email'";
        $update_query_run = mysqli_query($conn, $update_query);

        sendEmailVerify($username, $email, $token);
        header("Location: OtpForm.php?email=$email");
        exit(0);

      }
    } else {

      // if username not exist in users table check for admin login
      $select_admin = "SELECT * FROM admin WHERE email = '$username' or username = '$username'";
      $select_admin_run = mysqli_query($conn, $select_admin);
      if (mysqli_num_rows($select_admin_run) > 0) {
        $result_array = mysqli_fetch_array($select_admin_run);
        if (strcmp($password, $result_array['password']) == 0) {
          $_SESSION['admin_logged_in'] = true;
          $_SESSION['admin_username'] = $result_array['username'];
          $_SESSION['admin_email'] = $result_array['email'];
          header('location: ../../Admin/index.php');
          exit(0);
        }
      }
      $_SESSION['status_message'] = "Username does not exist, please signup before login!";
      $_SESSION['status_reaction'] = 'Oops!';
      $_SESSION['status'] = 'error';
      header("Location: ../login.php");
      exit(0);
    }

  } else {
    $_SESSION['status_message'] = 'Something went wrong, please try again later!';
    $_SESSION['status_reaction'] = 'Oops!';
    $_SESSION['status'] = 'error';
    header("Location: ../login.php");
    exit(0);
  }
}

?>