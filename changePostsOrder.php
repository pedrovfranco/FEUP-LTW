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

	$query = $dbh->prepare('INSERT INTO Comment VALUES (NULL, ?, ?, ?, 0, 0)');
	$query->execute(array($id, $idPost, $text));

	$username = getUsernameFromID($dbh, $id);

	$query = $dbh->prepare("SELECT last_insert_rowid()");
	$query->execute();

	$idComment = $query->fetchAll()[0][0];


	echo "$idComment|$username";
?>