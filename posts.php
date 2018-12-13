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
	$posts = $query->fetchAll();
?>

<!DOCTYPE <!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<title> LTW </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="style.css" rel="stylesheet">
	<script src="./voteScript.js"></script>
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
					<li><a href="logout.php">Logout</a></li>
					<li><a href="profile.html">Profile</a></li>
				</ul>
			</div>
			<form class="submitButton" action="indextopost.php">
				<input type="submit" value="Submit a new post">
			</form>
		</div>
	</nav>
	     <!-- <div class="backgroundTactics">
		       <h1> POST </h1>
		   </div> -->
		   <div id="posts">
		   	<?php foreach($posts as $post) { ?>

		   		<div id="main" class="postPage">
		   			<div class='post'>
		   				<!-- <div class="post-number">1</div> -->
							<div class="post-body">
		   					<a href="postPage.php?id=<?=$post['idPost']?>" class='post-title'> <?=$post['Title']?> </a>
		   					<p> Submited on <?=date('H:i:s Y-m-d', $post['Date']);?> <a href="#" class='submitter'> <?=getUsernameFromID($dbh, $post['idUser']);?></a><br><br></p>
		   				</div>
							<div class="post-votes">
		   					<div class='ball up' >
		   						<button onclick='upVote(<?=$post['idPost']?>)' id='upVote()'>
		   							<img src="./upvote.jpg">
		   						</button>
		   					</div>
		   					<div id="numberOfVotes<?=$post['idPost']?>"><?=$post['Upvotes']-$post['Downvotes']?></div>
		   					<div class='ball down' id='downvote()'>
		   						<button onclick='downVote(<?=$post['idPost']?>)' id='downVote()'>
		   							<img src="./downvote1.png">
		   						</button>
		   					</div>
		   				</div>
		   				<div class='post-options'>
		   					<span>1000 comments</span>
		   					<span>share</span>
		   					<span>save to favourite posts</span>
		   					<span>report</span>
		   				</div>
		   			</div>
		   		</div>
				</div>

		   		<br><br>

		   	<?php } ?>
		   </section>

		  <!--  <div class="buttons">
		   	<a href="" class="btn1"> Best goals and skills </a>
		   	<a href="" class="btn2"> Best tackles </a>
		   </div> -->

       <!-- <div class='search-bar'>
				<input type="text" placeholder="search" class="search">
				<button class='search-button'>
					<a href='#'><img src="./lupa.png"></a>
				</button>
			</div>  -->
		</body>
		</html>
