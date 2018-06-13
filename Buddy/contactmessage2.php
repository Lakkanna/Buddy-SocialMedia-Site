<?php
// Pear Mail Library
require_once "Mail/Mail.php";

$from = 'lakkannawalikar@gmail.com'; //change this to your email address
$to = 'sh75505@gmail.com'; // change to address
$subject = 'Insert subject here'; // subject of mail
$body = "Hello world! this is the content of the email"; //content of mail

$headers = array(
    'From' => $from,
    'To' => $to,
    'Subject' => $subject
);

$smtp = Mail::factory('smtp', array(
        'host' => 'ssl://smtp.gmail.com',
        'port' => '465',
        'auth' => true,
        'username' => 'lakkannawalikar@gmail.com', //your gmail account
        'password' => 'LuckFucks3' // your password
    ));

// Send the mail
$mail = $smtp->send($to, $headers, $body);
/*
    ini_set("SMTP", "aspmx.l.google.com");
    ini_set("sendmail_from", "lakkannawalikar@gmail.com");

    $message = "The mail message was sent with the following mail setting:\r\nSMTP = aspmx.l.google.com\r\nsmtp_port = 25\r\nsendmail_from = lakkannawalikar@gmail.com";

    $headers = "From: lakkannawalikar@gmail.com";


    mail("sh75505@gmail.com", "Testing", $message, $headers);
    echo "Check your email now....<BR/>";
*/
/*
**
  This example shows making an SMTP connection with authentication.
 */
 /*
extract($_POST);
//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

require 'phpmailer/PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = "smtp.comcast.net";
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->Port = 25;
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication
$mail->Username = "lakkannawalikar@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "LuckFucks3";
//Set who the message is to be sent from
$mail->setFrom('lakkannawalikar@gmail.com', 'First Last');
//Set an alternative reply-to address
$mail->addReplyTo('replyto@example.com', 'First Last');
//Set who the message is to be sent to
$mail->addAddress('lakkannawalikar@gmail.com', 'Lakkanna');
//Set the subject line
$mail->Subject = 'PHPMailer SMTP test';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
$mail->Body="This is html text <b> in bold </b>";
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
echo $contact_name;
echo ' '.$contact_message;
echo ' '.$contact_email;
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}

*/
?>