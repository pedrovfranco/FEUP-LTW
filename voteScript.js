function upVote()
{
  var numberOfVotes = document.getElementById('numberOfVotes');
  var count = parseInt(numberOfVotes.innerHTML);
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
