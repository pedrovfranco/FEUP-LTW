<?php

	include_once("utilities.php");
	
	$id = loggedIn();

	if ($id == -1)
	{
		echo "Error.Must be logged in to upvote";
		exit(1);
	}

	$voteType = $_REQUEST['voteType'];
	$idPost = $_REQUEST['idPost'];

	$dbh = new PDO('sqlite:database.db');
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

	$query1 = $dbh->prepare('SELECT Upvotes, Downvotes FROM Post WHERE idPost = ?');
	$query1->execute(array($idPost));

	$result1 = $query1->fetchAll();

	$upvotes = $result1[0]['Upvotes'];
	$downvotes = $result1[0]['Downvotes'];

	if ($voteType == "up")
		$upvotes++;
	else if ($voteType == "down")
		$downvotes++;
	else
		echo 'Error retrieving voteType';

	$query2 = $dbh->prepare('UPDATE Post SET Upvotes = ?, Downvotes = ? WHERE idPost = ?');
	$query2->execute(array($upvotes, $downvotes, $idPost));

	if (!$query2)
	{
		echo "Error updating DB!";
		exit(1);
	}

	$dif = $upvotes-$downvotes;

	echo "$dif";

?>