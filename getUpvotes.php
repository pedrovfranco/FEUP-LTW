<?php
	
	$dbh = new PDO('sqlite:database.db');

	$id = $_GET['idUser'];

	$query = $dbh->prepare('SELECT * FROM User where idUser = ?');
	$query->execute(array($id));

	

?>