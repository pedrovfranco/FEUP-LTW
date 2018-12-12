<?php

	include_once("utilities.php");

	ini_set('display_errors', 1);

	$username = $_POST['username'];
	$hash = hash('sha256', $_POST['password']);
	$email = $_POST['email'];
	$age = $_POST['age'];

	$dbh = new PDO('sqlite:database.db');
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

	$id = loggedIn();

	if($id == -1)
	{
		echo "You aren't logged in, you can't edit your profile !";
	}

	$query1 = $dbh->prepare('SELECT * FROM User WHERE username = ?');
	$query1->execute(array($username));

	// $query0 = $dbh->prepare('SELECT * FROM User WHERE idUsername = :a')
	// $query0->bindParam(':a', $idS);

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
			$query3 = $dbh->prepare('UPDATE User SET username = ?, password = ?, email = ?, age = ? WHERE idUser = ?');
			$query3->execute(array($username, $hash, $email, $age, $id) );
			$result = $query3->fetch();
		}
	}


	echo "<br><a href=\"index.html\">Go Back</a> </li>";


?>
