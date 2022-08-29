<?php
	session_start();
	include_once('connection.php');

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$address = $_POST['address'];
		$user_type=$_POST['user_type'];
		$email = $_POST['email'];
		$mobile = $_POST['mobile'];
		$sql = "UPDATE users SET username = '$username', password = '$password', address = '$address', user_type = '$user_type' , email = '$email', mobile = '$mobile'WHERE id = '$id'";

		//use for MySQLi OOP
		if($conn->query($sql)){
			$_SESSION['success_message'] = 'Member updated successfully';
		}


		else{
			$_SESSION['error'] = 'Something went wrong in updating member';
		}
	}
	else{
		$_SESSION['error'] = 'Select member to edit first';
	}

	header('location: ../users.php');

?>
