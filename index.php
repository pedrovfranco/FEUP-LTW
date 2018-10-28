<?php

	include("utilities.php");

	$id = loggedIn();

	echo "$id";

	if ($id == -1)
	{
		echo "<li class=\"active\"> <a href=\"register.html\">Register</a> </li>";
		echo "<li class=\"active\"> <a href=\"login.html\">Login</a> </li>";
	}
	else if ($id > -1)
	{
		echo "<li class=\"active\"> <a href=\"register.html\">Register</a> </li>";
		echo "<li class=\"active\"> <a href=\"login.html\">Login</a> </li>";
	}
?>