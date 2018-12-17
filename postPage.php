<?php
	include_once("utilities.php");

	ini_set('display_errors', 1);

	$idPost = $_GET['id'];

	$idPost = preg_replace("/[^0-9]/", "", $idPost);

	$dbh = new PDO('sqlite:database.db');
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

	$query1 = $dbh->prepare('SELECT * FROM Post WHERE idPost = ?');

	$status1 = $query1->execute(array($idPost));

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
		$username = getUsernameFromID($dbh, $idUser);
		$Title = $post['Title'];
		$Text = $post['Text'];
		$Link = $post['Link'];
		$Date = $post['Date'];
		$Upvotes = $post['Upvotes'];
		$Downvotes = $post['Downvotes'];

		$paragraphs = explode("\n", $Text);

		if (substr($Link, 0, 7) != "http://")
			$Link = "http://" . $Link;
	}
	else if (count($fetched) == 0)
	{
		echo "Post not found!<br>";
		echo "<br><a href=\"login.php\">Go Back</a> </li>";
		die();
	}
	else
	{
		echo "Database error!<br>";
		echo "<br><a href=\"login.php\">Go Back</a> </li>";
		die();
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
	<script src="registerComment.js"></script>
	<script src="registerCommentVote.js"></script>
</head>
	<body>
		<header>
		</header>


		<div class="postPageMenu">
			<ul>
				<?php
					$id = loggedIn();
					if ($id == -1) : ?>
						<li class="active"> <a href="register.html">Register</a> </li>
						<li class="active"> <a href="login.html">Login</a> </li>
						<li class="active"> <a href="index.php">Home</a> </li>
					<?php else : ?>
						<li class="active"> <a href="profile.php">Profile</a> </li>
						<li class="active"> <a href="logout.php">Logout</a> </li>
						<li class="active"> <a href="index.php">Home</a> </li>
					<?php endif; ?>
			</ul>
		</div>

		<textarea id="commentText" placeholder="Comment here" rows="4" cols="40" maxlength="500" required></textarea>
		<button id="submitComment" onclick="registerComment(<?=$idPost?>)" > Submit </button>


		<section id="post">
			<article>
				<header>
					<h1>
						<a href="<?=$Link?>"><?=$Title?></a>
					</h1>

				</header>

				<p> Submited on <?= date('H:i:s Y-m-d', $Date)?> <a href="profile.php?id=<?= $idUser ?>" class='submitter'><?=$username?></a><br><br></p>

				<?php foreach ($paragraphs as $paragraph) { ?>
				<p><?=$paragraph?><p>
				<?php } ?>

				<!-- <footer>
					<span class="date"><?=date('Y-m-d H:i:s', $article['published']);?></span>
				</footer> -->
			</article>
		</section>

		<section id="comments">
			<?php foreach ($comments as $comment) { ?>
				<div id="comment<?=$comment['idComment']?>">
					<div class="comment-votes">
						<div class='ball up' >
							<button onclick='upVoteComment(<?=$comment['idComment']?>)' id='upVoteComment()'>
								<img src="./upvote.jpg">
							</button>
						</div>
						<div id="numberOfVotes<?=$comment['idComment']?>"><?=$comment['Upvotes']-$comment['Downvotes']?></div>
						<div class='ball down' id='downvote()'>
							<button onclick='downVoteComment(<?=$comment['idComment']?>)' id='downVoteComment()'>
								<img src="./downvote1.png">
							</button>
						</div>
					</div>
					<div class="commentUsername">
						<a href="profile.php?id=<?= $comment['idUser'] ?>" class='submitter'><?=$comment['username']?></a> <br>
					</div>
					<div class="commentText">
						<?=$comment['Text']?><br><br><br>
					</div>

				</div>

				<?php } ?>
		</section>

	</body>
</html>
