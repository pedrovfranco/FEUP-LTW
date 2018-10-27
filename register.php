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

	$username = $_POST['username'];
	$hash = hash('sha256', $_POST['password']);
	$email = $_POST['email'];
	$age = $_POST['age'];

	$dbh = new PDO('sqlite:database.db');
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

	$query1 = $dbh->prepare('SELECT * FROM User WHERE username = ?');
	if ($query1->execute(array($username)) > 0)
	{
		echo "Username already taken!<br>";
		sleep(3);
		header("Location: https://web.fe.up.pt/~up201604828/projeto/register.html");
		exit(1);
	}

	$query2 = $dbh->prepare('SELECT * FROM User WHERE email = ?');
	if ($query2->execute(array($email)) > 0)
	{
		echo "Email already taken!<br>";
		sleep(3);
		header("Location: https://web.fe.up.pt/~up201604828/projeto/register.html");
		exit(1);
	}

	$register = $dbh->prepare('INSERT INTO User VALUES (NULL, ?, ?, ?, ?)');
	
	$dbh->beginTransaction();

	$register->execute(array($username, $hash, $age, $email));

	$dbh->commit();

	if (!$register->execute(array($username, $hash, $age, $email)))
	{
	    echo "\nPDO::errorInfo():\n";
	    print_r($dbh->errorInfo());

	    echo "Error on insert!<br>";
	}
	else
		displayUsers($dbh);
?>