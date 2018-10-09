<?php
	require "connect_to_mysql.php";
	$sqlCommand = "CREATE TABLE users(
		id int(11) NOT NULL auto_increment,
		username varchar(24) NOT NULL,
		password varchar(24) NOT NULL,
		active BOOL NOT NULL DEFAULT 0,
		PRIMARY KEY (id),
		UNIQUE KEY username (username)
		)";
	if (mysqli_query($link, $sqlCommand))
		echo "Your user table has been created succesfully\n";
	else
		echo "CRITICAL ERROR: ".mysqli_errno($link);
?>