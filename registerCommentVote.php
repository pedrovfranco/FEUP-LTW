<?php

	include_once("utilities.php");
	
	$id = loggedIn();

	if ($id == -1)
	{
		echo "Error.Must be logged in to upvote";
		exit(1);
	}

	$voteType = $_REQUEST['voteType'];
	$idComment = $_REQUEST['idComment'];

	$dbh = new PDO('sqlite:database.db');
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

	$query = $dbh->prepare('SELECT Upvotes, Downvotes FROM Comment WHERE idComment = ?');
	$query->execute(array($idComment));

	if (!$query)
	{
		echo "Error updating DB!";
		exit(1);
	}

	$result = $query->fetchAll();

	$upvotes = $result[0]['Upvotes'];
	$downvotes = $result[0]['Downvotes'];

	if ($voteType == "up")
		$upvotes++;
	else if ($voteType == "down")
		$downvotes++;
	else
		echo 'Error retrieving voteType';


	$query = $dbh->prepare('SELECT * FROM VotesComment WHERE idUser = ? AND idComment = ?');
	$query->execute(array($id, $idComment));

	if (!$query)
	{
		echo "Error updating DB!";
		exit(1);
	}

	$result = $query->fetchAll();

	if (count($result) == 0)
	{
		if ($voteType == "up")
			$query = $dbh->prepare('INSERT INTO VotesComment VALUES(?, ?, 1)');
		else if ($voteType == "down")
			$query = $dbh->prepare('INSERT INTO VotesComment VALUES(?, ?, -1)');
		else
			echo 'Error retrieving voteType';

		$query->execute(array($id, $idComment));

		if (!$query)
		{
			echo "Error updating DB!";
			exit(1);
		}

	}
	else if (count($result) == 1)
	{
		$value = $result[0]['value'];

		if ( ($voteType == "up" && $value == 1) || ($voteType == "down" && $value == -1) )
		{
			$query = $dbh->prepare('DELETE FROM VotesComment WHERE idUser = ? AND idComment = ?');

			if ($voteType == "up")
				$upvotes -= 2;
			else if ($voteType == "down")
				$downvotes -= 2;
		}
		else if ($voteType == "up")
		{
			$query = $dbh->prepare('UPDATE VotesComment SET value = 1 WHERE idUser = ? AND idComment = ?');

			if ($value == 1)
				$upvotes--;
			else if ($value == -1)
				$downvotes--;
		}
		else if ($voteType == "down")
		{
			$query = $dbh->prepare('UPDATE VotesComment SET value = -1 WHERE idUser = ? AND idComment = ?');

			if ($value == 1)
				$upvotes--;
			else if ($value == -1)
				$downvotes--;
		}
		else
			echo 'Error retrieving voteType';

		$query->execute(array($id, $idComment));

		if (!$query)
		{
			echo "Error updating DB!";
			exit(1);
		}

	}
	else
	{
		echo "Error on DB!";
		exit(1);
	}

	
	$query = $dbh->prepare('UPDATE Comment SET Upvotes = ?, Downvotes = ? WHERE idComment = ?');
	$query->execute(array($upvotes, $downvotes, $idComment));

	if (!$query)
	{
		echo "Error updating DB!";
		exit(1);
	}

	$dif = $upvotes-$downvotes;

	echo "$dif";

?>