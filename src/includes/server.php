<?php
// initializing variables
$username = "";
$email = "";
$user_type = "";
$password_1 = "";
$password_2 = "";
$sec_question = "";
$sec_answer = "";
$mobile = "";
$address = "";
$companyName = "";
$companyCity = "";
$companyCountry = "";
$errors = array();

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'sparepart');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  //أضيف رقم الجوال
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $sec_question = mysqli_real_escape_string($db, $_POST['sec_question']);
  $sec_answer = mysqli_real_escape_string($db, $_POST['sec_answer']);
  $user_type = mysqli_real_escape_string($db, $_POST['user_type']);
  $mobile = mysqli_real_escape_string($db, $_POST['mobile']);
  $address = mysqli_real_escape_string($db, $_POST['address']);
  // form validation: ensure that the form is correctly filled ...

  if($user_type == 'Open this select menu'){ array_push($errors, "User type is required");}
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if (empty($password_2)) { array_push($errors, "Password Confirmation is required"); }
  if (empty($sec_question)) { array_push($errors, "Security Question is required"); }
  if (empty($sec_answer)) { array_push($errors, "Security Answer is required"); }
  if ($user_type == 'admin') { array_push($errors, "invalid user type");}

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
  // check the database to make sure
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  //  register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = ($password_1);

  	$query = "INSERT INTO users (username, email, password, user_type, mobile, address, sec_question, sec_answer)
  			  VALUES('$username', '$email', '$password', '$user_type', '$mobile', '$address', '$sec_question', '$sec_answer')";
  	mysqli_query($db, $query);
    $_SESSION['user_id'] = $db->insert_id;
    $_SESSION['username'] = $username;
    $_SESSION['user_type'] = $user_type;

    header('location: successful_registration.php');

  }
}
