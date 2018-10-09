<?php 
	session_start();

	// error_reporting(E_ALL);
	// ini_set('display_errors', '1');
	require "storescripts/connect_to_mysql.php"; 
?>
<?php 
	if (isset($_POST['pid'])) 
	{
		$pid = $_POST['pid'];
		$wasFound = false;
		$i = 0;
		if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) { 
			$_SESSION["cart_array"] = array(0 => array("item_id" => $pid, "quantity" => 1));
		} else {
			foreach ($_SESSION["cart_array"] as $each_item) { 
				$i++;
				while (list($key, $value) = each($each_item)) {
					if ($key == "item_id" && $value == $pid) {
						array_splice($_SESSION["cart_array"], $i-1, 1, array(array("item_id" => $pid, "quantity" => $each_item['quantity'] + 1)));
						$wasFound = true;
					}
				}
			}
			if ($wasFound == false) {
				array_push($_SESSION["cart_array"], array("item_id" => $pid, "quantity" => 1));
			}
		}
		header("location: cart.php"); 
		exit();
	}
?>

<?php 
	if (isset($_GET['cmd']) && $_GET['cmd'] == "emptycart")
		unset($_SESSION["cart_array"]);
?>

<?php 
	if (isset($_POST['item_to_adjust']) && $_POST['item_to_adjust'] != "")
	{
		$item_to_adjust = $_POST['item_to_adjust'];
		$quantity = $_POST['quantity'];
		$quantity = preg_replace('#[^0-9]#i', '', $quantity);
		if ($quantity >= 100) { $quantity = 99; }
		if ($quantity < 1) { $quantity = 1; }
		if ($quantity == "") { $quantity = 1; }
		$i = 0;
		foreach ($_SESSION["cart_array"] as $each_item) { 
				$i++;
				while (list($key, $value) = each($each_item)) {
					if ($key == "item_id" && $value == $item_to_adjust) {
						array_splice($_SESSION["cart_array"], $i-1, 1, array(array("item_id" => $item_to_adjust, "quantity" => $quantity)));
					}
				}
		}
	}
?>

<?php 
	if (isset($_POST['index_to_remove']) && $_POST['index_to_remove'] != "")
	{
		$key_to_remove = $_POST['index_to_remove'];
		if (count($_SESSION["cart_array"]) <= 1) {
			unset($_SESSION["cart_array"]);
		} else {
			unset($_SESSION["cart_array"]["$key_to_remove"]);
			sort($_SESSION["cart_array"]);
		}
	}
?>
<?php 
	$cartOutput = "";
	$cartTotal = "";
	$pp_checkout_btn = '';
	$product_id_array = '';
	if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1)
		$cartOutput = "<h2 align='center'>Your shopping cart is empty</h2>";
	else 
	{
		$i = 0; 
		foreach ($_SESSION["cart_array"] as $each_item) { 
			$item_id = $each_item['item_id'];
			$sql = mysqli_query($link, "SELECT * FROM products WHERE id='$item_id' LIMIT 1");
			while ($row = mysqlI_fetch_array($sql)) {
				$product_name = $row["product_name"];
				$price = $row["price"];
				$details = $row["details"];
			}
			$pricetotal = $price * $each_item['quantity'];
			$cartTotal = $pricetotal + $cartTotal;
			setlocale(LC_MONETARY, "en_ZA");
			$pricetotal = money_format("%10.2n", $pricetotal);
			$x = $i + 1;
			$pp_checkout_btn .= '<input type="hidden" name="item_name_' . $x . '" value="' . $product_name . '">
			<input type="hidden" name="amount_' . $x . '" value="' . $price . '">
			<input type="hidden" name="quantity_' . $x . '" value="' . $each_item['quantity'] . '">  ';
			$product_id_array .= "$item_id-".$each_item['quantity'].","; 
			$cartOutput .= "<tr>";
			$cartOutput .= '<td><a href="product.php?id=' . $item_id . '">' . $product_name . '</a><br /><img src="inventory_images/' . $item_id . '.jpg" alt="' . $product_name. '" width="40" height="52" border="1" /></td>';
			$cartOutput .= '<td>' . $details . '</td>';
			$cartOutput .= '<td>R' . $price . '</td>';
			$cartOutput .= '<td><form action="cart.php" method="post">
			<input name="quantity" type="text" value="' . $each_item['quantity'] . '" size="1" maxlength="2" />
			<input name="adjustBtn' . $item_id . '" type="submit" value="change" />
			<input name="item_to_adjust" type="hidden" value="' . $item_id . '" />
			</form></td>';
			$cartOutput .= '<td>R' . $pricetotal . '</td>';
			$cartOutput .= '<td><form action="cart.php" method="post"><input name="deleteBtn' . $item_id . '" type="submit" value="X" /><input name="index_to_remove" type="hidden" value="' . $i . '" /></form></td>';
			$cartOutput .= '</tr>';
			$i++; 
		} 
		setlocale(LC_MONETARY, "en_ZA");
		$cartTotal = money_format("%10.2n", $cartTotal);
		$cartTotal = "<div style='font-size:18px; margin-top:12px;' align='right'>Cart Total : R".$cartTotal."</div>";
		// Finish the Paypal Checkout Btn
	}
?>

<?php
	if(!isset($_SESSION['user'])) 
		$link = "http://localhost:8080/rush00/login.php";
	else
		$link = "http://localhost:8080/rush00/storescripts/paypalipn.php";
	$ret = "<a href= $link>Checkout</a>";
?>

<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Your Cart</title>
	<link rel="stylesheet" href="style/main.css" type="text/css" media="screen" />
	</head>
	<body>
		<?php include_once("template_header.php");?>
		<div align="center" id="wrapper">
			<div id="pageContent">
				<div style="margin:24px; text-align:left;">
					<br />
					<table width="100%" border="1" cellspacing="0" cellpadding="6">
						<tr>
							<td width="18%" bgcolor="#605A66"><strong>Product</strong></td>
							<td width="45%" bgcolor="#605A66"><strong>Product Description</strong></td>
							<td width="10%" bgcolor="#605A66"><strong>Unit Price</strong></td>
							<td width="9%" bgcolor="#605A66"><strong>Quantity</strong></td>
							<td width="9%" bgcolor="#605A66"><strong>Total</strong></td>
							<td width="9%" bgcolor="#605A66"><strong>Remove</strong></td>
						</tr>
						<?php echo $cartOutput; ?>
					</table>
					<?php echo $cartTotal; ?>
					<div class="menue" align="right">
						<?php echo $ret;?>
					</div>
					<br />
					<br />
					<br />
					<br />
					<div>
					<a href="cart.php?cmd=emptycart">Click Here to Empty Your Shopping Cart</a>
					</div>
				</div>
				<br />
			</div>
			<?php include_once("template_footer.php");?>
		</div>
	</body>
</html>