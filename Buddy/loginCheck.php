<?php
	session_start();
    extract($_POST);
    $link = mysql_connect('127.0.0.1','root',''); 
			if (!$link) { 
							die('Could not connect to MySQL: ' . mysql_error()); 
						} 
				$email = $_POST['userId'];
				$passwd = $_POST['password'];
				mysql_select_db("buddy") or die (mysql_error());
  				$result = mysql_query("SELECT User_id,Fname,Password FROM `users` WHERE Email='$email' OR Fname='$email' AND Password='$passwd'");
		
				if (!$result) { echo 'Not working :' . mysql_error();
								exit; 
								}
				$row = mysql_fetch_row($result);
               if(($email and $row[1]) && ($passwd and $row[2]))
				{	
						$sql = mysql_query("UPDATE `buddy`.`users` SET `Status` = 'online' WHERE Fname='$row[1]' AND User_id='$row[0]'");		

					$_SESSION['User_id']= $row[0];
					$_SESSION['Fname']= $row[1];
					$_SESSION['Password']= $row[2];	
						//$putonline=mysql_query("INSERT INTO `newsfeed` WHERE User_id=$row[0] VALUES ('$row[0]', '$ftype', '$txt', '$file','$time')");
						header('location:home.php');
				//	echo '<script> window.open("home.php","_self"); </script>';
				
				}
				if(($email != $row[1]) && ($passwd != $row[2]))
				{	
						//	echo "Invalid Username/Password";
					//	echo '<script> window.open("Login.html","_self"); </script>';
					$_SESSION['error']="Incorect Username/Password.";
					header('location:login.php');
				
				}
			$alter = mysql_query("UPDATE  `users` SET  `Status` =  'online' WHERE  `users`.`Fname` = '$row[1]'");
?>