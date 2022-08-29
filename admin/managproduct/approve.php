	<?php
	$id = $_GET['id'];
	include 'database.php';
	$conn->query("UPDATE `products` SET `product_status` = 'approved' WHERE `id` = $id");
	header('location: ../products.php');
