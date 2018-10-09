<?php
	$db_host = "localhost";
	$db_username = "root";
	$db_pass = "9501290023082";
	$db_name = "rush00_database";

	$link = mysqli_connect($db_host, $db_username, $db_pass) or die ("Could not connect to mysql");
	mysqli_select_db($link, $db_name) or die ("No database");
	// if ($link)
	// 	echo "Connected to mysql\n";
	return ($link);
?>