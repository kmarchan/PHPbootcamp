<?php
    $link = include "storescripts/connect_to_mysql.php";
    if ($_POST["login"])
    {
        session_start();
        $user = mysqli_real_escape_string($link, $_POST["username"]);
        $passwd = mysqli_real_escape_string($link, $_POST["password"]);
        $sql = "SELECT * FROM users WHERE username='$user' AND PASSWORD='$passwd'";
        $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result) == 1)
        {
            $_SESSION['user'] = $user;
            header("location:http://localhost:8080/rush00/index.php");
        }
        else
        {
            echo $user."\n";
            echo $passwd."\n";
            echo "Failed to login";
        }
    }
?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
    <meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style/main.css" />
    <style>
        .box {
        background-color: grey;
        position: relative;
        border-radius: 30px;
        box-shadow: 10px 10px 30px  rgb(133, 110, 175);;
        text-align: center;
        height: 300px;
        width: 300px;
        top: 100px;
        margin: auto;
        }
    </style>
</head>
<body>
    <div class="wrapper" align="center">
        <?php include_once("template_header.php")?>
        <div class="box" align="center">
            <div align="center"> <h1>Login</h1></div>
            <form method="POST" action="">
                <input name="username" type="username" placeholder="Username">
                <br>
                <input name="password" type="password" placeholder="Password">
                <br>
                <button value="OK" name="login" type="login" >Login</button>
                <br>
            </form>
            <br><img align="center" id="logo" src="https://cdn0.iconfinder.com/data/icons/veterinary-line-1/48/26-512.png" alt="puppy">
        </div>
    </div>
</body>
</html>