<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";

        $mail = new PHPMailer();

        //SMTP Settings
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "kabirbatrakkbb@gmail.com";
        $mail->Password = 'gurunanakdev@03';
        $mail->Port = 587; //587
        $mail->SMTPSecure = "tls"; //tls

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom($sender_email, $name);
        $mail->Subject = $subject;
        $mail->Body = $body;

?>