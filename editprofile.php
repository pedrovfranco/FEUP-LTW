<?php

	include_once("utilities.php");

	ini_set('display_errors', 1);

	$username = $_POST['username'];
	$hash = hash('sha256', $_POST['password']);
	$email = $_POST['email'];
	$age = $_POST['age'];
	$pic = getShirtById($_POST['team']);


	$dbh = new PDO('sqlite:database.db');
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

	$id = loggedIn();

	if($id == -1)
	{
		echo "You aren't logged in, you can't edit your profile !";
	}

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
			if ($username != "")
			{
				$query3 = $dbh->prepare('UPDATE User SET username = ? WHERE idUser = ?');
				$query3->execute(array($username, $id));
			}

			if ($_POST['password'] != "")
			{
				$query4 = $dbh->prepare('UPDATE User SET password = ? WHERE idUser = ?');
				$query4->execute(array($hash, $id));
			}

			if ($email != "")
			{
				$query5 = $dbh->prepare('UPDATE User SET email = ? WHERE idUser = ?');
				$query5->execute(array($email, $id));
			}

			if ($age != "")
			{
				$query6 = $dbh->prepare('UPDATE User SET age = ? WHERE idUser = ?');
				$query6->execute(array($age, $id));
			}

			$query7 = $dbh->prepare('UPDATE User SET pic = ? WHERE idUser = ?');
			$query7->execute(array($pic, $id));

			header("Location: index.php");
			die();
		}
	}


?>
