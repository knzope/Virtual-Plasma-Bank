<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
require 'config.php';

class Mailer{

    public static function sendMail($email_to, $subject, $message) {
        $mail = new PHPMailer();
        $mail->IsSMTP();

        $mail->SMTPDebug  = 0;
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port       = 587;
        $mail->Host       = "smtp.gmail.com";
        $mail->Username   = "virtualplasmabank@gmail.com";
        $mail->Password   = EMAIL_PWD;

        $mail->IsHTML(true);
        $mail->AddAddress($email_to,$email_to);
        $mail->SetFrom("virtualplasmabank@gmail.com", "Virtual Plasma Bank");
        // $mail->AddReplyTo("reply-to-email", "reply-to-name");
        // $mail->AddCC("cc-recipient-email", "cc-recipient-name");
        $mail->Subject = $subject;//"EduTech " . date('is');
        $mail->MsgHTML($message);

        if(!$mail->Send()) {
            // echo "Error while sending Email.";
            return false;
        } else {
            // echo "Email sent successfully";
            return true;
        }
    }
}
?>