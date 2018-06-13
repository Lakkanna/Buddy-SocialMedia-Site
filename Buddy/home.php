<?php
session_start();
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
<title> Buddy- Newsfeed </title>
<meta charset="utf-8">
<meta http-euiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

</style>
<script type="text/javascript">

function countfollow()
{
    flwselect=document.getElementById("flwselect").value;
    xhr = new XMLHttpRequest();
    xhr.onreadystatechange=countfollowResponse;
    xhr.open("GET","http://localhost/Buddy/countfollow.php",true);
    xhr.send();
	//init();
}
function countfollowResponse()
{
	label=document.getElementById("countfollowers");
	label2=document.getElementById("countfollowing");
    if(xhr.readyState==4 && xhr.status==200)
    {
    //flwresponsel.innerHTML=xhr.responseText;
	//alert(xhr.responseText);
	data=xhr.responseText.split(";");

	label.innerHTML=data[0];
		label2.innerHTML=data[1];
//	label.innerHTML=xhr.responseText;
	var call=setTimeout(countfollow,1000);
    }
}

function follow()
{
    flwselect=document.getElementById("flwselect").value;
    xhr = new XMLHttpRequest();
    xhr.onreadystatechange=followResponse;
    xhr.open("GET","http://localhost/Buddy/followAdd.php?user="+flwselect,true);
    xhr.send();
}
function followResponse()
{
    if(xhr.readyState==4 && xhr.status==200)
    {
    //flwresponsel.innerHTML=xhr.responseText;
//	alert(xhr.responseText);
	label3=document.getElementById("flwresp");
	label3.innerHTML=xhr.responseText;
    }
}
</script>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/custom.css">
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- RSS scripts
<link rel="stylesheet" type="text/css" href="rss3/style.css">
<script type="text/javascript" src="rss3/jquery.js"></script>
<script type="text/javascript" src="rss3/script.js"></script>
-->




<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
</style>
<script>
    $(document).ready(function(){$('button#btn').popover();});
</script>
</head>
<body background="texture2.jpg" onload="countfollow()">
	
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
					<li class="active"><a href="home.php"> <?php if($_SESSION['Fname']){echo $_SESSION['Fname'];$_SESSION['error']="";} else {$_SESSION['error']="Please Login/Signup to access the service."; header("Location:Login.php");} ?> </a> </li>
						<li> <a href="chat.html"> Chat </a> </li>
						<li> <a href="http://localhost/cake/Topics/index"> Cake PHP </a>
						<li> <a href="profile.php"> Profile </a> </li>
						
						<li> <a href="message.php"> Messages </a> </li>
					<li> <a href="#contact" data-toggle="modal"> Contact </a> </li>
					<li> <a href="about.php"> About </a> </li>
					<li> <a href="logout.php">Logout </a> </li>
					<li> <a href="profile.php"> 
						<?php
							$link = mysqli_connect('127.0.0.1','root',''); 
							if (!$link)
							{ 
									die('Could not connect to MySQL: ' . mysqli_connect_error()); 
							} 
							mysqli_select_db($link,"buddy") or die (mysqli_connect_error());	
							$msg="";
								$user=$_SESSION['User_id'];
							$sql="select * from users where User_id=$user";
						//	mysqli_query($link,$sql) or die("Error while fetching data ".mysqli_error());
							if(mysqli_query($link,$sql))
							{
								$result=mysqli_query($link,$sql);
								while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
								{
									$id=$row['User_id'];
									$image=$row['Profile'];
								//	$msg .='<a href="search.php?id='.$id."> <img src="data:image/jpeg,base64,'base64_encode($row['Profile']). '" /> </a>';
								$msg .='<img src="data:image/jpeg;base64,'.base64_encode($row['Profile']).'" width="25" height="20"/> </a>';
								}
							}
							else $msg.="Profile";
							echo $msg;
						?>	   
					 </a> </li>
				</ul>
			</div>
		</div>
	</div>
	<div class="page-bg"> </div>
<!-- Status uploading form -->
<div class="container">
<!-- RSS 

<div class="col-sm-12 well"   style="background-color:white;color:black">
		<div id="outer">
							<div id="inner">FEED Loading in 1. 2.. 3... </div>
		</div>
						
</div>
-->
		<div class="col-sm-12 well"   style="background-color:white;color:black">  
				<form method="POST" action="insertPost.php">
					<div class="col-sm-2">
						<h3 style="color:orangered;font-family:oswald;align:right"> Update Status: </h3>
					</div>
				<div class="col-sm-3">
					<input type="text" id="txt" name="txt" placeholder="Whats on your mind...!"/> 
				</div>
				<div class="col-sm-3">
					<input  name="file" type="file"  id="file" style="cue-after:"  accept="video/*,image/*"/>
				</div>
				<div class="col-sm-1">
					<button type="submit" class="btn btn-primary" title="Upload" data-toggle="popver" data-placement="bottom" data-content="File will upload">  Upload </button>
				</div>
				<div class="col-sm-1">
					<button id="btn" class="btn btn-danger" title="Upload" data-toggle="popver" data-placement="right" data-content="File will upload"> ?  </button>
				</div>
				</form>
		</div>
