<?php
	$conn = new mysqli('localhost', 'root', '', 'sparepart');
	if($conn->connect_error){
	   die("Connection failed: " . $conn->connect_error);
	}
