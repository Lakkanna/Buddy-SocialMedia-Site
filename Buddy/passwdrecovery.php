<?php
    extract($_POST);
    session_start();
    // creating random number send a mail to user for new password/recovery password
        $charset = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $rand_str = '';
        $desired_length = 6;
        while(strlen($rand_str) < $desired_length)
        {
              $rand_str .= substr(str_shuffle($charset), 0, 1);
        }
      //  $random=$rand_str;
        // checking the email for existance of account
    	$link = mysqli_connect('127.0.0.1','root',''); 
	        	if (!$link) 
                { 
					die('Could not connect to MySQL: ' . mysqli_error()); 
				} 	  
        mysqli_select_db($link,"buddy") or die (mysqli_error());
  	    $result = mysqli_query($link,"SELECT Fname FROM `users` WHERE Email='$rec_email'");
        $row=mysqli_fetch_row($result);
        $name=$row[0];
         
        if(!$result)
            {
                die(" User not found please signup..!");
            }
    
            $random=$rand_str;
            if($result)
            {
                    require_once "PHPMailer/PHPMailerautoload.php";
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

                    $mail->From = "lakkannawalikar@gmail.com";
                    $mail->FromName = "NearbyBuddy";

                    $mail->addAddress($rec_email, $name);

                    $mail->isHTML(true);

                    $mail->Subject = "NearbyBuddy Password Recovery";
                    $mail->Body = '<html> <head> <title> Password Recovery </title> </head> <body> 
                                   Recovery password for your NearbyBuddy.com is <b>'.$random.'</b> <br><i> Click here to open login page</i> <a href="http://localhost/Buddy/login.html"> Login </a><br>
                                   </body> </html> ';
                    $mail->AltBody = 'Recovery Password: '.$random;

                    if(!$mail->send()) 
                    {
                        echo 'Mailer Error:' . $mail->ErrorInfo;
                    } 
                    elseif($mail->send()) 
                    {
                                    echo 'Message has been sent successfully';
                                    $link = mysqli_connect('127.0.0.1','root',''); 
                                    if (!$link) 
                                     { 
                                        die('Could not connect to MySQL: ' . mysql_error()); 
                                     } 	  
                                    mysqli_select_db($link,"buddy") or die (mysql_error());
                                  	$sql = mysqli_query($link,"UPDATE `buddy`.`users` SET `Password` = '$random' WHERE Email='$rec_email' AND Fname='$name'");
                                      if(!$sql)
                                      {
                                          die("Password update to database failure");
                                      }
                        
	                $_SESSION['error']='Recovery Password sent to your mail id';
                                        
                
                    }
            }
            mysqli_close($link);
            header('Location:login.php');
         //   echo "<script type='text/javascript'> window.open('login.php',_self); </script>";
        
?>