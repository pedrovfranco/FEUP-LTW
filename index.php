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
		<h1><a href="index.html">The 12th Player</a></h1>
		<!-- <h2><a href="index.html">Welcome to our site ! </a></h2> -->
	</header>

	<?php
		include_once("utilities.php");
		$id = loggedIn();
		if ($id == -1) : ?>
			<div class="menu">
				<ul class="signup">
					<li class="active"> <a href="register.html">Register</a> </li>
					<li class="active"> <a href="login.html">Login</a> </li>
					<li class="active"> <a href="about.html">About</a> </li>
				</ul>
			</div>
	<?php else : ?>
		<div class="menu">
			<ul class="signup">
				<li class="active"> <a href="logout.php">Logout</a> </li>
				<li class="active"> <a href="about.html">About</a> </li>
				<li class="active"> <a href="profile.html">Profile</a> </li>
			</ul>
		</div>

		<form class="postButton" action="indextopost.php">
			<input type="submit" value="Create Post">
		</form>
	<?php endif; ?>

	

<!--	<div class="buttons">
		<a href="" class="btn1"> Best goals and skills </a>
		<a href="" class="btn2"> Best tackles </a>
	</div>-->
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
