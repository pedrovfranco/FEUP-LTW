<?php

	include_once("utilities.php");

	ini_set('display_errors', 1);

	$username = $_POST['username'];
	$hash = hash('sha256', $_POST['password']);
	$email = $_POST['email'];
	$age = $_POST['age'];

	$dbh = new PDO('sqlite:database.db');
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

	$query1 = $dbh->prepare('SELECT * FROM User WHERE username = ?');
	$query1->execute(array($username));

	if (count($query1->fetchAll()) > 0)
	{
		echo "Username already taken!<br>";
	}
	else
	{
		$query2 = $dbh->prepare('SELECT * FROM User WHERE email = ?');
		$query2->execute(array($email));

		if (count($query2->fetchAll()) > 0)
		{
			echo "Email already taken!<br>";
		}
		else
		{
			$register = $dbh->prepare('INSERT INTO User VALUES (NULL, ?, ?, ?, ?)');

			$dbh->beginTransaction();

			$status = $register->execute(array($username, $hash, $age, $email));

			$dbh->commit();

			if (!$status)
			{
			    echo "\nPDO::errorInfo():\n";
			    print_r($dbh->errorInfo());

			    echo "Error on insert!<br>";
			}
			else
				echo "Register sucessful!<br>";
		}
	}


	echo "<br><a href=\"index.html\">Go Back</a> </li>";
?>
