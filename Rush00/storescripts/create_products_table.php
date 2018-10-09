<?php
	$link = require "connect_to_mysql.php";

	$sqlCommand = "CREATE TABLE products (
		id int(11) NOT NULL AUTO_INCREMENT,
		product_name varchar(255) NOT NULL,
		price varchar(16) NOT NULL,
		details text NOT NULL,
		category varchar(64) NOT NULL,
		subcategory varchar(64) NOT NULL,
		date_added date NOT NULL,
		PRIMARY KEY (id),
		UNIQUE KEY product_name(product_name)
		)";

	if (mysqli_query($link, $sqlCommand))
		echo "Your products table has been created succesfully.\n";
	else
		echo "CRITICAL ERROR: ".mysqli_errno($link);
?>