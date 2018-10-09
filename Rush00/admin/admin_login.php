<?php 
	session_start();
	if (isset($_SESSION["manager"])) {
		header("location: index.php"); 
		exit();
	}
?>
<?php 
if (isset($_POST["username"]) && isset($_POST["password"])) {

	$manager = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["username"]);
	$password = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["password"]);
	$link = include "../storescripts/connect_to_mysql.php"; 
	$sql = mysqli_query($link, "SELECT id FROM admin WHERE username='$manager' AND password='$password' LIMIT 1"); // query the person
	$existCount = mysqli_num_rows($sql);
	if ($existCount == 1)
	{
		while($row = mysqli_fetch_array($sql))
			$id = $row["id"];
		$_SESSION["id"] = $id;
		$_SESSION["manager"] = $manager;
		$_SESSION["password"] = $password;
		header("location: index.php");
		exit();
	}
	else
	{
		echo 'That information is incorrect, try again <a href="index.php">Click Here</a>';
		exit();
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Admin Login Page</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" media="screen" href="../style/main.css" />
		<style>
			.box {
				height: 300px;
				width: 400px;
			}
		</style>
	</head>
	<body>
			<div align="center" id="mainWrapper">
				<?php include_once("../template_header.php");?>
				<div id="pageContent"><br />
					<div class="box" align="center">
					<div align="center">
						<h2>Please Login To Manage the Store</h2>
						<form id="form1" name="form1" method="post" action="admin_login.php">
							User Name:
							</br>
							<input name="username" type="text" id="username" size="40"/>
							</br>
							</br>
							Password:
							</br>
							<input name="password" type="password" id="password" size="40"/>
							</br>
							</br>
							</br>
							<input type="submit" name="button" id="button" value="Log In"/>
						</form>
						<br><img align="center" id="logo" src="https://cdn0.iconfinder.com/data/icons/veterinary-line-1/48/26-512.png" alt="puppy">
						<p>&nbsp;</p>
					</div>
					<br />
					<br />
					<br />
				</div>
				</div>
			<?php include_once("../template_footer.php");?>
		</div>
	</body>
</html>