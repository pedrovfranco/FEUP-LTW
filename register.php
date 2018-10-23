<?php

	$username = $_POST['username'];
	$password = $_POST['password'];
	$hash = openssl_encrypt($password, 'AES128', 0);
	echo $hash;
	$email = $_POST['email'];
	
	$dbh = new PDO('sqlite:database.db');
	
	$cria = $dbh->prepare('.load criarDB.sql');
	$cria->execute();
	
	$povoa = $dbh->prepare('.load povoarDB.sql');
	$povoa->execute();

	$query1 = $dbh->prepare('SELECT * FROM User');
	$query1->execute();
	
	$result = $query1->fetchAll();

	foreach ($result as $row) {
	  echo $row['username'];
	}
	
?>