<?php
	header("Content-type: text/event-stream");
	header("Cache-Control:no-cache");
	
	//set_time_limit(0);
	ob_start();
	
  	$oldtime = filemtime("lakkanna.txt");
	$oldtime2 = filemtime("dilip.txt");
	while(true)
	{
		clearstatcache();
		$newtime = filemtime("lakkanna.txt");
		
		if($newtime > $oldtime)
		{
			
			$file = file("lakkanna.txt");
			$msg=$file[sizeof($file)-1];
			//Fire the event
			echo "event:newmsg\n";
			echo "retry:100\n";
			echo "data:Me:\n";
			echo "data: $msg\n\n";
			
			ob_flush();
			flush();
		
			$oldtime = $newtime;
			fclose($file);
		}
		
	sleep(1);
	}
	while(true)
	{
		clearstatcache();
		$newtime2 = filemtime("dilip.txt");
		if($newtime2 > $oldtime2)
		{
			
			$file2 = file("dilip.txt");
			$msg2=$file2[sizeof($file2)-1];
			//Fire the event
			echo "event:oldmsg\n";
			echo "retry:100\n";
			echo "data:Friend:\n";
			echo "data: $msg2\n\n";
			
			
			ob_flush();
			flush();
		
			$oldtime2 = $newtime2;
			fclose($file2);
		}
		sleep(1);
	}
?>
