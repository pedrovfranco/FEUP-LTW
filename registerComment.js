function registerComment(idPost)
{
	console.log(document.getElementById("commentText").value);

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
					document.getElementById("comments").innerHTML += "\t\t" + this.responseText + "<br>\n\t\t\t\t" + text + "<br><br><br>";
					document.getElementById("commentText").value = "";
				}

			}
		};

		xhttp.open("POST", "registerComment.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("idPost=" + idPost + "&text=" + text);
	}
}