<?php

require("PHPMailer_5.2.0/class.phpmailer.php");
#include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail             = new PHPMailer();
$body             = "test";
$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "localhost"; // SMTP server
$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host       = "localhost"; // sets the SMTP server
$mail->Port       = 25;                    // set the SMTP port for the GMAIL server
$mail->Username   = "webmaster@myca168.com"; // SMTP account username
$mail->Password   = "myca120528";        // SMTP account password

$mail->SetFrom('webmaster@myca168.com', 'First Last');

$mail->AddReplyTo("webmaster@myca168.comm","First Last");

$mail->Subject    = "PHPMailer Test Subject via smtp, basic with authentication";

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($body);

$address = ""; // Enter a TO address here
$mail->AddAddress($address, "Docs Test");

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}
?>