</div>


    <!--
 Friends list
    -->
    <div class="container-fluid">
        <div class="col-sm-2 well" style="background-color:transparent">
           <center>  
			    <div class="panel panel-def">
			  	 	<div class="panel-heading"> Followers </div> </div>
			<div class="panel panel-body text-center">
             <table class="table table-hover" width="100%">
		 <?php  
				$User_id=$_SESSION['User_id'];
				$Password=$_SESSION['Password'];
							
		$link = mysqli_connect('127.0.0.1','root',''); 
		if (!$link) { 
					die('Could not connect to MySQL: ' . mysqli_connect_error()); 
					} 	
		else 
	  	{		
		mysqli_select_db($link,"buddy") or die (mysqli_connect_error());
  		$result = mysqli_query($link,"SELECT * FROM `users` WHERE User_id='$User_id' AND Password='$Password'");
		$m=mysqli_fetch_array($result,MYSQLI_ASSOC);
		$xx=$m['User_id'];
		$sql=mysqli_query($link,"SELECT * FROM following WHERE user2='$xx'");
		
		$i=mysqli_fetch_array($sql,MYSQLI_ASSOC);
		while($i=mysqli_fetch_array($sql,MYSQLI_ASSOC))
		{	
			$ii=$i['user1'];
			$name = mysqli_query($link,"SELECT * FROM `users` WHERE User_id='$ii'");
			$zz = mysqli_fetch_array($name,MYSQLI_ASSOC);
		
			echo '<tr> <td> <center>';
			echo $zz['Fname'];
			//echo $g;
			echo '</center> </td> </tr>';
		}
		if (!$result) { echo 'Not working :' . mysqli_error();
						exit; 
					  }
	
	mysqli_close($link);
 	}
    
?>  
	</table> </div>
    <!-- You following -->
  <center>   
	  <div class="panel panel-suc">
		  <div class="panel-heading">
		  	You Following 
	 	</div>  </center>
		 <div class="panel-body">
             <table class="table"  width="100%">
		 <?php  
          
				$User_id=$_SESSION['User_id'];
				$Password=$_SESSION['Password'];
				
				
		$link = mysqli_connect('127.0.0.1','root',''); 
		if (!$link) { 
					die('Could not connect to MySQL: ' . mysqli_connect_error()); 
					} 	
		else 
	  	{		
		mysqli_select_db($link,"buddy") or die (mysqli_connect_error());
  		$result = mysqli_query($link,"SELECT * FROM `users` WHERE User_id='$User_id' AND Password='$Password'");
		$m=mysqli_fetch_array($result,MYSQLI_ASSOC);
		$mm=$m['User_id'];
		$sql=mysqli_query($link,"SELECT * FROM following WHERE user1='$mm'");
		
		while($i=mysqli_fetch_array($sql,MYSQLI_ASSOC))
		{	
			$ii=$i['user2'];
			$name = mysqli_query($link,"SELECT * FROM `users` WHERE User_id='$ii'");
			$zz = mysqli_fetch_array($name,MYSQLI_ASSOC);
		
			echo '<tr> <td> <center>';
			echo  $zz['Fname'];
			echo '</center> </td> </tr>';
		}
		if (!$result) { echo 'Not working :' . mysqli_error();
						exit; 
					  }
	
	mysqli_close($link);
 	}

?>  
	</table>
	</div>
    </div>
