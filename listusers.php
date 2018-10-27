<?php

	ini_set('display_errors', 1);

	include_once("utilities.php");

	$dbh = new PDO('sqlite:database.db');

	displayUsers($dbh);
?>