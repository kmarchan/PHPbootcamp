<?php
	$link = include "storescripts/connect_to_mysql.php";
	$dynamicList="";
	$sql = mysqli_query($link,"SELECT * FROM products ORDER BY date_added DESC LIMIT 6");
	$productCount = mysqli_num_rows($sql); 
	if ($productCount > 0)
	{
		while ($row = mysqli_fetch_array($sql))
		{
			$id = $row["id"];
			$product_name = $row["product_name"];
			$price = $row["price"];
			$date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
			$dynamicList .= '<table width="100%" border="0" cellspacing="0" cellpadding="6">
			<tr>
				<td width="20%">
					<a href ="product.php?id=' . $id . '"><img id="prod" style="border: grey 1px solid;" src="inventory_images/' . $id . '.jpg" alt=' . $product_name . '>
				</td>
				<td width="80%" valign="top">
					<br>
					<br>
					<br>
					' . $product_name . '</br>
					R' . $price . '</br>
					<a href="product.php?id=' . $id . '">Product Details</a>
				</td>
			</tr>
		</table>';
		}
	}
	else
		$dynamicList = "We have no products listed in our store yet";
	mysqli_close($link);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Store Home Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style/main.css" />
</head>
<body>
	<?php include_once("template_header.php")?> 
	<div id = "wrapper" align="center">
		<div id="pageContent">
		<table width="100%" border="0">
			<tr>
				<td width="25%" valign="top">
					<p><h2>Welcome to Pic-a-Pup</h2><br><h3>we are dedicated to bring bring you the most lovely photos of dogs. The profit from selling these photos will go to our parter dog welfare organisations</h3></p>
					<br>
					<img width="100px" src="./download.png" alt="paw"><img width="100px" src="./download.png" alt="paw">
				</td>
				<td width="50%" valign="top">
					<p><?php echo $dynamicList; ?></p>
				</td>
				<td width="25%" valign="top">
					<p><a href="https://www.gooddoginabox.com/lite-dog-training-subscription/ref/Maryland+Dog/"><img height="700px"src="./good-dog-300x600-animated.png" alt=" Good dog"> </a><p>
				</td>
			</tr>
		</table>
		</div>
		<?php include_once("template_footer.php")?> 
		</div>
</body>
</html>