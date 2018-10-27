<?php

	ini_set('display_errors', 1);

	$session = session_start();
	if (!$session)
	{
		echo "Session starting failed!<br>";
		exit(1);
	}

	$username = $_POST['username'];
    $hash = hash('sha256', $_POST['password']);
    	
	$dbh = new PDO('sqlite:database.db');
	
	$login = $dbh->prepare("SELECT * FROM User WHERE username = ? AND password = ?");

	$login->execute(array($username, $hash));
	$result = $login->fetchAll();
	$count = count($result);

	if ($count == 1)
	{
		echo "Login sucessful!<br>";
		$_SESSION['id'] = $result[0]['idUser'];
	}
	else if ($count == 0)
	{
		echo "Login failed!<br>";
	}
	else
	{
		echo "Database error!<br>";
	}
?>