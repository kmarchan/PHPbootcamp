<?php
	session_start();

	if (!isset($_SESSION["manager"]))
	{
		header("location:admin_login.php");
		exit();
	}
	$managerID = preg_replace("#[^0-9]#i","", $_SESSION["id"]);
	$manager = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["manager"]);
	$password = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["password"]);
	$link = include "../storescripts/connect_to_mysql.php"; 
	$sql = mysqli_query($link ,"SELECT * FROM admin WHERE id='$managerID' AND username='$manager' AND password='$password' LIMIT 1");
	$existCount = mysqli_num_rows($sql);
	if ($existCount == 0)
	{
		echo "Your login session data is not on record in the database.";
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="text/html">
	<title>Store Admin Area</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="../style/main.css" />
	<style>
		.box{
			height: 200px;
			width: 400px;
		}
	</style>
</head>
<body>
	<?php include_once("../template_header.php")?> 
	<div id = "mainwrapper" align="center">
		<div id="pageContent">
			<div class="box" align="center">
				<div>
					<h2>Hello manager,<br/> what would you like to do today?</h2>
					<p>
						<div align="center" class="menue">
						<a href="inventory_list.php">Manage inventory</a>
						</div>
						</br>
						</br>
						<div class="menue">
						<a href="#">Manage something else</a>
						</div>
					<p>
				</div>
			</div>
		</div>
		<?php include_once("../template_footer.php")?> 
	</div>
</body>
</html>