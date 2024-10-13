<?php
$title = 'successful Password Reset';
require 'includes/header.php';
include 'includes/dbh.inc.php';
if(!$_SESSION['is_ok']){
  $_SESSION['danger_message'] = "You can't access this page";
  header('location: home.php');
  die();
}
?>

<div class="tracking-content">
    <img class="tracking-icon" src="images/pay-successed.png" />
    <div class="tracking-title">Your password has been reset Successfully</div>
    <div class="tracking-description">Redirecting. Please wait....</div>
    <br>
    <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
      <span class="visually-hidden"></span>
    </div>
</div>
<?php
//reset session
$_SESSION = [];
//success message here
$_SESSION['success_message'] = "You can login with your new credentials now";
header( "Refresh:3; url=login.php", true, 303);
