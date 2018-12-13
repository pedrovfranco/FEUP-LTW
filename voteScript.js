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
			if (this.responseText.substring(0, 6) == "Error.")
				alert(this.responseText.substring(6));
			else
	  			document.getElementById("numberOfVotes"+id).innerHTML = this.responseText;
		}
	};

	xhttp.open("POST", "registerVote.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("voteType=" + voteType + "&idPost=" + id);
}
