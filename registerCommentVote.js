function upVoteComment(idComment)
{
	registerCommentVote(idComment, "up");
}

function downVoteComment(idComment)
{
	registerCommentVote(idComment, "down");
}


function registerCommentVote(idComment, voteType)
{
	xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function()
	{
		if (this.readyState == 4 && this.status == 200)
		{
			if (this.responseText.substring(0, 6) == "Error.")
				alert(this.responseText.substring(6));
			else
	  			document.getElementById("numberOfVotesComment"+idComment).innerHTML = this.responseText;
		}
	};

	xhttp.open("POST", "registerCommentVote.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("voteType=" + voteType + "&idComment=" + idComment);
}