<?php
	
	include_once("utilities.php");

	ini_set('display_errors', 1);

	$dbh = new PDO('sqlite:database.db');
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

	$query = $dbh->prepare('SELECT * from Comment');

	$status = $query->execute();

	if (!$status)
	{
	    echo "\nPDO::errorInfo():\n";
	    print_r($dbh->errorInfo());

	    echo "Error!<br>";
	}

	while ($row = $query->fetch())
	{
		$a = $row['idComment'];
		$b = $row['idUser'];
		$c = $row['idPost'];
		$d = $row['Text'];
		$e = $row['Upvotes'];
		$f = $row['Downvotes'];

		echo "$a | $b | $c | $d | $e<br>";
	}
	
?>