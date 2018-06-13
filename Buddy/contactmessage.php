<html>
<head>
<title> Contact </title>
</head>
<body>
<?php

require_once "PHPMailer/PHPMailerautoload.php";
extract($_POST);
$mail = new PHPMailer;

//Enable SMTP debugging. 
$mail->SMTPDebug = 3;                               
//Set PHPMailer to use SMTP.
$mail->isSMTP();            
//Set SMTP host name                          
$mail->Host = "smtp.gmail.com";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;                          
//Provide username and password     
$mail->Username = "lakkannawalikar@gmail.com";                 
$mail->Password = "qtqrdneowxlcrwbc";                           
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = "tls";                           
//Set TCP port to connect to 
$mail->Port = 587;                                   

$mail->From = $contact_email;
$mail->FromName = $contact_name;

$mail->addAddress("lakkannawalikar@gmail.com", "Lakkanna Walikar");

$mail->isHTML(true);

$mail->Subject = $contact_subject;
$mail->Body = "<i>".$contact_message."</i>";
$mail->AltBody = "This is the plain text version of the email content";

if(!$mail->send()) 
{
    echo "Mailer Error: " . $mail->ErrorInfo;
} 
else 
{
    echo "Message has been sent successfully";
}
?>
<a href="home.php"> Home </a>
