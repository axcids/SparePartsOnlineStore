<?php
$title = 'Change Password';
require 'includes/header.php';
if(!$_SESSION['is_ok']){
  $_SESSION['danger_message'] = "You can't access this page";
  header('location: reset.php');
}
$db = mysqli_connect('localhost', 'root', '', 'sparepart');

$msg = "";
$password_1 = "";
$password_2 = "";
$errors = array();
$email = $_SESSION['reset_email'];
if (isset($_POST['reset'])){
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if (empty($password_2)) { array_push($errors, "Password Confirmation is required"); }
  $number = preg_match('@[0-9]@', $password_1);
  $number_2 = preg_match('@[0-9]@', $password_2);
  $uppercase = preg_match('@[A-Z]@', $password_1);
  $uppercase_2 = preg_match('@[A-Z]@', $password_2);
  $lowercase = preg_match('@[a-z]@', $password_1);
  $lowercase_2 = preg_match('@[a-z]@', $password_2);
  $specialChars = preg_match('@[^\w]@', $password_1);
  $specialChars_2 = preg_match('@[^\w]@', $password_2);

  if(!empty($password_1) && !empty($password_2)){
      if(strlen($password_1) <= 8 || strlen($password_2) <= 8){
       array_push($errors, "Password must be at least 8 characters.");
     }elseif(!$number || !$number_2){
       array_push($errors, "Password must contain at least one number.");
     }elseif(!$uppercase || !$uppercase_2){
       array_push($errors, "Password must contain at least one upper case letter.");
    }elseif(!$lowercase || !$lowercase_2){
      array_push($errors, "Password must contain at least one lower case letter.");
    }elseif(!$specialChars || !$specialChars_2){
      array_push($errors, "Password must contain at least one special character.");
    }
  }
  if (count($errors) == 0) {
  	$password = ($password_1);

  	$query = "UPDATE `users` SET `password`= '$password' WHERE email = '$email'";
  	mysqli_query($db, $query);
    $_SESSION['is_ok'] = true;
  	header('location: successful_reset.php');
  }
}
?>
<div class="ftco-animate">
	<div class="container-fluid p-5">
		<form action="#" method="post" class="form-signin" data-ember-action="2">
			<h2 class="form-signin-heading">Change Password</h2>
			<p class="text-muted">Use the form to Change your account's password.</p>
			<br>
      <?php include 'includes/errors.php'; ?>
			<br>
			<h5 class="text-danger text-center pb-5"><?php echo $msg; ?></h5>
			<input name="password_1" class="ember-view ember-text-field form-control login-input" placeholder="New Password" type="password" value="<?php echo $password_1 ?>">
      <br>
      <input name="password_2" class="ember-view ember-text-field form-control login-input" placeholder="Password Confirmation" type="password" value="<?php echo $password_2 ?>">
			<br>
			<button name="reset" class="btn btn-lg btn-primary btn-block btn-center" type="submit" data-bindattr-3="3">Reset</button>
			<br>
		</form>
	</div>
</div>
<br>
<?php
require 'includes/footer.php';
