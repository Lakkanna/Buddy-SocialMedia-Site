	<?php
    session_start();
				$User_id=$_SESSION['User_id'];
				$Password=$_SESSION['Password'];
				$link = mysql_connect('127.0.0.1','root',''); 
				if (!$link) { 
								die('Could not connect to MySQL: ' . mysql_error()); 
							} 
			
				if ($link)
 				 {		mysql_select_db("buddy") or die (mysql_error());
  						$result = mysql_query("SELECT Fname FROM `users` WHERE User_id=$User_id AND Status='online'");
						if (!$result) { echo 'Not working :' . mysql_error();
										exit; 
										}
						$row = mysql_fetch_row($result);
						$offline = mysql_query("UPDATE  `buddy`.`users` SET  `Status` =  'offline' WHERE  `users`.`Fname` =  '$row[0]' AND User_id=$User_id");
						if($offline)
						{
							//session_unset();
							//session_destroy();
							session_start();
							$_SESSION['error']="";
						}				
						mysql_close();
 					}
		
		header("Location:Login.php");
		
		?>