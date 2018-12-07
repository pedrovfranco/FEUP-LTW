function upVote()
{
  var xhttp = new XMLHttpRequest();



  count = count + 1;
  numberOfVotes.innerHTML = count;
}

function downVote()
{
  var numberOfVotes = document.getElementById('numberOfVotes');
  var count = parseInt(numberOfVotes.innerHTML);
  count = count - 1;
  numberOfVotes.innerHTML = count;
}


function getVotes(id)
{
	xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function()
	{
		if (this.readyState == 4 && this.status == 200)
		{
	  		document.getElementById("txtHint").innerHTML = this.responseText;
		}
	;

	xhttp.open("GET", "getcustomer.php?q="+str, true);
	xhttp.send();

}