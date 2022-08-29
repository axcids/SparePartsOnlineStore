<?php
$title = 'Reset Password';
require 'includes/header.php';
include 'includes/dbh.inc.php';
if(!isset($_SESSION['reset_email'])){
  $_SESSION['danger_message'] = "You can't access this page";
  header('location: reset.php');
}
$msg = "";
$email = $_SESSION['reset_email'];
$question = $conn->query("select sec_question from users where email = '$email'")->fetch_assoc();
if (isset($_POST['check'])) {
	$answer = mysqli_real_escape_string($conn, $_POST['answer']);
	$sql = "SELECT sec_answer FROM users WHERE email=?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s", $email);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
	if ($row['sec_answer'] == $_POST['answer']) {
		$_SESSION['is_ok'] = true;
		header("location:change_password.php");
	} else {
		$msg = "Incorrect Answer!";
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
      <label class="form-control"><?php echo $question['sec_question'] ?></label>
			<input name="answer" class="ember-view ember-text-field form-control login-input" placeholder="Answer" type="text">
			<br>
			<button name="check" class="btn btn-lg btn-primary btn-block btn-center" type="submit" data-bindattr-3="3">Next</button>
			<br>
		</form>
	</div>
</div>
<br>
<?php
require 'includes/footer.php';
