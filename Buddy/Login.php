<?php
session_start();
ob_start();
if(!isset($_SESSION['error']))
{
	$_SESSION['error']='';
	echo '<script type="text/javascript"> document.getElementById("error").style.display="none";</script>';
}


?>
<!DICTYPE html>
<html>
<head>
<link rel="icon" type="image/png" href="buddy-32x32.png" sizes="32x32" />
<link rel="icon" type="image/png" href="buddy-16x16.png" sizes="16x16" />
<title> Login - Buddy </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/custom.css">
<script src="js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
	function signup()
	{
		window.open('signup.html','_self');
	}

</script>
</style>
</head>
<body background="swan3.jpg">
    <!-- Header-->
   <!--header -->
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only"> Toggle Navigation </span>
					<span class="icon-bar" style="color:white"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="home.php"> NearbyBuddy </a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<li class="active"><a href="Login.php"> Login  </a> </li>
					<li> <a href="signup.html"> Signup </a> </li>
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


				</ul>
			</div>
		</div>
	</div>
<!-- Middle page -->
<div class="container-fluid" id="content">
        <div class="col-sm-3">
		</div>
		<!-- Login credintials -->
		<div class="col-sm-6 well" style="background-color:transparent">
			<center>
			<h4 style="color:white"><span  id="logck"> Welcome Please login.... </span> </h4>
				<p><br> <label id="error" class="alert alert-danger"><?php if(!$_SESSION['error']){$_SESSION['error']="";}else{echo $_SESSION['error'];} ?> </label> </p>
				<form name="login" action="loginCheck.php" method="POST">
				<p><label style="color:white"> Username: &nbsp;<input  type="text" style="color:orangered" value="Username" name="userId" onBlur="if(this.value=='')this.value='Username'" onFocus="if(this.value=='Username')this.value='' "/> </label></p>
				<p><label style="color:white"> Password:&nbsp;&nbsp;<input type="password" style="color:orangered" value="Password" name="password" onBlur="if(this.value=='')this.value='Password'" onFocus="if(this.value=='Password')this.value='' "></p>
				<p><a href="forgotpasswd.html" style="color:chartreuse">Forgot Password?</a></p>
				<p><input class="btn btn-success" type="submit"  value="Login"/></p>
				</form>
				<button class="btn btn-info" onClick="signup()">Create Account</button>
				</center>
		</div>
		<div class="col-sm-3">
		</div>	
</div>		

	 <!-- 
    Modal-dialog box for Contact
-->
<div class="modal fade" id="contact" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form class="form-horizontal" role="form" method="post" action="contactmessage.php">
					<div class="modal-header">
						<h4 style="color:red"> Contact </h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<p class="alert" style="color:green"> We will shortly response to your query. </p>
                           
							<label for="contact_name" class="col-sm-2 control-panel">	Name: </label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="Fullname"> </input>  
							</div>
						</div>

						<div class="form-group">
							
							<label for="contact_email" class="col-sm-2 control-panel">	Email: </label>
							<div class="col-sm-10">
								<input type="email" class="form-control" id="contact_email" name="contact_email" placeholder="example@email.com"> </input>  
							</div>
						</div>
						<div class="form-group">
							
							<label for="contact_subject" class="col-sm-2 control-panel">	Subject: </label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="contact_subject" name="contact_subject" placeholder="whats your query?"> </input>  
							</div>
						</div>

						<div class="form-group">
							
							<label for="contact_message" class="col-sm-2 control-panel">	Message: </label>
							<div class="col-sm-10">
								<textarea class="form-control" id="contact_message" name="contact_message" rows="4" > </textarea>  
							</div>
						</div>
						</div>
					</div>
				<div class="modal-footer">
				<a class="btn btn-default" data-dismiss="modal"> Close </a>
				<button type="submit" class="btn btn-primary"> Send </button>
				</div>
		   </form>
		</div>
	</div>
</div>

</body>
</html>