<?php
$server="mysql:host=localhost;dbname=np03cs4a240186";
$username="np03cs4a240186";
$password="WbOm5u1YNf";

try{
	$conn = new PDO($server, $username, $password);
	$sql = "CREATE TABLE IF NOT EXISTS products (
	 		id INT AUTO_INCREMENT PRIMARY KEY,
  			product_name VARCHAR(100) NOT NULL,
  			supplier_name VARCHAR(100) NOT NULL,
  			item_description TEXT NOT NULL,
  			added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
  			)";
	$conn->exec($sql);
}catch(PDOException $e) {
  echo $e->getMessage();
}