<?php
 	include_once("utilities.php");

	ini_set('display_errors', 1);

	$id = loggedIn();

	if ($id == -1)
	{
		header("Location: login.html");
		die();
	}

 	$dbh = new PDO('sqlite:database.db');
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

	$query = $dbh->prepare('SELECT * FROM User WHERE idUser = ? ');
	$query->execute(array($id));

	$row = $query->fetchAll()[0];

	$username = $row['username'];
	$password = $row['password'];
	$age = $row['age'];
	$email = $row['email'];
	$pic = $row['pic'];

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
	<?php

    if ($id != -1) : ?>
	<div class="profile">
		<h1>Profile</h1>
		<h2> Edit your settings ! </h2>
		<form action="updateprofile.php" method="post">
			Username:<br>
    	<input type="text" name="username" value="">
			<br>
			Password:<br>
			<input type="password" name="password" value="">
			<br>
			E-mail:<br>
			<input type="email" name="email" value="">
			<br>
			Age:<br>
			<input type="number" min="13" max="120" name="age" value="">
			<br>
			<br>
			<img src="<?php $id = 0; getShirtHTML($id); ?>" alt="Benfica" style="width:100px;height:100px;">			
			<br>
			<br>
			<input type="submit" value="Edit">

		</form>
	</div>
	<?php else : ?>
		<div class="profileError">
			<h1> You can't acess your profile if you're not logged in ! </h1>
		</div>
	<?php endif; ?>

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
