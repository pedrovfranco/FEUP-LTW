<?php

	ini_set('display_errors', 1);

	$username = $_POST['username'];
    $password = $_POST['password'];
    
    $hash = 
	
	$dbh = new PDO('sqlite:database.db');

	$insert = sprintf("INSERT INTO User (idUser, username, password, age, email) VALUES (9, \"%s\", \"%s\", %s, \"%s\")", $username, $cona, $age, $email);
	
	$register = $dbh->prepare($insert);

	$register->execute();

	displayUsers($dbh);
?>