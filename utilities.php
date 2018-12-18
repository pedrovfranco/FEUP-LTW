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

	function getUsernameFromID($dbh, $id)
	{
		$query = $dbh->prepare('SELECT * FROM User WHERE idUser = ?');
		$query->execute(array($id));

		$results = $query->fetchAll();

		if (!$results)
		{
			echo "\nPDO::errorInfo():\n";
			print_r($dbh->errorInfo());

			echo "Error!<br>";
		}

		return $results[0]['username'];
	}

	function userExists($dbh, $username, $password)
	{   			
		$login = $dbh->prepare("SELECT * FROM User WHERE username = ? AND password = ?");

		$login->execute(array($username, $password));
		$result = $login->fetchAll();

		return $result;
	}

	function loggedIn()
	{   			
		$session = session_start();
		if (!$session)
		{
			echo "Session starting failed!<br>";
			exit(1);
		}

		if (isset($_SESSION['id']))
		{
			$id = $_SESSION['id'];
			return $id;
		}
		else
		{
			return -1;
		}
	}

	function getShirtById($id)
	{
		if ($id == 0)
		{
			return "images/camisolas/benfica.png";
		}
		else if ($id == 1)
		{
			return "images/camisolas/porto.png";
		}
		else if ($id == 2)
		{
			return "images/camisolas/sporting.png";
		}
		else if ($id == 3)
		{
			return "images/camisolas/braga.png";
		}
		else if ($id == 4)
		{
			return "images/camisolas/guimaraes.png";
		}
	}

	function getShirtHTML($id)
	{
		$pic = getShirtById($id);

		echo "$pic";
	}

	function selectShirt($id, $inputPic)
	{
		if (getShirtById($id) == $inputPic)
		{
			echo "checked=\"checked\"";
		}
	}

	function printConsole($data)
	{
	    $output = $data;
	    if ( is_array( $output ) )
	        $output = implode( ',', $output);

	    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
	}

	function console_log($data)
	{
	  echo '<script>';
	  echo 'console.log('. json_encode( $data ) .')';
	  echo '</script>';
	}

	function myUrlEncode($string)
	{
	    $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
	    $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
	    return str_replace($entities, $replacements, urlencode($string));
	}

?>