<?php
$title = 'Edit Profile';
require 'includes/header.php';
require 'includes/dbh.inc.php';
if ($_SESSION['username'] == NULL) {
  $_SESSION['danger_message'] = "You can't access this page";
    header("location:home.php");
}

$id = $_SESSION['user_id'];
$user_details = $conn->query("select * from users where id = $id")->fetch_array();

$user_name_error = '';
$password_error = '';
$new_password_error = '';
$mobile_error = '';
$address_error = '';
$email_error = '';

if (isset($_POST['update'])) {

       $username = $_POST['username'];
       $password = $_POST['password'];
       $mobile = $_POST['mobile'];
       $email = $_POST['email'];
       $address = $_POST['address'];

       //username  validation
       $error = 0;
       if (empty($username)) {
              $user_name_error = "Name is required";
              $error++;
       }
       $sql = 'SELECT * FROM users WHERE username="' . $username . '" and id<>' . $id;
       $newidres = mysqli_query($conn, $sql);
       if (mysqli_num_rows($newidres) > 0) {
              $user_name_error .= " Username " . $username . " already exists.!";
              $error++;
       }
       //Password Validation
       if (empty($password)) {
              $password_error = "Password is required";
              $error++;
       } else if($password != $user_details['password']) {
              $password_error = "Password is incorrect";
              $error++;
       }

       //Mobile Validation
       if (empty($mobile)) {
              $mobile_error = "Mobile Number is required";
              $error++;
       } else {
              if (strlen($mobile) != 10) {

                     $mobile_error = "invalid Mobile Number";
                     $error++;
              }
       }

       //email Validation
       if (empty($email)) {
              $email_error = "Email is required";
              $error++;
       }
       $sql = 'SELECT * FROM users WHERE email="' . $email . '" and id<>' . $id;
       $newidres = mysqli_query($conn, $sql);
       if (mysqli_num_rows($newidres) > 0) {
              $email_error .= " Email " . $email . " already exists.!";
              $error++;
       }
       //address Validation
       if (empty($address)) {
              $address_error = "Address is required";
              $error++;
       }


       if ($error == '0') {
              $uq = "update users set username='{$username}',password='{$password}',mobile='{$mobile}',email='{$email}',address='{$address}' where id ='{$id}' ";
              $n =  mysqli_query($conn, $uq) or die(mysqli_error($conn));

              if ($n) {
                     $_SESSION['username'] = $username;
                     echo "<script>alert('Profile  Updated successfully');</script>";
              }
       }
}



?>
<div class="container-fluid m5 p-5">
       <form class="form-update" action="" method="POST">
         <table class="table">
           <h2> Update Profile</h2>
           <tr>
             <th>Name:</th>
             <td>
               <input class="form-control" type="text" name="username" required value="<?php echo $user_details['username'] ?>" required placeholder="Enter Username" />
               <?php echo $user_name_error; ?>
             </td>
           </tr>
           <tr>
             <th>Number:</th>
              <td>
                <input class="form-control" type="text" name="mobile" required value="<?php echo $user_details['mobile'] ?>" required placeholder="Enter Mobile" />
                <?php echo $mobile_error; ?>
              </td>
            </tr>
            <tr>
              <th>Email:</th>
              <td><input class="form-control" type="email" name="email" required value="<?php echo $user_details['email'] ?>" required placeholder="Enter Email" />
                <?php echo $email_error; ?>
              </td>
            </tr>
            <tr>
              <th>Address:</th>
              <td>
                <textarea class="form-control" name="address" required placeholder="Enter Address"><?php echo $user_details['address'] ?></textarea>
                <small class="text-danger"><?php echo $address_error; ?></small>
              </td>
            </tr>
            <tr>
              <th>
              </th>
              <td>

              </td>
            </tr>
          </table>
          <input type="submit" name="update" value="Update Details" class="btn btn-md btn-primary">
          <a href="reset.php" name="reset" class="btn btn-md btn-primary">Reset Password</a>
       </form>
</div>
<?php
require 'includes/footer.php';
