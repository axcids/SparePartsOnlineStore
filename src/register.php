<?php
$title = 'Register';
require 'includes/header.php';
include 'includes/dbh.inc.php';
include 'includes/server.php';

?>
<div class="ftco-animate">
  <div class="container-fluid p-5">
    <form method="post" class="form-signin" data-ember-action="2">
      <h2 class="form-signin-heading">Sign Up</h2>
      <p class="text-muted">Use the form to create an account for you.</p>
      <br>
      <?php include 'includes/errors.php'; ?>
      <br>
      <div class="mb-3 " style="width: 500px;">
        <select name="user_type" class="form-select " aria-label="Default select example">
          <option value="">Open this select menu</option>
          <option <?php if(isset($user_type) && $user_type == 'customer'){echo 'selected';} ?> value="customer">Customer</option>
          <option <?php if(isset($user_type) && $user_type == 'provider'){echo 'selected';} ?> value="provider">Provider</option>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">Username:</label>
        <input type="username" name="username" class="form-control" value="<?php echo $username ?>">

      </div>
      <div class="mb-3">
        <label class="form-label">Email:</label>
        <input type="email" name="email" class="form-control" value="<?php echo $email ?>">

      </div>
      <div class="mb-3">
        <label class="form-label">Password:</label>
        <input type="password" name="password_1" class="form-control">
      </div>
      <div class="mb-3">
        <label class="form-label">Password Confirmation:</label>
        <input type="password" name="password_2" class="form-control">
      </div>
      <div class="mb-3">
        <label for"text">Security Question</label>
        <select name="sec_question" class="form-control" name="">
          <option value="">Select a security question</option>
          <option <?php if(isset($sec_question) && $sec_question == 'What was your first car?'){echo 'selected';} ?> value="What was your first car?">What was your first car?</option>
          <option <?php if(isset($sec_question) && $sec_question == 'What city were you born in?'){echo 'selected';} ?> value="What city were you born in?">What city were you born in?</option>
          <option <?php if(isset($sec_question) && $sec_question == 'What was your favorite food as a child?'){echo 'selected';} ?> value="What was your favorite food as a child">What was your favorite food as a child?</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="">Security Answer</label>
        <input type="text" name="sec_answer" class="form-control">
      </div>
      <div class="mb-3">
        <label class="form-label">Phone Number:</label>
        <input type="phone" name="mobile" class="form-control" value="<?php echo $mobile ?>">

      </div>
      <div class="mb-3">
        <label class="form-label">Address:</label>
        <textarea class="form-control" name="address" row="3"><?php echo $address ?></textarea>

        <small><p>(e.g. Ryiadh, Aqiq)</p></small>
      </div>
      <button name="reg_user" class="btn btn-lg btn-primary btn-block btn-center" type="submit" data-bindattr-3="3">Sign Up</button>
      <br>

      <p class="create-account text-muted">◦ Already registred? ☛ <a href="login.php" class=""> Login </a> </p>
    </form>
  </div>
</div>
<br>

<?php
require 'includes/footer.php';
