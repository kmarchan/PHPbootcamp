

<?php
	$link = include "storescripts/connect_to_mysql.php";
	if (isset($_GET['id']))
	{
		$id = $_GET['id'];
		$id = preg_replace('#[^0-9]#i','',$_GET['id']);
		$sql = mysqli_query($link, "SELECT * FROM products WHERE id='$id' LIMIT 1");
		mysqli_error($link);
		$productCount = mysqli_num_rows($sql); 
		if ($productCount > 0)
		{
			while ($row = mysqli_fetch_array($sql))
			{
				$id = $row["id"];
				$product_name = $row["product_name"];
				$price = $row["price"];
				$date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
				$details = $row["details"];
				$category = $row["category"];
				$subcategory = $row["subcategory"];
			}
		}
		else
		{
			echo "Item does not exist.";
			exit();
		}
	}
	else
	{
		echo "Data for this page is missing";
		exit();
	}
	mysqli_close($link);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $product_name; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style/main.css" />
	<style>
	</style>
</head>
<body>
		<?php include_once("template_header.php")?> 
	<div id = "wrapper" align="center">
		<div id="pageContent">
		<table width="100%" border="0">
			<tr>
				<td width="20%" valign="top">
					<img id="prod" src="inventory_images/<?php echo $id;?>.jpg" width="200" height="200" alt="<?php echo $product_name; ?>"/>
				</td>
				<td width="80%" valign="top">
					<h3><?php echo $product_name; ?></h3>
					<p>	<?php echo "R".$price; ?> <br/>
						<?php echo "$category $subcategory"; ?> <br/>
						<br/>
						<?php echo $details; ?> <br/>
					</p>
					<form id="form1" name="form1" method="post" action="product.php?id=<?php echo $id;?>">
						<input type="hidden" name="pid" id="pid" value="<?php echo $id;?>"/>
						<input type="submit" name="button" id="button" value="Add to Cart"/>
					</form>
				<br>
			</tr>
		</table>
		</div>
		<?php include_once("template_footer.php")?> 
	</div>
</body>
</html>