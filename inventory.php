<?php
include 'inventory_db.php';
$product_name = $supplier_name = $item_description= "";
$product_name_Err = $supplier_name_Err = $item_description_Err = "";
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	if(empty($_POST['productTitle'])){
		$product_name_Err = "Insert product Title";
	}else{
		$product_name=$_POST['productTitle'];
	}
	if(empty($_POST['supplierName'])){
		$supplier_name_Err = "Insert Supplier Name";
	}else{
		$supplier_name=$_POST['supplierName'];
	}
	if(empty($_POST['Description'])){
		$item_description_Err = "Insert Description Name";
	}else{
		$item_description=$_POST['Description'];
	}
	if(!((empty($_POST['productTitle'])) || (empty($_POST['supplierName'])) || (empty($_POST['Description'])))){
	$sql = "INSERT INTO products (product_name, supplier_name, item_description) VALUES (?,?,?)";
	$stmt = $conn->prepare($sql);
	$stmt->bindvalue(1,$product_name);
	$stmt->bindvalue(2,$supplier_name);
	$stmt->bindvalue(3,$item_description);
	$stmt->execute();
	}
}

$sql="SELECT * FROM products ORDER BY id DESC";
$data = $conn->query($sql);
$data=$data->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Warehouse Stock Entry</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
<header></header>
<main class="container">
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<label>Product Title:</label>
		<input type="text" name="productTitle"><br><br>
		<span class="error"> <?php echo $product_name_Err;?></span><br><br>
		<label>Supplier Name:</label>
		<input type="text" name="supplierName"><br><br>
		<span class="error"> <?php echo $supplier_name_Err;?></span><br><br>
		<label>Detailed Description:</label>
		<textarea name="Description"></textarea><br><br>
		<span class="error"> <?php echo $item_description_Err;?></span><br><br>
		<input type="submit" name="submit" value="Add to Inventory">
	</form>
	<table>
		<tr>
			<th>id</th>
			<th>Product Name</th>
			<th>Supplier Name</th>
			<th>Description</th>
			<th>added_at</th>
		</tr>
			<?php
			foreach ($data as $row) {
				echo"
				<tr>
				<td>{$row['id']}</td>
				<td>{$row['product_name']}</td>
				<td>{$row['supplier_name']}</td>
				<td>{$row['item_description']}</td>
				<td>{$row['added_at']}</td>
				</tr>
				";
			}
			?>
	</table>
</main>
<footer></footer>
</body>
</html>