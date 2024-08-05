<?php
include "PHPMailer/src/PHPMailer.php";
include "PHPMailer/src/Exception.php";
include "PHPMailer/src/Oauth.php";
include "PHPMailer/src/POP3.php";
include "PHPMailer/src/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class Mailer
{
    public function dathangmail($tieude, $noidung, $maildathang)
    {
        $mail = new PHPMailer(true);
        $mail->CharSet = 'utf-8';
        // print_r($mail);                               // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 0;                                   // Enable verbose debug output
            $mail->isSMTP();                                        // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';                        // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                                  // Enable SMTP authentication
            $mail->Username = 'trong9dtk@gmail.com';                 // SMTP username
            $mail->Password = 'bntv zrfb pdjh ijnb';                           // SMTP password //Hàm function PHP
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('trong9dtk@gmail.com', 'PETSTORE');
            $mail->addAddress($maildathang, 'Đức Trọng');     // Add a recipient
            // $mail->addAddress('ellen@example.com');  

            // Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            $mail->addCC('trong9dtk@gmail.com.com');
            // $mail->addBCC('bcc@example.com');

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $tieude;
            $mail->Body    = $noidung;
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }
}
?>