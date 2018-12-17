<?php
 	include_once("utilities.php");

	ini_set('display_errors', 1);

    if (isset($_GET['id']))
	    $id = preg_replace("/[^0-9]/", "", $_GET['id']);
    else
        $id = loggedIn();

	if ($id == -1)
	{
		header("Location: login.html");
		die();
	}

 	$dbh = new PDO('sqlite:database.db');
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

	$query = $dbh->prepare('SELECT * FROM User WHERE idUser = ? ');
	if (!$query->execute(array($id)))
	{
		echo "\nPDO::errorInfo():\n";
		print_r($dbh->errorInfo());
		echo "Error!<br>";
	}

	$row = $query->fetch();

	$username = $row['username'];
	$age = $row['age'];
	$email = $row['email'];
    $pic = $row['pic'];
    

    $query = $dbh->prepare('SELECT P.idPost, P.Title, P.Date FROM User U, Post P WHERE U.idUser = P.idUser AND U.idUser = ?');
    if (!$query->execute(array($id)))
	{
		echo "\nPDO::errorInfo():\n";
		print_r($dbh->errorInfo());
		echo "Error!<br>";
    }
    
    $commentLimit = 5;
	$comments = array();

	for ($i = 0; $i < $postLimit; $i++)
	{
		$fetched = $query->fetch();
		if ($fetched)
			$posts[] = $fetched;
	}

	// $query = $dbh->prepare('SELECT P.Title FROM User U, Post P WHERE U.idUser = P.idUser AND U.idUser = ?');    
	// if (!$query->execute(array($id)))
	// {
	// 	echo "\nPDO::errorInfo():\n";
	// 	print_r($dbh->errorInfo());
	// 	echo "Error!<br>";
    // }
    
    // $postLimit = 5;
	// $posts = array();

	// for ($i = 0; $i < $postLimit; $i++)
	// {
	// 	$fetched = $query->fetch();
	// 	if ($fetched)
	// 		$posts[] = $fetched;
	// }
?>

<!DOCTYPE html>
<html>
<head>
	<title> LTW </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="style.css" rel="stylesheet">
</head>
<body>

    <div class="profile">
		<h1>Profile</h1>
		<h2> Edit your settings ! </h2>

        <br><br><br><br><br><br><br>
        <img src="<?= $pic ?>" style="width:100px;height:120px;">
        
        <div class="posts">
            <?php 

                foreach($posts as $post)
                {
                    $idPost = $post['idPost'];
                    $Title = $post['Title'];
                    $Date = $post['Date'];
                    $dateString = date('H:i:s Y-m-d', $Date);

                    echo "$username posted <a href=\"postPage.php?id=$idPost\">$Title</a> at $dateString<br><br>";
                }

            ?>

        </div>

        <br><br><br><br><br>

        <div class="comments">
            <?php 

                foreach($posts as $post)
                {
                    $idPost = $post['idPost'];
                    $Title = $post['Title'];
                    $Date = $post['Date'];
                    $dateString = date('H:i:s Y-m-d', $Date);

                    echo "$username posted <a href=\"postPage.php?id=$idPost\">$Title</a> at $dateString<br><br>";
                }

            ?>

        </div>

    </div>

	<div class="returnProfile">
	<a href="index.php">
		<img src="./12th.png">
	</a>
	</div>

<footer>
	<p>Page made by: Tomás Novo and João Pedro Viveiros Franco. LTW 2018/2019</p>
</footer>

</body>
</html>
