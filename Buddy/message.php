<?php session_start(); ?>
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
<link rel="stylesheet" type="text/css" href="rss3/style.css">
<script type="text/javascript" src="rss3/jquery.js"></script>
<script type="text/javascript" src="rss3/script.js"></script>
		
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
	function resetForm()
	{
		document.getElementById("messageForm").reset();
	}
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
					<li><a href="home.php">  <?php if($_SESSION['Fname']){echo $_SESSION['Fname'];$_SESSION['error']="";} else {$_SESSION['error']="Please Login/Signup to access the service."; header("Location:Login.php");} ?>  </a> </li>
					<li> <a href="chat.html"> Chat </a> </li>
						<li> <a href="http://localhost/cake/Topics/index"> Cake PHP </a>
						<li> <a href="profile.php"> Profile </a> </li>
					
					<li  class="active"> <a href="message.php"> Message </a> </li> 
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


	<div class="page-bg"> </div>
		<div id="outer">
			<div id="inner" style="color:white;">FEED Loading in 1. 2.. 3... </div>
		</div>


<div class="container">
    <div class="page-header well" style="background-color:#18BC9C;color:white">
        <h2> Messages </h2>
	</div>
	<div class="col-sm-12 well"  style="background-color:white">  
		<div class="col-sm-2">
		 <form id="messageForm" name="messageForm" method="POST" action="message.php">
     		 <?php 
	  			$User_id=$_SESSION['User_id'];
				$link = mysqli_connect('127.0.0.1','root',''); 
					if (!$link) { 
					die('Could not connect to MySQL: ' . mysql_error()); 
							} 
							date_default_timezone_set("Asia/Kolkata");
							$now = new DateTime();
							$time = date("d/m/Y h:i: a", time());
							mysqli_select_db($link,"buddy") or die (mysql_error());
							$rl = mysqli_query($link,"SELECT * FROM `users` WHERE Privacy='Public' AND User_id != '$User_id' ORDER BY Fname");
							
							echo '<select name="rec" class="alert-success" autofocus required>';
							while($r = mysqli_fetch_row($rl))
							{	

								echo '<option value="'.$r[0].'"> '.$r[1].'</option>';
								
							}
							echo '</select> ';
							mysqli_close($link);
			?>
        </div>
	    <div class="col-sm-3" style="background-color:smokewhite">
		   <input type="text" align="absmiddle" placeholder="type your message here.." text="0" id="textStat" name="text"/>
		</div>
        
    	<div class="col-sm-3">
       	 <input type="file"  name="file" id="file" value="visible" accept="video/*,image/*" />
		</div>
		<div class="col-sm-2">
		<input name="textUpdate" type="submit" id="statusSubmit" class="btn btn-warning" value="Send Message"  border="2px solid" />
		 </form>
		</div>
    </div>
	</div>
	</div>
	<div class="container">
		<div class="col-sm-12 well"style="background-color:smokewhite">
				<div class="col-sm-3"style="background-color:transparent">
				</div>
				<div class="col-sm-6">	
							<!-- Fetching messages from databse -->
							<?php
							//session_start();
								$link = mysqli_connect('127.0.0.1','root',''); 
							if (!$link) { 
										die('Could not connect to MySQL: ' . mysqli_error()); 
										} 	
							else 
							{		
							mysqli_select_db($link,"buddy") or die (mysqli_connect_error());
							$User_id=$_SESSION['User_id'];
							$Password=$_SESSION['Password'];
							//	$fname=$_SESSION['Fname']
							$result = mysqli_query($link,"SELECT * FROM `users` WHERE User_id='$User_id' AND Password='$Password'");
							$m=mysqli_fetch_array($result,MYSQLI_ASSOC);
							$mm=$m['User_id'];
							$sql=mysqli_query($link,"SELECT * FROM `message` WHERE Sender='$mm' OR Reciever='$mm' ORDER BY Time ASC");
							
							
							echo '<table border="0" width="100%">';
							//echo '<th align="absmiddle" bgcolor="#0000"> Messages </th>';
							while($i=mysqli_fetch_row($sql))
							{	
								$name1 = mysqli_query($link,"SELECT Fname FROM `users` WHERE User_id='$i[0]'");
								$u1 = mysqli_fetch_row($name1);
								$name2 = mysqli_query($link,"SELECT Fname FROM `users` WHERE User_id='$i[1]'");
								$u2 = mysqli_fetch_row($name2); 
							
								if($i[2]=='text')
								{
										echo '<div class="panel panel-def"> <div class="panel-heading"> <h1 class="panel-title">';
					echo  '<h3 class="panel-title">'.$u1[0].' to '.$u2[0].'</h3></div><div class="panel-body text-center">'.$i[4].'</p><p>'.$i[6].'</p></span></div></div>';
	

							/*	echo '<table border="0" width="100%">';
								echo '<tr> <td>';
								echo  '<span class="style16">'.$u1[0].' to '.$u2[0]. '</span>';
								echo ' </td> </tr> <tr> <td>';
								echo $i[4];
								echo '</td> </tr> <tr> <td>';
								echo $i[6];
								echo '</td> </tr> </table> <hr> <br>';
							*/
								}
								
								if($i[2]=='video')
								{
								echo '<div class="panel panel-def"> <div class="panel-heading">';
								echo  '<h1 class="panel-title">'.$u1[0].' to '.$u2[0].'</h1></div><div class="panel-body text-center"><div class="thumbnail"><video src="'.$i[5].'" width="500" height="250" controls> </video></div></p>';
								echo '<p>'.$i[4].'</p>';
            					echo '<p>'.$i[6].'</p> </div> </div>';
        
						/*		echo '<table border="0" width="100%">';
								echo '<tr> <td>';
								echo  '<span class="style16">'.$u1[0].' to '.$u2[0]. '</span>';
								echo ' </td> </tr> <tr> <td> <video width="550" height="300" controls> <source src="';
								echo $i[5];
								echo '"/> </video> </td> </tr> <tr> <td>';
								echo $i[4];
								echo '</td> </tr> <tr> <td>';
								echo $i[6];
								echo '</td> </tr> </table> <hr> <br>';
						*/
								}
								if($i[2]=='image')
								{
								echo '<div class="panel panel-def"> <div class="panel-heading">';
								echo  '<h1 class="panel-title"><p>'.$u1[0].' to '.$u2[0].'</p>';
								echo '</h1></div><div class="panel-body text-center"><p><center><div class="thumbnail"><img  src="';
								echo $i[3];
								echo '" width="400" height="200" /></div></center></p>';
								echo '<p>'.$i[4].'</p>';
								echo '<p>'.$i[6].'</p></div> </div>';
								
						/*		echo '<table border="0" width="100%">';
								echo '<tr> <td>';
								echo  '<span class="style16">'.$u1[0].' to '.$u2[0]. '</span>';
								echo ' </td> </tr> <tr> <td> <img src="';
								echo $i[3];
								echo '" width="300" height="250" />  </td> </tr> <tr> <td>';
								echo $i[4];
								echo '</td> </tr> <tr> <td>';
								echo $i[6];
								echo '</td> </tr> </table> <hr> <br>';
					*/
								}
							}
							if (!$result) { echo 'Not working :' . mysql_error();
											exit; 
										}
							}
						mysqli_close($link);
						?>
				</table>
			</div>
			</div>
