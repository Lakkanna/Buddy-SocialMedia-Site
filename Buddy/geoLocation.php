<!DOCTYPE html> 
<html> 
<head> 
<meta name="viewport" content="initial-scale=1.0, user-scalable=no"/> 
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/> 
<title>Geo Location</title> 
<style type="text/css">
.uname {color:#FFFFFF;}
.mapholder {
	box-shadow: 2px 2px 15px #fff;
	border: 1px solid #fff;
	width: 640px;

	background-attachment: scroll;
	background-color: #FFFFFF;
	background-image: none;
	background-repeat: repeat;
	background-position: 0% 0%;
	height: 0px;
	margin-top: 0%;
	margin-right: auto;
	margin-bottom: 0px;
	margin-left: auto;
	padding-top: 0px;
	padding-right: 1px;
	padding-bottom: 354px;
	padding-left: 1px;
	overflow: hidden;
}
.btn{ 

	width: 640px;
	background-attachment: scroll;
	background-color: #000000;
	background-image: none;
	background-repeat: repeat;
	background-position: 0% 0%;
	height: 35px;
	margin-top: 2%;
	margin-right: auto;
	margin-bottom: 0px;
	margin-left: auto;
	padding-top: 0px;
	padding-right: 1px;
	padding-bottom: 10px;
	padding-left: 1px;
	top: 0px;
	font-family: Georgia, "Times New Roman", Times, serif;
	font-size: 16px;
	font-style: normal;
	line-height: normal;
	color: #FFFFFF;
	text-align: center;
	font-weight: bold;
	display: block;
	}
.loclabel {
	box-shadow: 1px 1px 5px #fff;
	border: 1px solid #fff;
	width: 640px;
	border-radius: 50px 50px 0px 0px;
	background-attachment: scroll;
	background-color: #33CCFF;
	background-image: none;
	background-repeat: repeat;
	background-position: 0% 0%;
	height: 40px;
	margin-top: 0%;
	margin-right: auto;
	margin-bottom: 0px;
	margin-left: auto;
	padding-top: 0px;
	padding-right: 1px;
	padding-bottom: 10px;
	padding-left: 1px;
	top: 0px;
	font-family: Georgia, "Times New Roman", Times, serif;
	font-size: 18px;
	font-style: normal;
	line-height: normal;
	color: #FFFFFF;
	text-align: center;
	font-weight: bold;
	display: block;
}
.adrholder {
	box-shadow: 1px 1px 5px #fff;
	border: 1px solid #fff;
	width: 640px;
	border-radius: 0px 0px 50px 50px;
	background-attachment: scroll;
	background-color: #0066FF;
	background-image: none;
	background-repeat: repeat;
	background-position: 0% 0%;
	height: 40px;
	margin-top: 0%;
	margin-right: auto;
	margin-bottom: 0px;
	margin-left: auto;
	padding-top: 0px;
	padding-right: 1px;
	padding-bottom: 10px;
	padding-left: 1px;
	top: 0px;
	font-family: sans-serif;
	font-size: 14px;
	font-style: normal;
	line-height: normal;
	color: #FFFFFF;
	text-align: center;
	font-weight: bold;
	display: block;
}
.getin{
	background-color: #1bb2e9;
	border: none;
	border-radius: 50px 50px 50px 50px;
-moz-border-radius: 0px 3px 3px 0px;
-webkit-border-radius: 0px 3px 3px 0px;
	color: #f4f4f4;
	cursor: pointer;
	height: 45px;
	text-transform: uppercase;
	width: 640px;
	clip: rect(5px,auto,auto,auto);
	padding: 5px;
	font-size: 16px;
}
body {
background-color:#000000;}
.style1 {
	color: #FF9900;
	font-weight: bold;
}
.style2 {
	font-size: 24px;
	color: #FFFFFF;
}
</style>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script> 
<script type="text/javascript"> 
  var geocoder;

  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(successFunction, errorFunction);
} 
//Get the latitude and the longitude;
function successFunction(position) {
    var lat = position.coords.latitude;
    var lng = position.coords.longitude;
    codeLatLng(lat, lng)
	
	// var lat = 12.927138;
   // var lng = 77.536511;
    //codeLatLng(lat, lng)
}

function errorFunction(){
    document.getElementById('mapholder').innerHTML="Check your internet connection...!";
}

  function initialize() {
    geocoder = new google.maps.Geocoder();
  }

  function codeLatLng(lat, lng) {

    var latlng = new google.maps.LatLng(lat, lng);
    geocoder.geocode({'latLng': latlng}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
      console.log(results)
        if (results[1]) {
         //formatted address
        // alert(results[0].formatted_address)
		var img_url = "http://maps.googleapis.com/maps/api/staticmap?center="
   +latlng+"&zoom=18&size=800x355&sensor=false"; 
		document.getElementById("mapholder").innerHTML = "<img src='"+img_url+"'>";
		 document.getElementById("adrholder").innerHTML="<br />"+results[0].formatted_address;
        //find country name
             for (var i=0; i<results[0].address_components.length; i++) {
            for (var b=0;b<results[0].address_components[i].types.length;b++) {

            //there are different types that might hold a city admin_area_lvl_1 usually does in come cases looking for sublocality type will be more appropriate
                if (results[0].address_components[i].types[b] == "administrative_area_level_1") {
                    //this is the object you are looking for
                    city= results[0].address_components[i];
			                }
            }
        }
        //city data
       // alert(city.short_name + " " + city.long_name)
		//document.getElementById("adr").innerHTML="State :" + city.short_name + " " + city.long_name;


        } else {
          document.getElementById("mapholder").innerHTML="No results found";
        }
      } else {
        document.getElementById("mapholder").innerHTML="Geocoder failed due to: " + status;
      }
    });
  }