<!-- Empty div -->
	<div class="col-sm-1">
	</div>


        <!--
                contents newsfeed
        -->
        <div class="col-sm-6 well" style="background-color:smokewhite">	
            <h4 style="color:orangered;font-weight:bold"> Posts</h4>

     <?php  
            	$link = mysqli_connect('127.0.0.1','root',''); 
	        	if (!$link) 
                { 
					    die('Could not connect to MySQL: ' . mysqli_connect_error()); 
					} 	  
             mysqli_select_db($link,"buddy") or die (mysqli_error());
  	    	$result = mysqli_query($link,"SELECT * FROM `newsfeed`  ORDER BY post_num DESC");
		while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
		{	
            if($row['Status_type']=='video')
            {
				$r=$row['user_id'];
			$name = mysqli_query($link,"SELECT * FROM `users` WHERE user_id='$r'");
			$zz = mysqli_fetch_array($name,MYSQLI_ASSOC);
			echo '<div class="panel panel-def"> <div class="panel-heading">';
			echo  '<h1 class="panel-title">'.$zz['Fname'].'</h1></div><div class="panel-body text-center"><div class="thumbnail"><video src="'.$row['Video'].'" width="500" height="250" controls> </video></div></p>';
			echo '<p>'.$row['Text'].'</p>';
            echo '<p>'.$row['Time'].'</p> </div> </div>';
            }
            if($row['Status_type']=='image')
			{
				$r=$row['user_id'];
				$name = mysqli_query($link,"SELECT * FROM `users` WHERE user_id='$'");
			$zz = mysqli_fetch_array($name);
			echo '<div class="panel panel-def"> <div class="panel-heading">';
			echo  '<h1 class="panel-title"><p>'.$zz['Fname'].'</p>';
			echo '</h1></div><div class="panel-body text-center"><p><center><div class="thumbnail"><img  src="';
			echo $row['Image'];
			echo '" width="400" height="200" /></div></center></p>';
			echo '<p>'.$row['Text'].'</p>';
			echo '<p>'.$row['Time'].'</p></div> </div>';
			
			}
			if($row['Status_type']=='text')
			{
				$r=$row['user_id'];
				$name = mysqli_query($link,"SELECT * FROM `users` WHERE user_id='$r'");
		     	$zz = mysqli_fetch_array($name,MYSQLI_ASSOC);
				echo '<div class="panel panel-def"> <div class="panel-heading"> <h1 class="panel-title">';
					echo  '<h3 class="panel-title">'.$zz['Fname'].'</h3></div><div class="panel-body text-center">'.$row['Text'].'</p><p>'.$row['Time'].'</p></span></div></div>';
		/*	echo  '<p><center> <br> <span class="alert alert-danger">'.$zz[1].'</span></p>';
			echo  '<p><center> <br> <span class="alert alert-success">'.$row[4].'</span></p>';
			echo  '<p><center> <br> <span class="alert alert-warning">'.$row[6].'</span></p><hr> <br/>';
	  */
    //        echo  '<p><center> <br> <span class="alert alert-warning">'.$zz[1].'</p><p>'.$row[4].'</p><p>'.$row[6].'</p></span><hr><br>';
		/*	echo  '<p><center> <br> <span class="alert alert-danger">'.$zz[1].'</span></p>';
			echo  '<p><center> <br> <span class="alert alert-success">'.$row[4].'</span></p>';
			echo  '<p><center> <br> <span class="alert alert-warning">'.$row[6].'</span></p><hr> <br/>';
	  */
			}
		}
		if (!$result)
        { 
            echo 'Not working :' . mysqli_error();
				exit; 
		}	
	    mysqli_close($link);
     ?>

        </div>
<!-- Empty div -->
	<div class="col-sm-1">
	</div>

        <!-- 
            Suggested Friends
        -->
        <div class="col-sm-2 well" style="background-color:transparent">
         <center>   
			 <div class="panel panel-warn">
				 <div class="panel-heading">
					 	 Suggested Friends 
						  
				 </div>
			</center>
         			<?php  
		//	session_start();
			$User_id=$_SESSION['User_id'];
		$link = mysqli_connect('127.0.0.1','root',''); 
		if (!$link) { 
					die('Could not connect to MySQL: ' . mysqli_error()); 
					} 	
		else 
	  	{		
		mysqli_select_db($link,"buddy") or die (mysqli_error());
		$result = mysqli_query($link,"SELECT * FROM users WHERE User_id!='$User_id' AND User_id NOT IN (SELECT user2 FROM following,users WHERE user1='$User_id' GROUP BY user2)");
			if (!$result) { echo 'Not working :' . mysqli_error();
						exit; 
					  }
	
		echo '<center> <p> <select class="alert alert-info" name="flwselect" id="flwselect" autofocus required> </center> </p>';
		//	session_start();
			//$r = mysqli_fetch_row($result);
		//	printf($r[0]);
		//	mysqli_free-result($result);
		//while($n <	$r = mysqli_fetch_row($result))
			while($r = mysqli_fetch_array($result,MYSQLI_ASSOC))
			{	
				echo '<div class="panel-body"><option value="'.$r['User_id'].'"> '.$r['Fname'].'</option></div>';
				$_SESSION['id']=$r['User_id'];
			}
		
			//echo '</table>';
	
	mysqli_close($link);
 	}
?>
    <br /> <input type="button" class="panel-heading alert-danger" id="followbtn" value="Follow" onclick="follow()"/> </p>
    <br/>
	<div class="panel panel-warning">
	 <div class="panel-heading">
					<label id="flwresp"> </label>  
	</div>
	</div>
		 <div class="panel panel-warn">
	 <div class="panel-heading">
					No.followers: <label id="countfollowers"> </label>  
	</div>
	</div>


	 <div class="panel panel-warn">
	 <div class="panel-heading">
					No.following: <label id="countfollowing"> </label>  
	</div>
	</div>
        </div>
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

<!-- 
    Footer
-->
	<div class="navbar navbar-inverse navbar-fixed-bottom" role="navigation">
		<div class="container">
			<div class="navbar-text pull-left">
				<p> <copright> 2017 Bootstrap.com </p>
			</div>
			<div class="navbar-text pull-right">
				<a href="#"> <i class="fa fa-facebook-square fa-2x"></i></a>
				<a href="#"> <i class="fa fa-twitter-square fa-2x"></i></a>
			</div>
		</div>
	</div>



</body>
</html>