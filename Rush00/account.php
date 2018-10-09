<?php
session_start();
$link = require "storescripts/connect_to_mysql.php";
// print_r($_GET);
// print_r($_SESSION);
if($_GET['delete'])
{
	if ($_SESSION['user'])
	{
		$usr = $_SESSION['user'];
		echo $usr;
		$sql = "DELETE FROM users WHERE username='$usr'";
		$connect = include "storescripts/connect_to_mysql.php";
		mysqli_query($connect, $sql);
		echo "Account Deleted";
		header("location: index.php");
		exit();
	}
}
if ($_POST['submit'])
{
	print_r($_SESSION);
	$usr = $_SESSION['user'];
	$new_usr = $_POST['login'];
	$new_pass = $_POST['password'];
	mysqli_query($link, "UPDATE users set password='$new_pass' where username='$usr'");
	mysqli_query($link, "UPDATE users set username='$new_usr' where username='$usr'");
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Account Settings</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style/main.css" />
</head>
<body>
	<?php include_once("template_header.php")?> 
		<div id="pageContent">
		<table width="100%" border="0">
			<tr>
				<td width="50%" valign="top">
	                <div id = "wrapper" align="center">
                    <p align="center" ><h2>Change Login Details</h2>
                    <form method="POST" action="">
                    <input name="login" type="login" placeholder="New username" >
					<br>
					<input name="password" type="password" placeholder="New password">
					<br>
					<button value="OK" name="submit" type="submit" >OK</button>
                    </form>
                    <br>
                    <br>
                    </p>
                    </div>
				</td>
				<td width="50%" valign="top">
	                <div id = "wrapper" align="center">
                    <a href="account.php?delete=yes" ><p><h2>Delete Account</h2></p></a>
                    </div>
				</td>
			</tr>
		</table>
		</div>
		<?php include_once("template_footer.php")?> 
		</div>
</body>
</html>