<?php

	ini_set('display_errors', 1);

	include_once("utilities.php");

	if (loggedIn() != -1)
	{
		echo "You are already logged in!<br>";
		echo "<br><a href=\"login.html\">Go Back</a> </li>";
		exit(1);
	}

	$dbh = new PDO('sqlite:database.db');
	
	$id = userExists($dbh, $_POST['username'], $_POST['password']);

	if ($id != -1)
	{
		$_SESSION['id'] = $id;
		header("Location: index.php");
		die();
	}
	else
	{
		echo "Login failed!<br>";
		echo "<br><a href=\"login.html\">Go Back</a> </li>";
	}


?>