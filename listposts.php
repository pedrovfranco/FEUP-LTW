<?php
	
	include_once("utilities.php");

	ini_set('display_errors', 1);

	$dbh = new PDO('sqlite:database.db');
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

	$query = $dbh->prepare('SELECT * from Post');

	$status = $query->execute();

	if (!$status)
	{
	    echo "\nPDO::errorInfo():\n";
	    print_r($dbh->errorInfo());

	    echo "Error!<br>";
	}

	while ($row = $query->fetch())
	{
		$a = $row['idPost'];
		$b = $row['idUser'];
		$c = $row['Title'];
		$d = $row['Text'];
		$e = $row['Link'];
		$f = $row['Date'];
		$g = $row['Upvotes'];
		$h = $row['Downvotes'];

		echo "$a | $b | $c | $d | $e | $f | $g | $h<br>";
	}
	
?>