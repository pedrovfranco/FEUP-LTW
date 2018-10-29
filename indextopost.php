<?php
		
	include_once("utilities.php");

	ini_set('display_errors', 1);
	
	$id = loggedIn();

	echo "$id<br>";

	if ($id == -1)
	{
		header("Location: login.html");
		exit(1);
	}
	else
	{
		header("Location: post.html");
		exit(1);
	}
?>