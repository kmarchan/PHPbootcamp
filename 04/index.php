<?php
	session_start();
	
?>

<html>
<head>
	<title>index.php</title>
	<style>
		body {
			background-color: grey;
		}
		.box {
			position: relative;
			border-radius: 30px;
			background-color: #d3d3d3;
			box-shadow: 10px 10px 10px black;
			text-align: center;
			height: 100px;
			width: 300px;
			top: 100px;
			margin: auto;
		}
		input {
			position: relative;
			top: 10px;
		}
		button {
			position: relative;
			display: inline-block;
			top: 20px;
		}
	</style>
</head>
<body>
	<div class="box">
		<form action="get">
	    	<input type="login" value="Login"><br><input type="passwd" value="Password"><br><button name="submit" type="OK">OK</button>
		</form>
	</div>
</body>
</html>