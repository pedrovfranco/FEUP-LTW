<?php
  	include_once("utilities.php");

	ini_set('display_errors', 1);

	$dbh = new PDO('sqlite:database.db');
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
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
	<header>
		<h1><a href="index.html">The 12th Player </a></h1>
		<!-- <h2><a href="index.html">Welcome to our site ! </a></h2> -->
	</header>

	<div class="menu">
    <ul>
			<?php
				$id = loggedIn();
				if ($id == -1) : ?>
					<li class="active"> <a href="register.html">Register</a> </li>
					<li class="active"> <a href="login.html">Login</a> </li>
					<li class="active"> <a href="about.html">About</a> </li>
			<?php else : ?>
				<li class="active"> <a href="logout.php">Logout</a> </li>
				<li class="active"> <a href="about.html">About</a> </li>
				<li class="active"> <a href="profile.php">Profile</a> </li>
		</ul>
    <form class="postButton" action="indextopost.php">
			<input type="submit" value="Create Post">
		</form>
    <?php endif; ?>

  </div>



  <div class="postIndex">
    <a href="POSTS.php">
      <img src="./posts.png">
    </a>
  </div>
	<footer>
		<p>Page made by: Tomás Novo and João Pedro Viveiros Franco. LTW 2018/2019</p>
	</footer>


<!--	<div class="topInterface">
	  <a href="#home">Home</a>
	  <a href="#about">About</a>
	  <a href="#contact">Contact</a>
	  <div class="searcher">
			<form action="/action_page.php">
			<input type="text" placeholder="Search.." name="search">
				<input type="image" src="lupa.png" alt="Submit Form" width="30" height="30"/>
		 </form>
	  </div>
	</div>-->

	</body>
</html>
