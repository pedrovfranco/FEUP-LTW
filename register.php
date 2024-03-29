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
			$register = $dbh->prepare('INSERT INTO User VALUES (NULL, ?, ?, ?, ?, ?)');

			$pic = getShirtById(rand(0, 4));

			$dbh->beginTransaction();

			$status = $register->execute(array($username, $hash, $age, $email, $pic));

			$dbh->commit();

			if (!$status)
			{
			    echo "\nPDO::errorInfo():\n";
			    print_r($dbh->errorInfo());

			    echo "Error on insert!<br>";
			}
			else
			{
				$idQuery = $dbh->prepare("SELECT last_insert_rowid()");
				if (!$idQuery->execute())
				{
				    echo "\nPDO::errorInfo():\n";
				    print_r($dbh->errorInfo());

				    echo "Error on insert!<br>";
				}

				$id = $idQuery->fetch()[0];

				$session = session_start();
				if (!$session)
				{
					echo "Session starting failed!<br>";
					exit(1);
				}

				$_SESSION['id'] = $id;

				header("Location: index.php");
				die();
			}
		}
	}


	echo "<br><a href=\"index.html\">Go Back</a> </li>";
?>
