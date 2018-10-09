<?php
	session_start();
	session_destroy();
	unset($_SESSION['user']);
	header("location:http://localhost:8080/rush00/index.php");
?>