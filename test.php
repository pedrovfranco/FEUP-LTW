<?php
    include_once("utilities.php");

    ini_set('display_errors', 1);

    $id = loggedIn();

    if ($id == -1)
    {
        header('Location: index.php');
        die();
    }
    
	$dbh = new PDO('sqlite:database.db');
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    
    $query = $dbh->prepare('SELECT TOTAL(Upvotes-Downvotes) totalPosts FROM User U LEFT OUTER JOIN Post P ON U.idUser = P.idUser WHERE U.idUser = ? GROUP BY U.idUser');
    if (!$query->execute())
    {
		echo "\nPDO::errorInfo():\n";
		print_r($dbh->errorInfo());
		echo "Error!<br>";
    }

    $totalPosts = $query->
    
    $query = $dbh->prepare('SELECT TOTAL(Upvotes-Downvotes) totalComments from User U LEFT OUTER JOIN Comment C ON U.idUser = C.idUser WHERE U.idUser = ? GROUP BY U.idUser
    ');
    if (!$query->execute())
    {
		echo "\nPDO::errorInfo():\n";
		print_r($dbh->errorInfo());
		echo "Error!<br>";
    }

    

    $results = $query->fetchAll();

    console_log($results);
?>