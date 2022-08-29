<?php
$title = 'Register';
require 'includes/header.php';
include 'includes/dbh.inc.php';
include 'includes/server.php';
if ($_SESSION['username'] == NULL) {
    $_SESSION['danger_message'] = "You can't access this page";
    die(header("location:home.php"));
}
?>

<div class="tracking-content">
    <img class="tracking-icon" src="images/pay-successed.png" />
    <div class="tracking-title">Registration Completed Successfully</div>
    <div class="tracking-description">Redirecting. Please wait....</div>
    <br>
    <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
      <span class="visually-hidden"></span>
    </div>
</div>
<?php
$_SESSION['success_message'] = "Welcome, ".$_SESSION['username'];
header( "Refresh:3; url=home.php", true, 303);
