<?php
$title = 'Contact Us';
require 'includes/header.php';
require 'includes/dbh.inc.php';
?>

  <!-- CONTACT FORM -->
<div class="ftco-animate">
  <div id="contact_form" class="form-msg">
    <div class="text-center my-5">
      <h1>Have a Question?</h1>
      <p>Our support team are working 24/7, and they are eager to answer all of your questions.<br>Please feel free to contact us at any time you like.</p>
      <p></p>
    </div>
  </div>
</div>
  <?php
  if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    $fetchUser = $conn->query("select * from users where id = '$user_id' limit 1")->fetch_assoc();
  }
  ?>
<div class="ftco-animate">
	<div class="container">
		<div class="row d-flex align-items-stretch no-gutters">
			<div class="col-md-12 mb-5 order-md-last">
				<form class="form-message mb-5" action="#" method="post" style="width: 70%;">
          <?php if(!isset($_SESSION['user_id'])){ ?>
            <div class="form-group">
              <input name="name" type="text" class="form-control" placeholder="Name">
            </div>
            <div class="form-group">
              <input name="email" type="text" class="form-control" placeholder="Email">
            </div>
          <?php } ?>
          <div class="form-group">
            <input name="title" type="text" class="form-control" placeholder="Title">
          </div>
          <div class="form-group">
            <textarea name="content" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
          </div>
          <div class="form-group">
            <input name="send-message" type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
          </div>
        </form>
			</div>
			<div class="col-md-6 d-flex align-items-stretch">
			</div>
		</div>
	</div>
</div>
<br>
</section>
<?php
require 'includes/footer.php';
if(isset($_POST['send-message'])){
  if(isset($_SESSION['user_id'])){
    $sender = $username;
    $email = $fetchUser['email'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $conn->query("INSERT INTO `messages` (`sender`, `receiver`, `email`, `title`, `content`, `status`) VALUES ('$sender', 'admin', '$email', '$title', '$content', 'Not answered')");
    $_SESSION['success_message'] = "Message sent!";
    header('location: inbox.php');
  }else{
    $sender = $_POST['name'];
    $email = $_POST['email'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $conn->query("INSERT INTO `messages` (`sender`, `receiver`, `email`, `title`, `content`, `status`) VALUES ('$sender', 'admin', '$email', '$title', '$content', 'No answer')");
    $_SESSION['success_message'] = "Message sent!";
    header('location: home.php');

  }
}
