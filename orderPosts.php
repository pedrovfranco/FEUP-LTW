<?php

	include_once("utilities.php");
	
	$dbh = new PDO('sqlite:database.db');
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

	$orderType = "most recent";
	if (isset($_REQUEST['orderType']))
		$orderType = $_REQUEST['orderType'];

	if ($orderType == "top")
	{
		$query = $dbh->prepare('SELECT P.idPost, P.Title, P.Date, P.idUser, P.Upvotes, P.Downvotes, U.username, P.Upvotes-P.Downvotes votes, count(C.idComment) commentCount from Post P, User U LEFT OUTER JOIN Comment C ON P.idPost = C.idPost WHERE p.idUser = U.idUser GROUP BY P.idPost ORDER BY votes DESC');
	}
	else if ($orderType == "most recent")
	{
		$query = $dbh->prepare('SELECT P.idPost, P.Title, P.Date, P.idUser, P.Upvotes, P.Downvotes, U.username, count(C.idComment) commentCount from Post P, User U LEFT OUTER JOIN Comment C ON P.idPost = C.idPost WHERE p.idUser = U.idUser GROUP BY P.idPost ORDER BY Date DESC');
	}
	else if ($orderType == "most comments")
	{
		$query = $dbh->prepare('SELECT P.idPost, P.Title, P.Date, P.idUser, P.Upvotes, P.Downvotes, U.username, count(C.idComment) commentCount from Post P, User U LEFT OUTER JOIN Comment C ON P.idPost = C.idPost WHERE p.idUser = U.idUser GROUP BY P.idPost ORDER BY commentCount DESC');
	}
	else
	{
		echo "Error.Undefined orderType!";
		die();
	}

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

	$return = "";

	foreach($posts as $post)
	{
		$idPost = $post['idPost'];
		$Title = $post['Title'];
		$Date = $post['Date'];
		$idUser = $post['idUser'];
		$Upvotes = $post['Upvotes'];
		$Downvotes = $post['Downvotes'];
		$commentCount = $post['commentCount'];

		$Votes = $Upvotes-$Downvotes;
		$dateString = date('H:i:s Y-m-d', $Date);

		$username = getUsernameFromID($dbh, $idUser);

		$return .= 
		"\n\n<div id=\"main\" class=\"postPage\">
				<div class='post'>
					<!-- <div class=\"post-number\">1</div> -->
					<div class=\"post-body\">
						<a href=\"postPage.php?id=$idPost\" class='post-title'> $Title </a>
						<p> Submited on $dateString <a href=\"#\" class='submitter'>$username</a><br><br></p>
					</div>
					<div class=\"post-votes\">
						<div class='ball up' >
							<button onclick='upVote($idPost)' id='upVote()'>
								<img src=\"./upvote.jpg\">
							</button>
						</div>
						<div id=\"numberOfVotes$idPost\">$Votes</div>
						<div class='ball down' id='downvote()'>
							<button onclick='downVote($idPost)' id='downVote()'>
								<img src=\"./downvote1.png\">
							</button>
						</div>
					</div>
					<div class='post-options'>
						<span>$commentCount comments</span>
						<span>share</span>
						<span>save to favourite posts</span>
						<span>report</span>
					</div>
				</div>
			</div>";
	}

	echo "$return";

?>