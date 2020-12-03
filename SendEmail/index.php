<?php
session_start();
include'../connection.php';

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/functions.php';
require_once __DIR__.'/config.php';



$mail = new \PHPMailer\PHPMailer\PHPMailer(true);

try {
    
  //check query is execute successfully or not
    $email = $_SESSION['email'];
    //Server settings
    $mail->SMTPDebug = CONTACTFORM_PHPMAILER_DEBUG_LEVEL;
    $mail->isSMTP();
    $mail->Host = CONTACTFORM_SMTP_HOSTNAME;
    $mail->SMTPAuth = true;
    $mail->Username = CONTACTFORM_SMTP_USERNAME;
    $mail->Password = CONTACTFORM_SMTP_PASSWORD;
    $mail->SMTPSecure = CONTACTFORM_SMTP_ENCRYPTION;
    $mail->Port = CONTACTFORM_SMTP_PORT;

    // Recipients
     $mail->setFrom('kabirbatrakkbb@gmail.com', 'Expense Tracker');
    $mail->addAddress($email);

    // Content
     $mail->isHTML(true); //false if you don't use html.
     $mail->Subject = $_SESSION['subject'];
    
      
      //email body
     $mail->Body = $_SESSION['body'];
  


    if ($mail->send()) {
                header("location: otppage.php");
            } else {
                $errors .="<div class='alert alert-danger'>There are some errors - Please try again later.</div><br>".mysqli_error($link); 
            }


} catch (Exception $e) {
    redirectWithError("An error occurred while trying to send your message: ".$mail->ErrorInfo);
}



?>