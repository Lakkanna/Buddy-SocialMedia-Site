<!DOCTYPE html>
<html>
<head>
<link rel="icon" type="image/png" href="buddy-32x32.png" sizes="32x32" />
<link rel="icon" type="image/png" href="buddy-16x16.png" sizes="16x16" />
<title> RSS- Feed </title>
<meta charset="utf-8">
<meta http-euiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="rss3/style.css">
		<script type="text/javascript" src="rss3/jquery.js"></script>
		<script type="text/javascript" src="rss3/script.js"></script>
		<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/custom.css">
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

	</head>
	<body onload="init()">
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
					<li><a href="home.php"> Home </a> </li>
						<li> <a href="chat.html"> Chat </a> </li>
						<li> <a href="http://localhost/cake/Topics/index"> Cake PHP </a>
						<li> <a href="profile.php"> Profile </a> </li>
						<li class="active"> <a href="rss.php"> RSS </a> </li>
						<li> <a href="message.php"> Messages </a> </li>
					<li> <a href="#contact" data-toggle="modal"> Contact </a> </li>
					<li> <a href="about.php"> About </a> </li>
					<li> <a href="logout.php">Logout </a> </li>
				</ul>
			</div>
		</div>
	</div>
	<div class="page-bg"> </div>
		<div id="outer">
			<div id="inner">FEED Loading in 1. 2.. 3... </div>
		</div>
	</body>
</html>
