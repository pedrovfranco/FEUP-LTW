<?php
	
	function index()
	{
		$session = session_start();
		if (!$session)
		{
			echo "Session starting failed!<br>";
			exit(1);
		}

		if (isset($_SESSION['id']))
		{
			echo '<li class="active"> <a href="register.html">Register</a> </li>';
			echo '<li class="active"> <a href="login.html">Login</a> </li>';
		}
		else
		{
			echo '<li class="active"> <a href="register.html">Register</a> </li>';
			echo '<li class="active"> <a href="login.html">Login</a> </li>';
		}
	}
?>