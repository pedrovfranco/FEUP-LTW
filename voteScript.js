function upVote(id)
{
	registerVote(id, "up");
}

function downVote(id)
{
	registerVote(id, "down");
}

function registerVote(id, voteType)
{
	xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function()
	{
		if (this.readyState == 4 && this.status == 200)
		{
	  		document.getElementById("numberOfVotes").innerHTML = this.responseText;
		}
	};

	xhttp.open("GET", "registerVote.php?voteType=" + voteType + "&idPost=" + id, true);
	xhttp.send();
}


function getVotes(id)
{
	xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function()
	{
		if (this.readyState == 4 && this.status == 200)
		{
	  		document.getElementById("numberOfVotes").innerHTML = this.responseText;
		}
	};

	// xhttp.open("POST", "upvote.php", true);
	// xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	// xhttp.send("upvote=false");

	xhttp.open("GET", "upvote.php?upvote=false&idPost=" + id, true);
	xhttp.send();

}