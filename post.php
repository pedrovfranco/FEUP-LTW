<?php
	
	include_once("utilities.php");

	ini_set('display_errors', 1);

	$title = $_POST['title'];
	$link = $_POST['link'];
	$text = $_POST['text'];

	$date = getdate()[0];

	$idUser = loggedIn();

	if ($idUser == -1)
	{
		echo "You must be logged in!";
		echo "<br><a href=\"index.html\">Go Back</a> </li>";
		exit(1);
	}

	$dbh = new PDO('sqlite:database.db');
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

	$register = $dbh->prepare('INSERT INTO Post VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)');

	$dbh->beginTransaction();

	$status = $register->execute(array($idUser, $title, $text, $link, $date, 0, 0));

	$dbh->commit();

	if (!$status)
	{
	    echo "\nPDO::errorInfo():\n";
	    print_r($dbh->errorInfo());

	    echo "Error on insert!<br>";
	}
	else
		echo "Post sucessful!<br>";

	echo "<br><a href=\"index.html\">Go Back</a> </li>";
?>