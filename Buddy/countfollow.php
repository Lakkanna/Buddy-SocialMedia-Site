<?php
    session_start();
    	$User_id=$_SESSION['User_id'];
		$Password=$_SESSION['Password'];
				
				
		$link = mysqli_connect('127.0.0.1','root',''); 
		if (!$link) { 
					die('Could not connect to MySQL: ' . mysql_error()); 
					} 	
		else 
	  	{		
		mysqli_select_db($link,"buddy") or die (mysql_error());
  		$result = mysqli_query($link,"SELECT * FROM `users` WHERE User_id='$User_id' AND Password='$Password'");
		$m=mysqli_fetch_array($result,MYSQLI_ASSOC);

		// number of followers
		$mm=$m['User_id'];
		$followerssql=mysqli_query($link,"SELECT * FROM following WHERE user2='$mm'");
		$count="";
   		 $followers=0;
		$following=0;

		while($i=mysqli_fetch_array($followerssql,MYSQLI_ASSOC))
		{	
			$followers++;
		}
	
		// number friends you following
			$followingsql=mysqli_query($link,"SELECT * FROM following WHERE user1='$mm'");
			
		while($j=mysqli_fetch_array($followingsql,MYSQLI_ASSOC))
		{	
			$following++;
		}
     $count= $followers.";".$following;
		if (!$result) { echo 'Not working :' . mysql_error();
						exit; 
					  }
	
	mysqli_close($link);
    echo $count;
 	}

?>