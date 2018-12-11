<?php
	
	include_once("utilities.php");
	include("profile.php");

	echo "fdssssssssssssssssssssssssssssssssssssssssssssssssss";
	echo $idS;

	ini_set('display_errors', 1);

	$username = $_POST['username'];
	$hash = hash('sha256', $_POST['password']);
	$email = $_POST['email'];
	$age = $_POST['age'];
	
	$dbh = new PDO('sqlite:database.db');
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

	
	$query = $dbh->prepare('SELECT * FROM User WHERE idUser = :a ');
    $query->bindParam(':a', $idS);
    $query->execute();
    $result = $query->fetch();

    $query1 = $dbh->prepare('SELECT * FROM User WHERE username = ?');
	$query1->execute(array($username));
    

	
?>