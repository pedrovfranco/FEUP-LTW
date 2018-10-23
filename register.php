<?php

	function displayUsers($dbh)
	{
		$query1 = $dbh->prepare('SELECT * FROM User');
		$query1->execute();
		
		while ($row = $query1->fetch())
		{
			$a = $row['idUser'];
			$b = $row['username'];
			$c = $row['password'];
			$d = $row['age'];
			$e = $row['email'];

			echo "$a | $b | $c | $d | $e<br>";
		}
	}
	
	ini_set('display_errors', 1);

	// phpinfo();

	$username = $_POST['username'];
	// $username = "\"$username\"";

	$password = $_POST['password'];
	
	$hash = hash('sha256', $password);
	$hash = "\"$hash\"";
	// echo $hash;
	
	$email = $_POST['email'];
	$email = "\"$email\"";

	$age = $_POST['age'];
	
	$dbh = new PDO('sqlite:database.db');
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

	$register = $dbh->prepare('INSERT INTO User (idUser, username, password, age, email) VALUES (NULL, ?, ?, ?, ?)');
	
	$dbh->beginTransaction();

	$register->execute(array($username, $hash, $age, $email));

	$dbh->commit();

	displayUsers($dbh);
?>