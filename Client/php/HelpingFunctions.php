<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';
function sendEmailVerify($username, $email, $token)
{
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    // $mail->SMTPDebug = 2;
    $mail->SMTPAuth = true;

    $mail->Host = 'smtp.gmail.com';
    $mail->Username = 'semvproject.ty@gmail.com';
    $mail->Password = 'tpslclkrcexboolv';

    $mail->SMTPSecure = 'ssl'; //Enable implicit TLS encryption
    $mail->Port = 465;

    $mail->setFrom('semvproject.ty@gmail.com', 'BMLearn');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Email Verification From BMLearn';

    $email_template = "
    <!DOCTYPE html>
<html>
  <head>
    <meta charset='UTF-8'>
    <title>Email OTP Verification</title>
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

      body {
        font-family: 'Poppins', sans-serif;
        background-color: #f2f2f2;
        text-align: center;
        padding: 50px 0;
      }

      .container {
        width: 80%;
        margin: 0 auto;
        text-align: left;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 40px;
      }

      h1 {
        font-size: 36px;
        font-weight: 600;
        margin-bottom: 20px;
        color: #333;
      }

      p {
        font-size: 18px;
        line-height: 1.5;
        color: #555;
        margin-bottom: 20px;
      }

      h2 {
        font-size: 24px;
        font-weight: 500;
        background-color: #ddd;
        padding: 10px 20px;
        border-radius: 5px;
        margin: 20px 0;
        display: inline-block;
        text-align: center;
      }

      .footer {
        margin-top: 30px;
        font-size: 14px;
        color: #999;
        text-align: center;
      }
    </style>
  </head>
  <body>
    <div class='container'>
      <h1>Email OTP Verification</h1>
      <p>Dear username,</p>
      <p>Please use the following code to verify your email address:</p>
      <h2>$token</h2>
      <p>If you did not initiate this request, please contact our support team immediately.</p>
      <p>Thank you for using our service!</p>
      <p>Best regards,</p>
      <p>BMLearn</p>
      <div class='footer'>&copy; BMLearn 2023.</div>
    </div>
  </body>
</html>

  
    ";

    $mail->Body = $email_template;
    $mail->Send();
}

function sendAccountCreatedEmail($username, $email)
{
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    // $mail->SMTPDebug = 2;
    $mail->SMTPAuth = true;

    $mail->Host = 'smtp.gmail.com';
    $mail->Username = 'semvproject.ty@gmail.com';
    $mail->Password = 'tpslclkrcexboolv';

    $mail->SMTPSecure = 'ssl'; //Enable implicit TLS encryption
    $mail->Port = 465;

    $mail->setFrom('semvproject.ty@gmail.com', 'BMLearn');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Account created Successfully';

    $email_template = "
    <!DOCTYPE html>
    <html>
      <head>
        <meta charset='UTF-8'>
        <title>Account Creation Successful</title>
        <style>
          @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');
    
          body {
            font-family: 'Poppins', sans-serif;
            background-color: #f2f2f2;
            text-align: center;
            padding: 50px 0;
          }
    
          .container {
            width: 80%;
            margin: 0 auto;
            text-align: left;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
          }
    
          h1 {
            font-size: 36px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #333;
          }
    
          p {
            font-size: 18px;
            line-height: 1.5;
            color: #555;
            margin-bottom: 20px;
          }
    
          .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #999;
            text-align: center;
          }
        </style>
      </head>
      <body>
        <div class='container'>
          <h1>Account Creation Successful</h1>
          <p>Dear $username,</p>
          <p>We are happy to inform you that your account has been created successfully!</p>
          <p>You can now log in to our platform and start using our services.</p>
          <p>Thank you for choosing StreamX. If you have any questions or concerns, please don't hesitate to contact us.</p>
          <p>Best regards,</p>
          <p>BMLearn</p>
          <div class='footer'>&copy; StreamX 2023</div>
        </div>
      </body>
    </html>
    
    ";

    $mail->Body = $email_template;
    $mail->Send();
}