<?php
	
	function displayUsers($dbh)
	{
		$query1 = $dbh->prepare('SELECT * FROM User');
		$query1->execute();

		while ($row = $query1->fetch())
		{
			$a = $row['idUser'];
			$b = $row['username'];
			$c = $row['password'];
			$d = $row['age'];
			$e = $row['email'];

			echo "$a | $b | $c | $d | $e<br>";
		}
	}

	function userExists($dbh, $username, $password)
	{   			
		$login = $dbh->prepare("SELECT * FROM User WHERE username = ? AND password = ?");

		$login->execute(array($username, $password));
		$result = $login->fetchAll();
		$count = count($result);

		return ($count == 1);
	}

?>