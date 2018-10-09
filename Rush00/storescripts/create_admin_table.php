<?php
	include "table_exists.php";

	$link = require "connect_to_mysql.php";
	$sqlCommand = "CREATE TABLE admin(
		id int(11) NOT NULL auto_increment,
		username varchar(24) NOT NULL,
		password varchar(24) NOT NULL,
		last_log_date date NOT NULL,
		PRIMARY KEY (id),
		UNIQUE KEY username (username)
		)";

	if (mysqli_query($link, $sqlCommand))
		echo "Your admin table has been created succesfully\n";
	else
		echo "CRITICAL ERROR: ".mysqli_errno($link);
?>