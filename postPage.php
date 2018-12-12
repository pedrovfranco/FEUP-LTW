<?php
	include_once("utilities.php");

	ini_set('display_errors', 1);

	$dbh = new PDO('sqlite:database.db');
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

	$query1 = $dbh->prepare('SELECT * FROM Post WHERE idPost = ?');

	$status1 = $query1->execute(array($_GET['id']));

	if (!$status1)
	{
		echo "\nPDO::errorInfo():\n";
		print_r($dbh->errorInfo());

		echo "Error!<br>";
	}

	$fetched1 = $query1->fetchAll();

	if (count($fetched1) == 1)
	{
		$post = $fetched1[0];

		$idPost = $post['idPost'];
		$idUser = $post['idUser'];
		$Title = $post['Title'];
		$Text = $post['Text'];
		$Link = $post['Link'];
		$Date = $post['Date'];
		$Upvotes = $post['Upvotes'];
		$Downvotes = $post['Downvotes'];

		$paragraphs = explode("\n", $Text);
	}
	else if (count($fetched) == 0)
	{
		echo "Post not found!<br>";
		echo "<br><a href=\"login.php\">Go Back</a> </li>";
	}
	else
	{
		echo "Database error!<br>";
		echo "<br><a href=\"login.php\">Go Back</a> </li>";
	}

	$query2 = $dbh->prepare('SELECT * FROM user, (SELECT * FROM Comment WHERE idPost = ?) as comments where user.idUser = comments.idUser');
	$status2 = $query2->execute(array($idPost));

	if (!$status2)
	{
		echo "\nPDO::errorInfo():\n";
		print_r($dbh->errorInfo());

		echo "Error!<br>";
	}

	$comments = $query2->fetchAll();

?>
<!DOCTYPE html>
<html>
<head>
	<title> LTW </title>
	<meta charset="UTF-8">
	<link href="style.css" rel="stylesheet">
	<script src="./commentScript.js"></script>
</head>
	<body>
		<header>
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
						<li class="active"> <a href="profile.html">Profile</a> </li>
					<?php endif; ?>
			</ul>
		</div>

		<section id="post">
			<article>
				<header>
					<h1>
						<a href="postPage.php?id=<?=$idPost?>"><?=$Title?></a>
					</h1>
				</header>
				<?php foreach ($paragraphs as $paragraph) { ?>
				<?=$paragraph?>
				<?php } ?>
				
				<!-- <footer>
					<span class="date"><?=date('Y-m-d H:i:s', $article['published']);?></span>
				</footer> -->
			</article>
		</section>

		<section id="comments">
			<?php foreach ($comments as $comment) { ?>
			<?=$comment['Text']?><br>
			<?=$comment['Username']?><br>
			<?php } ?>
			
			<!-- <footer>
				<span class="date"><?=date('Y-m-d H:i:s', $article['published']);?></span>
			</footer> -->
		</section>


		<textarea id="commentText" placeholder="Comment here" rows="4" cols="40" maxlength="500" required></textarea>


		<button id="submitComment" onclick="registerComment(<?=$idPost?>)" > Submit </button>

	


	</body>
</html>