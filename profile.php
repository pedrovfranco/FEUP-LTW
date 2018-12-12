<?php
 	include_once("utilities.php");

	ini_set('display_errors', 1);

 	$dbh = new PDO('sqlite:database.db');
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

  $query = $dbh->prepare('SELECT * FROM User WHERE idUser = :a ');
  $query->bindParam(':a', $idS);
  $query->execute();
  while ($row = $query->fetch())
  {
    $a = $row['idUser'];
    $b = $row['username'];
    $c = $row['password'];
    $d = $row['age'];
    $e = $row['email'];

    echo "$a | $b | $c | $d | $e<br>";
  }

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
		$id = loggedIn();
    // echo $id;

    $idS = (string)$id;

     $query1 = $dbh->prepare('SELECT * FROM User WHERE idUser = :a ');
     $query1->bindParam(':a', $idS);

     $query1->execute();

     while ($row = $query1->fetch())
     {
       $a = $row['idUser'];
       $b = $row['username'];
       $c = $row['password'];
       $d = $row['age'];
       $e = $row['email'];

       echo "$a | $b | $c | $d | $e<br>";
     }


    if ($id != -1) : ?>
	<div class="profile">
		<h1>Profile</h1>
		<h2> Edit your settings ! </h2>
		<form action="editprofile.php" method="post">
			Username:<br>
    	<input type="text" name="username" value="" required>
			<br>
			Password:<br>
			<input type="password" name="password" value="" required>
			<br>
			E-mail:<br>
			<input type="email" name="email" value="" required>
			<br>
			Age:<br>
			<input type="number" min="13" max="420" name="age" value="" required>
			<br>
			<br>
			<label class="big1">
				<img src="camisolas/benfica.png" alt="Benfica" style="width:100px;height:100px;">
				<input type="radio" name="team" value="1">
			</label>
			<label class="big2">
				<img src="camisolas/porto.jpg" alt="Porto" style="width:100px;height:100px;">
				<input type="radio" name="team" value="2">
			</label>
			<label class="big3">
				<img src="camisolas/sporting.png" alt="Sporting" style="width:100px;height:100px;">
				<input type="radio" name="team" value="3">
			</label>
			<label class="big4">
				<img src="camisolas/braga.jpg" alt="Braga" style="width:100px;height:100px;">
				<input type="radio" name="team" value="4">
			</label>
			<label class="big5">
				<img src="camisolas/guimaraes.png" alt="Guimarães" style="width:100px;height:100px;">
				<input type="radio" name="team" value="5">
			</label>

			<br>
			<br>
			<input type="submit" value="Register">

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
