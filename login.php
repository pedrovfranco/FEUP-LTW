<?php

	ini_set('display_errors', 1);

	include_once("utilities.php");

	$session = session_start();
	if (!$session)
	{
		echo "Session starting failed!<br>";
		exit(1);
	}

	$username = $_POST['username'];
    $hash = hash('sha256', $_POST['password']);
    	
	$dbh = new PDO('sqlite:database.db');
	
	$results = userExists($dbh, $username, $hash);

	if (count($results) == 1)
	{
		$_SESSION['id'] = $results[0]['idUser'];
		header("Location: index.php");
		die();
	}
	else if (count($results) == 0)
	{
		header("Location: login.html");
		die();
	}
	else
	{
		echo "Database error!<br>";
		echo "<br><a href=\"login.html\">Go Back</a> </li>";
	}


?>