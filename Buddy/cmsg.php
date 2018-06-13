<?php
extract($_POST);
require 'phpmailer/PHPMailerAutoload.php';
$to=$contact_email;
$subject="NearbyBuddy mail test";
$message=$contact_message;
$headers="From:lakkannawalikar@gmail.com"."\r\n"."CC:dilipn007@gmail.com";
mail($to,$subject,$message,$headers);
?>