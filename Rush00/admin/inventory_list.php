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


<?php 
	if (isset($_GET['deleteid']))
	{
		echo 'Do you really want to delete product with ID of ' . $_GET['deleteid'] . '? <a href="inventory_list.php?yesdelete=' . $_GET['deleteid'] . '">Yes</a> | <a href="inventory_list.php">No</a>';
		exit();
	}
	if (isset($_GET['yesdelete']))
	{
		$id_to_delete = $_GET['yesdelete'];
		$sql = mysqli_query($link, "DELETE FROM products WHERE id='$id_to_delete' LIMIT 1") or die (mysqli_error($link));
		$pictodelete = ("../inventory_images/$id_to_delete.jpg");
		if (file_exists($pictodelete))
			unlink($pictodelete);
		header("location: inventory_list.php"); 
		exit();
	}
?>
<?php
	if (isset($_POST["product_name"]))
	{
		$product_name = mysqli_real_escape_string($link, $_POST["product_name"]);
		$price = mysqli_real_escape_string($link, $_POST["price"]);
		$category = mysqli_real_escape_string($link, $_POST["category"]);
		$subcategory = mysqli_real_escape_string($link, $_POST["subcategory"]);
		$details = mysqli_real_escape_string($link, $_POST["details"]);
		$sql = mysqli_query($link, "SELECT id FROM products WHERE product_name='$product_name' LIMIT 1");
		$productMatch = mysqli_num_rows($sql);
		if ($productMatch > 0)
		{
			echo "You tried to place a duplicate product into the database. <a href='inventory_list.php'>Click here to go back</a>";
			exit();
		}
		$sql = mysqli_query($link, "INSERT INTO products(product_name, price, details, category, subcategory, date_added)
		VALUES('$product_name','$price','$details','$category', '$subcategory',now())") or die (mysqli_error($link));
		$pid = mysqli_insert_id($link);
		$newname = "$pid.jpg";
		move_uploaded_file($_FILES["fileField"]["tmp_name"], "../inventory_images/$newname");
		header("location: inventory_list.php");
		exit(0);
	}
?>
<?php
	$product_list="";
	$sql = mysqli_query($link,"SELECT * FROM products ORDER BY date_added DESC");
	$productCount = mysqli_num_rows($sql); 
	if ($productCount > 0)
	{
		while ($row = mysqli_fetch_array($sql))
		{
			$id = $row["id"];
			$product_name = $row["product_name"];
			$date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
			$product_list .= "$date_added - $id - $product_name &nbsp; &nbsp; &nbsp; <a href='inventory_edit.php?pid=$id'>edit</a> &bull; <a href='inventory_list.php?deleteid=$id'>delete</a><br/>";
		}
	}
	else
	{
		$product_list = "You have no products listed in your store yet";
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="text/html">
		<title>Inventory List</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" media="screen" href="../style/main.css" />
	</head>
	<body>
		<?php include_once("../template_header.php")?> 
		<div id = "wrapper" align="center">
			<!-- <div class="box" align="center"> -->
			<div id="pageContent">
				<div align="right" style="margin-right:24px">
					<br>
					<div class="menue">
					<a href="inventory_list.php#inventoryForm">+ Add New Inventory Item</a>
					</div>
				</div>
				<div align="left" style="margin-left:24px">
					<h2>Inventory List</h2>
					<?php echo $product_list; ?>
				</div>
				<a name="inventoryForm" id="inventoryForm"></a>
				<h3>
					&darr; Add New Inventory Item Form &darr;
				</h3>
				<form action="inventory_list.php" enctype="multipart/form-data" name="myForm" id="myform" method="post">
					<table width="90%" border="0" cellspacing="0" cellpadding="6">
						<tr>
							<td width="20%" align="right">Product Name</td>
							<td width="80%"><label>
							<input name="product_name" type="text" id="product_name" size="64" />
							</label></td>
						</tr>
						<tr>
							<td align="right">Product Price</td>
							<td><label>
							R
							<input name="price" type="text" id="price" size="12" />
							</label></td>
						</tr>
						<tr>
							<td align="right">Category</td>
							<td><label>
							<select name="category" id="category">
							<option value="Yorkshire Terrier">Yorkshire Terrier</option>
							<option value="Great Dane">Great Dane</option>
							<option value="Labrador">Labrador</option>
							</select>
							</label></td>
						</tr>
						<tr>
							<td align="right">Subcategory</td>
							<td><select name="subcategory" id="subcategory">
							<option value=""></option>
							<option value="Pupper">Pupper</option>
							<option value="Doggo">Doggo</option>
							</select></td>
						</tr>
						<tr>
							<td align="right">Product Details</td>
							<td><label>
							<textarea name="details" id="details" cols="64" rows="5"></textarea>
							</label></td>
						</tr>
						<tr>
							<td align="right">Product Image</td>
							<td><label>
							<input type="file" name="fileField" id="fileField" />
							</label></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td><label>
							<input type="submit" name="button" id="button" value="Add Item" />
							</label></td>
						</tr>
					</table>
				</form>
				<br>
			</div>
			<?php include_once("../template_footer.php")?> 
		</div>
		</div>
	</body>
</html>