<?php
session_start();
if($_SESSION['Fname']) $name=$_SESSION['Fname'];
if($_SESSION['User_id']) $id=$_SESSION['User_id'];
$_SESSION['sessionid']=session_id();
$_SESSION['uniqid']=uniqid();
$uniqid=$_SESSION['uniqid'];
if(!$_SESSION['sessionid'])
{
	header("Location:Login.php");
}
?>


<!DOCTYPE html>
<html>
<head>
<link rel="icon" type="image/png" href="buddy-32x32.png" sizes="32x32" />
<link rel="icon" type="image/png" href="buddy-16x16.png" sizes="16x16" />
<title> Messages-Buddy </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/custom.css">
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css">


<script type="text/javascript" src="chat.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">

</script>
</head>
<body onload="init()" background="ws.jpg">
    <!--header -->
	<!-- <div class="navbar navbar-def navbar-fixed-top" role="navigation">   -->
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only"> Toggle Navigation </span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="home.php"> NearbyBuddy </a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="home.php"> Home </a> </li>
					<li> <a href="message.php"> Chat </a> </li> 
					<li> <a href="http://localhost/cake/Topics/index"> Cake PHP </a>
					
					<li  class="active"> <a href="profile.php"> Profile </a> </li>
					<li> <a href="#contact" data-toggle="modal"> Contact </a> </li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"> About <b class="caret"></b> </a>
						<ul class="dropdown-menu">
							<li class="dropdown-header"> Admin & Dashboard </li> 
							<li> <a href="#"> Lakkanna </a> </li>
							<li> <a href="#"> Hitesh </a> </li>
							<li class="divider"></li>
							<li class="dropdown-header"> Designer </li> 
							<li> <a href="#"> Dilip </a> </li>
							<li> <a href="#"> Varun </a> </li>
						</ul>
					</li>
					<li> <a href="logout.php"> Logout </a> </li>
				</ul>
			</div>
		</div>
	</div>

<div class="container">
		<div class="col-sm-12 well"   style="background-color:white;color:black">  
				
					<div class="col-sm-4">
						<h3 style="color:slateblue;font-family:oswald;"> Profile </h3>
					</div>
				<!--	<div class="col-sm-3">
					<input type="text" id="msg" name="msg" width="100%" placeholder="Type your message here"/> 
					</div>
					<div class="col-sm-1">
							<button id="btn" class="btn btn-primary" onclick="obj.sendMsg()" > Send Message  </button>
					</div>
				-->	
               

		</div>
</div>

	<div class="container">
		<div class="col-sm-12 well"style="background-color:smokewhite">
				<div class="col-sm-3"style="background-color:transparent">
				</div>
				<div class="col-sm-6" id="innertop">	
							<!-- Fetching messages from databse -->
				
                             <?php	
				$link = mysqli_connect('127.0.0.1','root',''); 
		if (!$link) { 
					die('Could not connect to MySQL: ' . mysqli_error()); 
					} 	
		else 
	  	{		
		mysqli_select_db($link,"buddy") or die (mysqli_error());
  		$result = mysqli_query($link,"SELECT * FROM `users` WHERE User_id='$id' AND Fname='$name'");
		
		if (!$result) { echo 'Not working :' . mysqli_error();
						exit; 
					  }
			$row = mysqli_fetch_row($result);
			echo '<table border="1" width="100%">';
			echo '<tr> <td> Name :';
	    	echo '</td>  <td>'.$row[1]."&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp";
		//	echo $row[3];
		//	echo '" width="100" height="100" /> <br> ';
             $msg="";
                	$msg .='<img src="data:image/jpeg;base64,'.base64_encode($row[03]).'" width="25" height="20"/> </a>';
            echo $msg;
            echo '</td> </tr>';
			echo $row[1];
			echo ' </td> </tr> ';
			echo ' <tr> <td> Email: </td> <td>  ';
			echo $row[2];
			echo ' </td> </tr> <tr> <td> Privacy : </td> <td>';
			echo $row[5];
			echo '<tr> <td> Password: </td>  <td>';
			echo  $row[4];
			echo ' </td> </tr> <tr> <td> Sex: </td> <td>  ';
			echo $row[6];
			echo '<tr> <td> Date of Birth: </td>  <td>';
			echo $row[7];
			echo ' </td> </tr> </table> <br>';
			
		}
        
	mysqli_close($link);


?>  </table>

        <iframe id="helper" width="300" height="100" hidden>
				
		</iframe>
			</div>
</div>
				
			</div>
		

						<!--- END of inserting messages into database -->


<!-- 
    Footer
-->
	<div class="navbar navbar-inverse navbar-fixed-bottom" role="navigation">
		<div class="container">
			<div class="navbar-text pull-left">
				<p> <copright>&copy 2017 Bootstrap.com </p>
			</div>
			<div class="navbar-text pull-right">
				<a href="#"> <i class="fa fa-facebook-square fa-2x"></i></a>
				<a href="#"> <i class="fa fa-twitter-square fa-2x"></i></a>
			</div>
		</div>
	</div>



</body>
</html>