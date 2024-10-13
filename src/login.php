<?php
$title = 'Login';
require 'includes/header.php';
include 'includes/dbh.inc.php';
if(isset($_GET['id']) && $_GET['id'] == 0){
		$_SESSION['warning_message'] = "You have to login first to make an order!";
}
include 'includes/alerts.php';
$msg = "";
if (isset($_POST['login'])) {
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$sql = "SELECT * FROM users WHERE username=? AND password=?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ss", $username, $password);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
	if ($result->num_rows > 0) {
		$_SESSION['user_id'] = $row['id'];
		$_SESSION['username'] = $row['username'];
		$_SESSION['user_type'] = $row['user_type'];
		$_SESSION['success_message'] = "Welcome. ".$_SESSION['username'];
		header("location:home.php");
	} else {
		$msg = "Username or Password is Incorrect";
	}
}
?>
<div class="ftco-animate">
	<div class="container-fluid p-5">
		<form action="#" method="post" class="form-signin" data-ember-action="2">
			<h2 class="form-signin-heading">Login</h2>
			<p class="text-muted">Use the form to login to your account.</p>
			<br>
			<br>
			<h5 class="text-danger text-center pb-5"><?php echo $msg; ?></h5>
			<input name="username" class="ember-view ember-text-field form-control login-input" placeholder="username" type="username">
			<br>
			<input name="password" class="ember-view ember-text-field form-control login-input-pass" placeholder="Password" type="password">
			<br>
			<button name="login" class="btn btn-lg btn-primary btn-block btn-center" type="submit" data-bindattr-3="3">Sign in</button>
			<br>
			<p class="text-muted">◦ Forgot your password? ☛ <a href="reset.php">Reset Password</a> </p>
			<p class="text-muted">◦ Dont have an account? ☛ <a href="register.php"> Sign Up </a> </p>
		</form>
	</div>
</div>
<br>
<br>
<?php
require 'includes/footer.php';
