<?php
	header("Content-type:text/xml");
	$feed = file_get_contents("http://localhost/Buddy/rss3/cricketrss.xml");
	echo $feed;
?>
