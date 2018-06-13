<?php
session_start();
	extract($_GET);
    if($_SESSION['User_id']==1){$wrfile="lakkanna.txt";}
	else $wrfile="dilip.txt";
	$ff=fopen($wrfile,"a"); 
	//$ff=fopen("chatA.txt","a");
   $m= $msg.PHP_EOL;
  //  $m= $msg;
   // file_put_contents($ff,implode("\n",$msg)."\n",FILE_APPEND);
	fwrite($ff,$m);
    fclose($ff);
   // echo "parent.update('updated');";
?>