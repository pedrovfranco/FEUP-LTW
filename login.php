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
		echo "Login sucessful!<br>";
		$_SESSION['id'] = $results[0]['idUser'];
		echo "<br><a href=\"index.html\">Go Back</a> </li>";
	}
	else if (count($results) == 0)
	{
		echo "Login failed!<br>";
		echo "<br><a href=\"register.html\">Go Back</a> </li>";
	}
	else
	{
		echo "Database error!<br>";
		echo "<br><a href=\"register.html\">Go Back</a> </li>";
	}


?>