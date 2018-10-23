<?php
	
	ini_set('display_errors', 1);

	// phpinfo();

	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$hash = hash('sha256', $password);
	// echo $hash;
	
	$email = $_POST['email'];
	$age = $_POST['age'];
	
	$dbh = new PDO('sqlite:database.db');

	$null = "NULL";

	$register = $dbh->prepare('INSERT INTO User (idUser, username, password, age, mail) VALUES (?, ?, ?, ?, ?)');

	$register->execute(array($null, $username, $hash, $age, $email));

	// $query1 = $dbh->prepare('SELECT * FROM User');
	// $query1->execute();
	
	// while ($row = $query1->fetch())
	// {
	// 	echo "$row['idUser'] | $row['username'] | $row['password'] | $row['age'] | $row['mail']<br>";
	// }
	
?>