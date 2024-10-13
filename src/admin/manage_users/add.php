<?php
	session_start();
	include_once('connection.php');

	if(isset($_POST['add'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$address = $_POST['address'];
		$user_type = $_POST['user_type'];
		$sec_question = $_POST['sec_question'];
		$sec_answer = $_POST['sec_answer'];
		$email = $_POST['email'];
		$mobile= $_POST['mobile'];
		$sql = "INSERT INTO users (username, password, address,user_type, sec_question, sec_answer, email,mobile) VALUES ('$username', '$password', '$address','$user_type', '$sec_question', '$sec_answer', '$email','$mobile')";
		$conn->query($sql);
		$_SESSION['success_message'] = 'Member added successfully';
		//use for MySQLi OOP
		// if()){
		//
		// }
		///////////////

		//use for MySQLi Procedural
		// if(mysqli_query($conn, $sql)){
		// 	$_SESSION['success'] = 'Member added successfully';
		// }
		//////////////
		//
		// else{
		// 	$_SESSION['error'] = 'Something went wrong while adding';
		// }
	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: ../users.php');
?>
