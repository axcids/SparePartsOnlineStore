<?php
session_start();
if((isset($_SESSION['user_id']))){
  $_SESSION = [];
  $_SESSION['success_message'] = 'You have been logged out';
  header('location:home.php');
  exit();
}
