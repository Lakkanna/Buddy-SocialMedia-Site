<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Account Verify</title>
</head>
<body>
<?php
		if(!extract($_POST))
				   {
				   	echo 'Post Not working';
				   }

				   if(isset($_POST['signup']))
				   {
					   $link = mysql_connect('127.0.0.1','root',''); 
					if (!$link)
					 { 
							die('Could not connect to MySQL: ' . mysql_error()); 
					 } 
					mysql_select_db("buddy", $link) or die (mysql_error());		   
				
				   	extract($_POST);
					$fname=$_POST['fname']; 
					$lname=$_POST['lname'];
					$email=$_POST['email'];
					$passwd=$_POST['password'];
			

					   if(isset($_FILES['image']))
					   {
						   $fp=addslashes(file_get_contents($_FILES['image']['tmp_name']));
					   }

$sql ="INSERT INTO `buddy`.`users`(`Fname`,`Email`,`Profile`,`Password`,`Privacy`,`Sex`,`DOB`,`Status`) VALUES ('$_POST[fname]','$_POST[email]','$fp','$_POST[password]','$_POST[privacy]','$_POST[sex]','$_POST[dob]','online');";
mysql_query($sql) or die("Error in Query insert ".mysql_error());
}
					
					$logcheck=mysql_query("SELECT User_id,Fname,Password from `buddy`.`users` where Fname='$fname' and Password='$passwd'");
					$row = mysql_fetch_row($logcheck);
					
					session_start();
					$_SESSION['User_id']=$row[0];
					$_SESSION['Fname']=$row[1];
					$_SESSION['Password']=$row[2];
					$Fname=$_SESSION['Fname'];
					$Password=$_SESSION['Password'];

					/*echo '<script> window.alert("Successfull account created. Login now");  window.open("geoLocation.php","_self"); </script>';
					echo '<script> window.alert("Successfull account created. Welcome '.$row[0].'...!"); window.open("geoLocation.php","_self");</script>'; */
				if(($fname and $Fname) && ($passwd and $Password))
				{	
			echo '<script> window.alert("Successfull account created. Welcome '.$row[1].'...!");';
           // echo '<span class="alert alert-success"> Successfully Account Created </span>';
		//	echo  ' window.open("home.php","_self");  </script>';
			header('location:home.php');
				}
				if(($fname != $Fname) && ($passwd != $Password))
				{	
					//	echo '<script> window.alert("Invalid Username/Password"); window.open("Login.html","_self"); </script>';
					header('location:Login.html');
                       // echo '<span class="alert alert-danger"> Invalid Username/Password </span><script> window.open("Login.html","_self"); </script>';
                }
mysql_close($link);
?>
</body>
</html>
