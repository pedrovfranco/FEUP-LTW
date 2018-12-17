function orderPosts()
{
	xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function()
	{
		if (this.readyState == 4 && this.status == 200)
		{
			if (this.responseText.substring(0, 6) == "Error.")
				alert(this.responseText.substring(6));
			else
			{
				document.getElementById("posts").innerHTML = this.responseText;
			}

		}
	};

	let orderType = document.getElementById("sort").value;

	xhttp.open("POST", "orderPosts.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("orderType=" + orderType);
}