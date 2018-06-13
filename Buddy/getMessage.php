<?php
session_start();
//echo "hello";
$str="";
$link = mysql_connect('127.0.0.1','root',''); 
		if (!$link) { 
					die('Could not connect to MySQL: ' . mysql_error()); 
					} 	
		else 
	  	{		
		mysql_select_db("buddy") or die (mysql_error());
		$User_id=$_SESSION['User_id'];
		$Password=$_SESSION['Password'];
		//	$fname=$_SESSION['Fname']
		$result = mysql_query("SELECT * FROM `users` WHERE User_id='$User_id' AND Password='$Password'");
		$m=mysql_fetch_array($result);
		
		$sql=mysql_query("SELECT * FROM `message` WHERE Sender='$m[0]' OR Reciever=$m[0] ORDER BY Time DESC");
		
		$n = mysql_query("SELECT count(Sender) FROM message");
      $i=mysql_fetch_array($sql);
	//	while($n < $i=mysql_fetch_array($sql))
	  //  {	
          for($x=0;$x<$n;$x++)
          {
			$name1 = mysql_query("SELECT Fname FROM `users` WHERE User_id='$i[0]'");
			$u1 = mysql_fetch_row($name1);
			$name2 = mysql_query("SELECT Fname FROM `users` WHERE User_id='$i[1]'");
			$u2 = mysql_fetch_row($name2); 
		
			if($i[2]=='text')
			{
			//echo $u1[0].'/'.$u2[0]. '/'.$i[4].'/'.$i[6];
			}
          //  $str .= $User_id.'/'.$i[1].'/';
          $str .=$u1.'/'.$u2;
          }
           // $str .="hello/lucky";
            echo $str;
			//echo 'lucky/ramachandra/walikar';
		/*	if($i[2]=='video')
			{
			echo '<table border="0" width="100%">';
			echo '<tr> <td>';
			echo  '<span class="style16">'.$i[0].' to '.$i[0]. '</span>';
			echo ' </td> </tr> <tr> <td> <video width="550" height="300" controls> <source src="';
			echo $i[5];
			echo '"/> </video> </td> </tr> <tr> <td>';
			echo $i[5];
			echo '</td> </tr> <tr> <td>';
			echo $i[6];
			echo '</td> </tr> </table> <hr> <br>';
			}
			if($i[2]=='image')
			{
			echo '<table border="0" width="100%">';
			echo '<tr> <td>';
			echo  '<span class="style16">'.$i[0].' to '.$i[1]. '</span>';
			echo ' </td> </tr> <tr> <td> <img src="';
			echo $i[3];
			echo '" width="300" height="250" />  </td> </tr> <tr> <td>';
			echo $i[4];
			echo '</td> </tr> <tr> <td>';
			echo $i[6];
			echo '</td> </tr> </table> <hr> <br>';
			} */
         //    echo $str;
		}
       
		if (!$result) { echo 'Not working :' . mysql_error();
						exit; 
					  }
		//}
	mysql_close();
?>