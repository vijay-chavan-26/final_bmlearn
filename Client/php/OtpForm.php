<?php
session_start();

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
    header("Location: index.php");
    exit(0);
}

if(isset($_GET['email'])){
    include_once('conn.php');
    include_once('HelpingFunctions.php');
    
    // if verified user tries to come on this redirect to login with msg
    $email = $_GET['email'];
    $verify_query = "SELECT * FROM users WHERE email = '$email' LIMIT 1" ;
    $verify_query_run = mysqli_query($conn, $verify_query);

    if(!$verify_query_run){
        $_SESSION['status_message'] = 'Invalid Details, please verify your details!';
        $_SESSION['status_reaction'] = 'Error!';
        $_SESSION['status'] = 'error';
        header("Location: ../login.php");
        exit(0);
    }

    $row = mysqli_fetch_array($verify_query_run);
    if($row['status'] == 1){
        $_SESSION['status_message'] = 'Your account has been already verified, please login!';
        $_SESSION['status_reaction'] = 'Done!';
        $_SESSION['status'] = 'warning';
        header("Location: ../login.php");
        exit(0);
    }

    
    // if submit otp button pressed
    if (isset($_POST['otp-btn'])) {

        $email = $_GET['email'];
        $otp = $_POST['otp'];

        $verify_query = "SELECT * FROM users WHERE email = '$email' LIMIT 1" ;
        $verify_query_run = mysqli_query($conn, $verify_query);

        $row = mysqli_fetch_array($verify_query_run);

        if($row['status'] == 0){
            $token = $row['token'];
            $username = $row['username'];

            if($token == $otp){
                $update_query = "UPDATE users SET status = 1 WHERE email = '$email'";
                $update_query_run = mysqli_query($conn, $update_query);
                if($update_query_run){
                    sendAccountCreatedEmail($username, $email);

                    $_SESSION['status_message'] = 'Your Account created successfully, please login with your credentials';
                    $_SESSION['status_reaction'] = 'Wow!';
                    $_SESSION['status'] = 'success';
                    $token = rand(10000, 99999);

                    $update_query = "UPDATE users SET token = '$token' WHERE email = '$email'";
                    $update_query_run = mysqli_query($conn, $update_query);                    

                }else{
                    $_SESSION['status_message'] = 'Verification Failed!';
                    $_SESSION['status_reaction'] = 'Oops!';
                    $_SESSION['status'] = 'error';
                }
                header("Location: ../login.php");
                exit(0);

            }else{
                $_SESSION['status_message'] = 'You Entered Wrong OTP!';
                $_SESSION['status_reaction'] = 'Oops!';
                $_SESSION['status'] = 'error';

                header("Location: OtpForm.php?email=$email");
                exit(0);
            }   
        }else{
            $_SESSION['status_message'] = 'Your account has been already verified, please login!';
            $_SESSION['status_reaction'] = 'Done!';
            $_SESSION['status'] = 'warning';
            header("Location: ../login.php");
            exit(0);
        }
    }

    // if resend otp link clicked
    if (isset($_POST['resend-otp'])) { 

        $email = $_GET['email'];
        $verify_query = "SELECT * FROM users WHERE email = '$email' and status = 0 LIMIT 1" ;
        $verify_query_run = mysqli_query($conn, $verify_query);
        
        if($verify_query_run > 0){
            $row = mysqli_fetch_array($verify_query_run);
            $token = rand(10000, 99999);
            $username = $row['username'];
            
            $update_query = "UPDATE users SET token = '$token' WHERE email = '$email'";
            $update_query_run = mysqli_query($conn, $update_query);
            if($update_query_run){
                sendEmailVerify($username, $email, $token);
                $_SESSION['status_message'] = 'OTP Sent on your email, please check email!';
                $_SESSION['status_reaction'] = 'Done!';
                $_SESSION['status'] = 'success';    
            }else{
                $_SESSION['status_message'] = 'Request Failed!';
                $_SESSION['status_reaction'] = 'Oops!';
                $_SESSION['status'] = 'error';    
            }
            header("Location: OtpForm.php?email=$email");
            exit(0);
        }else{
            $_SESSION['status_message'] = 'Entered Wrong Email!';
            $_SESSION['status_reaction'] = 'Error!';
            $_SESSION['status'] = 'error';    
            header("Location: ../login.php");
            exit(0);

        }

    }
    

}else{
    header("Location: ../login.php");
    exit(0);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- bootstrap links for css and js -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../js/bootstrap.min.js">

    <!-- font awesome link -->
    <link rel="stylesheet" href="../css/all.css">

    <!-- sweet alert js -->
    <script src="../js/SweetAlert.js"></script>

    <!-- custom css files -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/utility_classes.css">
    <link rel="stylesheet" href="../css/Navbar.css">
    <link rel="stylesheet" href="../css/LoginAndSignupForm.css">

    <!-- custom js files -->
    <script src="../js/Navbar.js" defer></script>
    <script src="../js/LoginAndSignupForm.js" defer></script>
    <script src="../js/LoginFormValidation.js" defer></script>

    <title>Client side</title>
</head>

<body>
    <div id="login-form-page" class="py-5 position-relative min-h-90">
        <div class="form-wrapper mx-auto form-wrapper-width bg-white py-5 px-3 px-md-5 shadow">
            <h1 class="heading text-center text-muted mb-3">Verify Your Account</h1>
            <div class="desc text-center mb-5">Check your email for OTP</div>

            <div class="otp-form-container">
                <form action="OtpForm.php?email=<?=$_GET['email']; ?>" onsubmit="return validateOtpSubmit()" autocomplete="off" class="otp-form"
                    method="post">

                    <!-- input for OTP -->
                    <div class="otp input-box bg-eee w-100 d-flex align-items-center mb-3">
                        <input class="inputs text-center py-3 w-100 px-3 otp-input" id="otp" name="otp"
                            autocomplete="off" autocorrect="off" spellcheck="flase" type="text" readonly
                            placeholder="One Time Password" onfocus="this.removeAttribute('readonly')" autofocus>
                    </div>

                    <input type="submit" value="submit otp" name="otp-btn"
                        class=" mt-4 otp-submit-btn text-white py-3 border w-100">

                    </form>
                    <form action="OtpForm.php?email=<?=$_GET['email']; ?>" method="post" onsubmit="return submitResendOtpForm()">
                        <input type="hidden" name="email" value="<?php $_GET['email']; ?>">
                        <h6 class='mt-4'>Didn't recieve OTP?  
                        <input type="submit" class="link theme-color h6 bg-transparent border-0 " style="text-decoration:underline;" name="resend-otp" value="Resend OTP">
                        </h6>
                    </form>
            </div>
        </div>
        <div id="preloader" class="d-none">
            <div class="img text-center">
                <img src="../img/preloader.gif" alt="preloader img">
                <h4 class="mt-3 fa-fade">Loading...</h4>
            </div>
    
        </div>
    </div>

    <?php
if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
    ?>
    <script>
        console.log('<?php echo $_SESSION['status_reaction']; ?>', '<?php echo $_SESSION['status_message']; ?>', '<?php echo $_SESSION['status']; ?>')
        swal('<?php echo $_SESSION['status_reaction']; ?>', '<?php echo $_SESSION['status_message']; ?>', '<?php echo $_SESSION['status']; ?>');
    </script>
    <?php
    unset($_SESSION['status']);
}
?>
    
    <?php include_once('../Components/Footer.html') ?>