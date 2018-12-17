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

	$postLimit = 5;
	$posts = array();

	for ($i = 0; $i < $postLimit; $i++)
	{
		$fetched = $query->fetch();
		if ($fetched)
			$posts[] = $fetched;
	}


?>

<!DOCTYPE <!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<title> LTW </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="style.css" rel="stylesheet">
	<script src="orderPosts.js"></script>
	<script src="registerVote.js"></script>
</head>
<body>
	<nav class='posts'>
		<div class = "logo">
			<a href="./index.php">
				<img src='./12th.png'>
			</a>
		</div>
		<div class= "posts2">
			<ul>
				<li><a href="#a">Best Skills</a></li>
				<li><a href=#b>Best Goals</a></li>
				<li><a href=#c>Worst Tackles </a></li>
				<li><a href=#d>Funny Moments </a></li>
				<li><a href=#e>Éder = God </a></li>
			</ul>
		</div>
		<div class="profileInPosts">
			<div>
				<ul>
					<?php
					$id = loggedIn();
					if ($id == -1) : ?>
						<li><a href="index.php">Home</a></li>
						<li><a href="login.html">Login</a></li>
						<?php else : ?>
							<li><a href="index.php">Home</a></li>
							<li><a href="logout.php">Logout</a></li>
							<li><a href="profile.php">Profile</a></li>
						</ul>
					</div>
					<form class="submitButton" action="indextopost.php">
						<input type="submit" value="Submit a new post">
					</form>
				<?php endif; ?>
			</div>
		</nav>
		<div id="posts">
			<?php include_once("orderPosts.php") ?>
		
		</div>


		<select id="sort" onchange="orderPosts()">
			<option value="most recent">most recent</option>
			<option value="top">top</option>
			<option value="most comments">most comments</option>
		</select>


		</html>
