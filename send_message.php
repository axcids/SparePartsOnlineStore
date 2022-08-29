<?php
$title = 'Send Message';
require 'includes/header.php';
require 'includes/dbh.inc.php';
if ($_SESSION['username'] == NULL) {
    $_SESSION['danger_message'] = "You can't access this page";
    header("location:home.php");
}
if(isset($_SESSION['user_id'])){
  $user_id = $_SESSION['user_id'];
  $username = $_SESSION['username'];
  $fetchUser = $conn->query("select * from users where id = '$user_id' limit 1")->fetch_assoc();
  $email = $fetchUser['email'];
}else{
  $username = 'Visitor';
  $email = 'Visitor';
}
?>
<div class="container">
  <div class="content-wrapper">
    <div class="container">
      <div class="row d-flex align-items-stretch no-gutters">
        <div class="col-md-12 p-4 p-md-5 order-md-last bg-light">
          <form class="form-message" action="#" method="post" style="width: 70%;">
            <div class="pb-1">
              <h4 style="font-weight: bold;">Send Message:</h4>
            </div>
            <div class="form-group">
              <input name="title" type="text" class="form-control" placeholder="Title">
            </div>
            <div class="form-group">
              <textarea name="content" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
            </div>
            <div class="form-group">
              <input name="submit" type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
            </div>
          </form>
        </div>
        <div class="col-md-6 d-flex align-items-stretch">
        </div>
      </div>
    </div>
  </div>
</div>
<?php
require 'includes/footer.php';
if(isset($_POST['submit'])){
  $sender = $_SESSION['username'];
  $receiver = 'admin';
  $title = $_POST['title'];
  $content = $_POST['content'];
  $conn->query("INSERT INTO `messages` (`sender`, `receiver`, `email`, `title`, `content`, `status`) VALUES ('$sender', '$receiver', '$email', '$title', '$content', 'Not answered')");
  $_SESSION['success_message'] = "Message Sent!";
  header('location: inbox.php');
}
