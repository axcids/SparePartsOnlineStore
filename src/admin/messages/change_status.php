<?php
$id = $_GET['id'];
include 'database.php';
$conn->query("update messages set status = 'Answered' where id = '$id'");
header('location: ../messages.php');
