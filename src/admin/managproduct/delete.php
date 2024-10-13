<?php
	session_start();
	include_once('database.php');

	if(isset($_GET['id'])){
		$sql = "DELETE FROM products WHERE id = '".$_GET['id']."'";

		//use for MySQLi OOP
		if($conn->query($sql)){
			$_SESSION['success_message'] = 'product deleted successfully';
		}
		////////////////

		//use for MySQLi Procedural
		// if(mysqli_query($conn, $sql)){
		// 	$_SESSION['success'] = 'Member deleted successfully';
		// }
		/////////////////

		else{
			$_SESSION['error'] = 'Something went wrong in deleting product';
		}
	}
	else{
		$_SESSION['error'] = 'Select product to delete first';
	}

	header('location: ../products.php');
?>