</script>


<?php  

	if (!extract ($_POST))
	{		
			echo '<script>';
			echo 'window.open("Login.php","_self");';
			echo '</script>';
	}
	else {		
			$link = mysql_connect('127.0.0.1','root',''); 
			if (!$link) { 
							die('Could not connect to MySQL: ' . mysql_error()); 
						} 
				$email = $_POST['userId'];
				$passwd = $_POST['password'];
				mysql_select_db("nearbyuddy") or die (mysql_error());
  				$result = mysql_query("SELECT User_id,Fname,Password FROM `users` WHERE Email='$email' OR Fname='$email' AND Password='$passwd'");
		
				if (!$result) { echo 'Not working :' . mysql_error();
								exit; 
								}
				$row = mysql_fetch_row($result);
				session_start();
				$_SESSION['User_id']= $row[0];
				$_SESSION['Fname']= $row[1];
				$_SESSION['Password']= $row[2];
				$_SESSION['Location']=$_POST['location'];
				$_SESSION['Latitude']=$_POST['latitude'];
				$_SESSION['Longitude']=$_POST['longitude'];
				
				$User_id=$_SESSION['User_id'];
				$Fname=$_SESSION['Fname'];
				$Password=$_SESSION['Password'];
				$Location=$_SESSION['Location'];
				$Latitude=$_SESSION['Latitude'];
				$Longitude=$_SESSION['Longitude'];
			
				if(($email and $User_id) && ($passwd and $Password))
				{	
						echo '<script> window.alert("Login Successfull Welcome '.$row[1].'"); </script>';
				
				}
				if(($email != $User_id) && ($passwd != $Password))
				{	
						echo '<script> window.alert("Invalid Username/Password"); window.open("Login.php","_self"); </script>';
				
				}
			$alter = mysql_query("UPDATE  `users` SET  `Status` =  'online' WHERE  `users`.`Fname` = '$Fname'");
			date_default_timezone_set("Asia/Kolkata");
			$now = new DateTime();
			$time = date("d/m/Y h:i:s a", time());
			$check=mysql_query("SELECT * from geolocation where user_id='$row[0]'");
		$geoUpdate = mysql_query("UPDATE `geolocation` SET user_id='$User_id', Location='$Location', Latitude='$Latitude', Longitude='$Longitude' WHERE user_id='$User_id'");
   				$geo = mysql_query("INSERT INTO `geolocation` (`user_id`, `Location`, `Latitude`, `Longitude`) VALUES ('$User_id','$Location', '$Latitude', '$Longitude')");
			
				
		}
			mysql_close();

?>  
</head> 
<body onLoad="initialize()"> 
<p align="center" class="style1 style2" style="border-bottom:2px solid #F90"> NearByBuddy</p>
<p id='uname' class='uname'> <?php echo $_SESSION['Fname']; ?> </p>
<div class="loclabel" id="loclabel"><br /> Geo Location </div>
<div class="mapholder" id="mapholder"> </div>
<div class="adrholder" id="adrholder" > </div>
<div class="btn" id="btn" > 
<input name="Submit" type="submit" class="getin" onClick="window.open('NearByBuddy.php','_self')" value="Getin" />
</div>
</body> 
</html> 