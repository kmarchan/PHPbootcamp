<?php 
  session_start();
  if (!isset($_SESSION["manager"])) {
	  header("location: admin_login.php"); 
	  exit();
  }
  $managerID = preg_replace('#[^0-9]#i', '', $_SESSION["id"]); 
  $manager = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["manager"]); 
  $password = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["password"]); 

  $link = include "../storescripts/connect_to_mysql.php"; 
  $sql = mysqli_query($link, "SELECT * FROM admin WHERE id='$managerID' AND username='$manager' AND password='$password' LIMIT 1"); // query the person
  $existCount = mysqli_num_rows($sql); 
  if ($existCount == 0) 
  { 
	echo "Your login session data is not on record in the database.";
	exit();
  }
?>

<?php 
  if (isset($_POST['product_name']))
  {
	$pid = mysqli_real_escape_string($link, $_POST['thisID']);
	$product_name = mysqli_real_escape_string($link, $_POST['product_name']);
	$price = mysqli_real_escape_string($link, $_POST['price']);
	$category = mysqli_real_escape_string($link, $_POST['category']);
	$subcategory = mysqli_real_escape_string($link, $_POST['subcategory']);
	$details = mysqli_real_escape_string($link, $_POST['details']);
	$sql = mysqli_query($link, "UPDATE products SET product_name='$product_name', price='$price', details='$details', category='$category', subcategory='$subcategory' WHERE id='$pid'");
	if ($_FILES['fileField']['tmp_name'] != "")
	{
		$newname = "$pid.jpg";
		move_uploaded_file($_FILES['fileField']['tmp_name'], "../inventory_images/$newname");
	}
	header("location: inventory_list.php"); 
	exit();
  }
?>
<?php 
  if (isset($_GET['pid']))
  {
	  $targetID = $_GET['pid'];
	  $sql = mysqli_query($link, "SELECT * FROM products WHERE id='$targetID' LIMIT 1");
	  $productCount = mysqli_num_rows($sql);
	  if ($productCount > 0) {
		while($row = mysqli_fetch_array($sql)){ 

		$product_name = $row["product_name"];
		$price = $row["price"];
		$category = $row["category"];
		$subcategory = $row["subcategory"];
		$details = $row["details"];
		$date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
		  }
	  } else {
		echo "Sorry that item deosn't exist.";
	  exit();
	  }
  }
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Inventory Edit</title>
<link rel="stylesheet" href="../style/main.css" type="text/css" media="screen" />
</head>

<body>
	<?php include_once("../template_header.php");?>
	<div align="center" id="wrapper">
		<div id="pageContent"><br />
		<div align="right" style="margin-right:32px;"><div class="menue"><a href="inventory_list.php#inventoryForm">+ Add New Inventory Item</a></div></div>
		<div align="left" style="margin-left:24px;">
		<h2>Edit Inventory Item</h2>
		</div>
		<hr />
		<a name="inventoryForm" id="inventoryForm"></a>
		<h3>
		&darr; Edit Inventory Item Form &darr;
		</h3>
		<form action="inventory_edit.php" enctype="multipart/form-data" name="myForm" id="myform" method="post">
		<table width="90%" border="0" cellspacing="0" cellpadding="6">
		<tr>
			<td width="20%" align="right">Product Name</td>
			<td width="80%"><label>
			<input name="product_name" type="text" id="product_name" size="64" value="<?php echo $product_name; ?>" />
			</label></td>
		</tr>
		<tr>
			<td align="right">Product Price</td>
			<td><label>
				R
			<input name="price" type="text" id="price" size="12" value="<?php echo $price; ?>" />
			</label></td>
		</tr>
		<tr>
			<td align="right">Category</td>
			<td>
			<select name="category" id="category">
				<option value="<?php echo $category; ?>"><?php echo $category; ?></option>
				<option value="Yorkshire Terrier">Yorkshire Terrier</option>
				<option value="Great Dane">Great Dane</option>
				<option value="Labrador">Labrador</option>
			</select>
			</td>
		</tr>
		<tr>
			<td align="right">Subcategory</td>
			<td>
				<select name="subcategory" id="subcategory">
				<option value="<?php echo $subcategory; ?>"><?php echo $subcategory; ?></option>
				<option value="pupper">Pupper</option>
				<option value="doggo">Doggo</option>
				</select>
			</td>
		</tr>
		<tr>
			<td align="right">Product Details</td>
			<td><label>
			<textarea name="details" id="details" cols="64" rows="5"><?php echo $details; ?></textarea>
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
			<input name="thisID" type="hidden" value="<?php echo $targetID; ?>" />
			<input type="submit" name="button" id="button" value="Make Changes" />
			</label></td>
		</tr>
		</table>
		</form>
		<br />
	<br />
	</div>
	<?php include_once("../template_footer.php");?>
	</div>
</body>
</html>