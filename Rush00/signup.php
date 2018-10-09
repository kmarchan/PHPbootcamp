<?php
    $link = include "storescripts/connect_to_mysql.php";
    print_r($_POST);
    if (($_POST["submit"]))
    {
        session_start();
        $user = mysqli_real_escape_string($link, $_POST["login"]);
        $passwd = mysqli_real_escape_string($link, $_POST["password"]);
        // $query = mysqli_query($link, "SELECT * FROM users WHERE username='".$user."'");
        // print_r($query);
        // $numrows = mysqli_num_rows($query);
        // if ($numrows == 0)
        // {
            $sql = "INSERT INTO users(username, PASSWORD) VALUES('$user', '$passwd')";
            $result = mysqli_query($link, $sql);
            if ($result)
            {
                echo "Account Succesfully created\n";
                $_SESSION['user'] = $user;
                header("location:http://localhost:8080/rush00/index.php");
            }
            else
                echo "Failed to create account\n";
        // }
        // else
        //     echo "That username already exists! Please try again with another";
    }
?>


<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
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
            <div align="center"> <h1>Sign-up</h1></div>
            <form method="POST" action="">
                <input name="login" type="login" placeholder="Username">
                <br>
                <input name="password" type="password" placeholder="Password">
                <br>
                <button value="OK" name="submit" type="submit" >OK</button>
                <br>
            </form>
            <br><img align="center" id="logo" src="https://cdn0.iconfinder.com/data/icons/veterinary-line-1/48/26-512.png" alt="puppy">
        </div>
        <?php include_once("template_footer.php")?>
    </div>
</body>
</html>