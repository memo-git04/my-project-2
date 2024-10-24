<?php
include_once "admin/config/db.php";
session_start();
$connect = doConnection();
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
if (isset($_POST['ForgotPassword'])) {
    // vẫn có key nhưng trống dữ liệu
    if (!empty($_POST['email'])) {
        $sql = "SELECT * FROM customers WHERE email = '$email'";
        $query = $connect->query($sql);
        $query = $query->fetch_assoc();
        if (empty($query)) {
            $mail = new PHPMailer(true);

            $email = $_POST['email'];
            //Server settings
            $mail->SMTPDebug = FALSE;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'trinhnhatanh47@gmail.com';                     //SMTP username
            $mail->Password   = 'oyexhvzesxplwejo';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom($email, 'FurnitureShop');
            $mail->addAddress($email, 'User');     //Add a recipient
            $mail->addAddress($email);               //Name is optional
            //Attachments

            //
            $Code = rand(100000, 999999);

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Forgot Password';
            $mail->Body    = 'Base Code:  ' . $Code;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            //send email
            $mail->send();
            echo 'Message has been sent';

            // 
            $_SESSION['code'] = $Code;
            $_SESSION['email'] = $email;


            header('Location: reset_password.php');
        } else {
            header('location:checkForgotEmail.php');
        }
    } else {
        $_SESSION['email_empty'] = "err";
        header('location:checkForgotEmail.php');
    }
}
