<?php
extract($_GET);
$flw=$user;
session_start();
$link = mysqli_connect('127.0.0.1','root',''); 
	if (!$link) 
	{ 
		die('Could not connect to MySQL: ' . mysqli_connect_error()); 
	} 	
		$User_id=$_SESSION['User_id'];
		mysqli_select_db($link,"buddy") or die (mysql_error());
		$addflw = mysqli_query($link,"INSERT INTO `buddy`.`following` (`user1`, `user2`) VALUES ('$User_id', '$flw')");		
		mysqli_close($link);
		echo "Followed";					
?>