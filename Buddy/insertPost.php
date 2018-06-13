<?php
    extract($_POST);
    session_start();
    $id=$_SESSION['User_id'];
    $Fname=$_SESSION['Fname'];
    $Password=$_SESSION['Password'];
   
    $link = mysqli_connect('127.0.0.1','root',''); 
    if (!$link)
    { 
	    die('Could not connect to MySQL: ' . mysqli_connect_error()); 
	} 
			date_default_timezone_set("Asia/Kolkata");  //selecting timezone
			$now = new DateTime();  
			$time = date("d/m/Y h:i:s a", time());  // current time and date
			mysqli_select_db($link,"buddy") or die (mysqli_connect_error()); // Pingning to the database
			
			$result = mysqli_query($link,"SELECT User_id,Fname FROM `users` WHERE User_id='$id' AND Fname='$Fname' AND Password='$Password'");

			if (!$result) 
            { 
                echo 'Not working :' . mysql_error();
				exit; 
		    }
			
			$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
              $r=$row['User_id'];
           $ftype='';
            $vid='';
            $img='';
            
             $ftype=explode(".",$file);
             $ptr=sizeof($ftype);
             
             $c=count($ftype);
            
            if($ftype[$c-1]=="mp4" OR $ftype[$c-1]=="mkv")
            {
                 $vid=$file;
            }
            else 
            {
               if($ftype[$c-1]=="jpg" OR $ftype[$c-1]=="gif" OR $ftype[$c-1]=="png") 
               {
                   $img=$file;
               }
            }
          
         
            if($txt!='' && $vid!='')
			{
			$sql=mysqli_query($link,"INSERT INTO `newsfeed` (`User_id`, `Status_type`, `Image`, `Text`, `Video`, `Time`) VALUES ('$r, 'video', '$img', '$txt', '$vid',  '$time')");	
			$notify=mysqli_query($link,"INSERT INTO `notifications` (`Sender_id`, `Receiver_id`, `Type`,`Notification`, `Time`) VALUES ( '$r','','video', 'Posted a new video', '$time')");
        	 }
             // inserting image
			 else
			 {
			    if($txt!='' && $img!='' && $img!=' ')
				{
					$sql=mysqli_query($link,"INSERT INTO `newsfeed` (`User_id`,`Status_type`, `Image`, `Text`, `Video`, `Time`) VALUES ('$r', 'image', '$img', '$txt', '$vid',  '$time')");
			
					$notify=mysqli_query($link,"INSERT INTO `notifications` (`Sender_id`, `Receiver_id`, `Type`,`Notification`, `Time`) VALUES ('$r','','image', 'Posted a new image', '$time')");
			     
                }

                // inserting text only
				else  
					 {
						if($txt!='')
						{
							$sql=mysqli_query($link,"INSERT INTO `newsfeed` (`User_id`,`Status_type`, `Image`, `Text`, `Video`, `Time`) VALUES ('$r', 'text','$img', '$txt', '$vid', '$time')");
							$notify=mysqli_query($link,"INSERT INTO `notifications` (`Sender_id`, `Receiver_id`,`Type`,`Notification`, `Time`) VALUES ('$r','','text', 'Posted a new text', '$time')");
						
                        }
					 }
				}    
			mysqli_close($link);  
            header('location:home.php');
?>