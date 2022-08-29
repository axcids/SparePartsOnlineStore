<?php
$title = 'Reset Password';
require 'includes/header.php';
include 'includes/dbh.inc.php';
include 'includes/alerts.php';
$msg = "";
if (isset($_POST['check'])) {
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$sql = "SELECT * FROM users WHERE email=?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s", $email);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
	if ($result->num_rows > 0) {
    $_SESSION['reset_email'] = $email;
		header("location:check.php");
	} else {
		$msg = "Incorrect email!";
	}
}
?>
<div class="ftco-animate">
	<div class="container-fluid p-5">
		<form action="#" method="post" class="form-signin" data-ember-action="2">
			<h2 class="form-signin-heading">Reset Password</h2>
			<p class="text-muted">Use the form to reset your account's password.</p>
			<br>
			<br>
			<h5 class="text-danger text-center pb-5"><?php echo $msg; ?></h5>
			<input name="email" class="ember-view ember-text-field form-control login-input" placeholder="Email" type="email">
			<br>
			<button name="check" class="btn btn-lg btn-primary btn-block btn-center" type="submit" data-bindattr-3="3">Next</button>
			<br>
		</form>
	</div>
</div>
<br>
<?php
require 'includes/footer.php';
