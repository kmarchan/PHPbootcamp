<?php
	session_start();
	if(($_SESSION['user'])) 
		$link = "http://localhost:8080/rush00/account.php";
	else
		$link = "http://localhost:8080/rush00/login.php";

	$accountSettings = "<a href= $link>Account Settings</a>";
	if ($_SESSION['user'])
	{
		$menu = "<div class='menue'>
				<a href='http://localhost:8080/rush00/logout.php'>Logout</a>
				</div>";
	}
	else
	{
		$menu = '<div class="menue">
				<a href="http://localhost:8080/rush00/signup.php">Signup</a>
			</div>
			<div class="menue">
				<a href="http://localhost:8080/rush00/login.php">Login</a>
			</div>';
	}
?>

<div id="pageHeader">
	<div align="center"> <h1>Pic<img id="logo" src="https://cdn0.iconfinder.com/data/icons/veterinary-line-1/48/26-512.png" alt="puppy">Pup</h1></div>
	<table width="100%" border="0" cellspacing="0" cellpadding="10">
		<tr>
			<td>
				<div align="left" class="menue">
				<a href="http://localhost:8080/rush00/index.php">Home</a>
				</div>
				<div align="left" class="menue">
				<a href="http://localhost:8080/rush00/admin/index.php">Admin</a>
				</div>
				<div class="menue">
				<?php echo $accountSettings; ?>
				</div>
			</td>
			<td align="right">
			<?php echo $menu;?>
			<td align="right">
				<div class="cart">
						<div class="menue">
							<a href="http://localhost:8080/rush00/cart.php">Cart</a>
						</div>
						<div id="quickview">
							<?php include"cart.php";?>
						</div>
					</div>
				</div>
			</td>
		</tr>
	</table>
</div>