function registerComment(idPost)
{
	if (document.getElementById("commentText").value != "")
	{
		xhttp = new XMLHttpRequest();

		xhttp.onreadystatechange = function()
		{
			if (this.readyState == 4 && this.status == 200)
			{
				document.getElementById("commentText").value = "";
			}
		};

		xhttp.open("POST", "registerComment.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("idPost=" + idPost + "&text=" + document.getElementById("commentText").value);
	}
}