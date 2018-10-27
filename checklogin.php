<?php

	ini_set('display_errors', 1);

	$session = session_start();
	if (!$session)
	{
		echo "Session starting failed!<br>";
		exit(1);
	}

	if (isset($_SESSION['id']))
	{
		$id = $_SESSION['id'];
		echo "Session id : $id<br>";
	}
	else
	{
		echo "Session not found!<br>";
	}
	
?>