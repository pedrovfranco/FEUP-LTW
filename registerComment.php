<?php

	include_once("utilities.php");
	
	$id = loggedIn();

	if ($id == -1)
	{
		echo "Error.Must be logged in to upvote";
		exit(1);
	}

	$idPost = $_REQUEST['idPost'];
	$text = $_REQUEST['text'];

	$dbh = new PDO('sqlite:database.db');
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

	$query1 = $dbh->prepare('INSERT INTO Comment VALUES (NULL, ?, ?, ?, 0, 0)');
	$query1->execute(array($id, $idPost, $text));
	

	$username = getUsernameFromID($dbh, $id);

	echo "$username";
?>