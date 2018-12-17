function registerComment(idPost)
{
	if (document.getElementById("commentText").value != "")
	{
		let text = document.getElementById("commentText").value;

		xhttp = new XMLHttpRequest();

		xhttp.onreadystatechange = function()
		{
			if (this.readyState == 4 && this.status == 200)
			{
				if (this.responseText.substring(0, 6) == "Error.")
					alert(this.responseText.substring(6));
				else
				{
					let id = this.responseText.substring(0, this.responseText.indexOf("|"));
					let username = this.responseText.substring(this.responseText.indexOf("|")+1);

					document.getElementById("comments").innerHTML += "<div class=\"comment-votes\">\n<div class='ball up' >\n<button onclick='upVoteComment(" + id + ")' id='upVoteComment()'>\n<img src=\"./upvote.jpg\">\n</button>\n</div>\n<div id=\"numberOfVotes" + id + "\">0</div>\n<div class='ball down' id='downvote()'>\n<button onclick='downVoteComment(" + id + ")' id='downVoteComment()'>\n<img src=\"./downvote1.png\">\n</button>\n</div>\n</div>";
					document.getElementById("comments").innerHTML +="\n\n<div class=\"commentUsername\">\n"	+ username + "<br>\n</div>\n<div class=\"commentText\">\n" + text + "<br><br><br>\n</div>";
					document.getElementById("commentText").value = "";

				}

			}
		};

		xhttp.open("POST", "registerComment.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("idPost=" + idPost + "&text=" + text);
	}
}