</div>

				<!-- Inserting messages into database -->
				<?php  
					$link = mysqli_connect('127.0.0.1','root',''); 
					if (!$link) { 
					die('Could not connect to MySQL: ' . mysql_error()); 
							} 
					
							if(extract ($_POST))
							{
							$vid='';
							$img='';
							$ftype=explode(".",$file);
							$c=count($ftype);
							
							if($ftype[$c-1]=="mp4" OR $ftype[$c-1]=="mkv")
							{
								$vid=$file;
							//	 echo $ftype[$c-1];
							}
							else 
							{
							if($ftype[$c-1]=="jpg" OR $ftype[$c-1]=="gif" OR $ftype[$c-1]=="png") 
							{
								$img=$file;
								// echo $ftype[$c-1];
							}
							}
							$text = $_POST['text'];
						
							//$receiver=$_SESSION['receiver'];
							$receiver = $_POST['rec'];
							$User_id=$_SESSION['User_id'];
							$Fname=$_SESSION['Fname'];
							$Password=$_SESSION['Password'];
							date_default_timezone_set("Asia/Kolkata");
							$now = new DateTime();
							$time = date("d/m/Y h:i:s a", time());
							mysql_select_db("buddy") or die (mysql_error());
							$result = mysql_query("SELECT Fname FROM `users` WHERE User_id='$User_id' AND Fname='$Fname' AND Password='$Password'");
							if (!$result) { echo 'Not working :' . mysql_error();
												exit; 
											}
							
							$row = mysqli_fetch_row($result);
							if($vid!='')
							{
							$sql=mysqli_query($link,"INSERT INTO `buddy`.`message` (`Sender`, `Reciever`, `Msg_type`, `Image`, `Text`, `Video`, `Time`) VALUES ('$User_id', '$receiver', 'video', '$img', '$text', '$vid', '$time')");
							}
							else{
								if($img!='')
								{
							$sql=mysqli_query($link,"INSERT INTO `buddy`.`message` (`Sender`, `Reciever`, `Msg_type`, `Image`, `Text`, `Video`, `Time`) VALUES ('$User_id', '$receiver', 'image', '$img', '$text', '$vid', '$time')");
								}
								else {
									if($text!='')
										{
									$sql=mysqli_query($link,"INSERT INTO `buddy`.`message` (`Sender`, `Reciever`, `Msg_type`, `Image`, `Text`, `Video`, `Time`) VALUES ('$User_id', '$receiver', 'text', '$img', '$text', '$vid', '$time')");
										}
									}
								}
							}
							mysqli_close($link);
						?>
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