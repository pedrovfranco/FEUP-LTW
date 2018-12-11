<?php

	include_once("utilities.php");
	
	$id = loggedIn();

	if ($id == -1)
	{
		echo "Must be logged in to upvote";
		exit(1);
	}

	$upvoteFlag = $_REQUEST['upvote'];
	$idPost = $_REQUEST['idPost'];

	$dbh = new PDO('sqlite:database.db');
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

	$query1 = $dbh->prepare('SELECT Upvotes, Downvotes FROM Post WHERE idPost = ?');
	$query1->execute(array($idPost));

	$result1 = $query1->fetchAll();

	$upvotes = $result1[0]['Upvotes'];
	$downvotes = $result1[0]['Downvotes'];

	if ($upvoteFlag == "true")
		$upvotes++;
	else
		$downvotes++;

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