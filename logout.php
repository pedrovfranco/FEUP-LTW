<?php

	ini_set('display_errors', 1);

	$session = session_start();
	if (!$session)
	{
		echo "Session starting failed!<br>";
		exit(1);
	}

	$session = session_destroy();
	if (!$session)
	{
		echo "Session destroying failed!<br>";
		exit(1);
	}

	echo "<script type=\"text/javascript\">
            	javascript:history.go(-1);
            </script>";
	die();
?>