<?php
require 'includes/header.php';
require 'includes/topbar.php';
require 'includes/sidebar.php';
$username = $_SESSION['username'];
if(!isset($_GET['id'])){

?>
<div class="content-wrapper" style="width: 100%;">
  <div class="content-header">
  <h3>Manage Messages</h3>
  <hr>
</div>
<div class="card-body">
  <?php include 'includes/alerts.php'; ?>
    <div class="col-sm-8 col-sm-offset-2">
      <div class="row">
        <table id="myTable" class="table table-bordered table-striped ml-5 text-center">
					<thead>
						<th>ID</th>
						<th>From</th>
						<th>Email</th>
						<th>Title</th>
						<th>Actions</th>
					</thead>
					<tbody>
						<?php
							include_once('includes/database.php');
                if($_SESSION['user_type'] == 'admin'){
                  $sql = "SELECT * FROM messages";
                }else{
                  $sql = "SELECT * FROM messages where receiver = '$username'";
                }
							//use for MySQLi-OOP
							$query = $conn->query($sql);
							while($row = $query->fetch_assoc()){
                if($row['status'] != 'Answered' && $row['receiver'] == 'admin'){ ?>
								 <tr>
									<td><?php echo $row['id'] ?></td>
									<td>
                    <?php
                      if($row['status'] == 'No answer'){
                        echo "<p>".$row['sender']."<span class='text-danger'>(visitor)</span></p>";
                      }else{
                        echo $row['sender'];
                      }
                    ?>
                  </td>
									<td><?php echo $row['email'] ?></td>
									<td><?php echo $row['title']; ?></td>
									<td style="width: 200px;">
										<a href="?id=<?php echo $row['id'] ?>" class='btn btn-success btn-sm'><span class='glyphicon glyphicon-edit'></span>View</a>
                    <?php if($row['status'] == 'No answer'){ ?>
                      <a href="messages/change_status.php?id=<?php echo $row['id'] ?>" class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-edit'></span>Delete</a>
                    <?php } ?>
									</td>
								</tr>
                <?php } ?>
              <?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php
}else{

?>
<div class="content-wrapper" style="width: 100%;">
  <div class="content-header">
  <h3>View Message</h3>
  <hr>
  </div>
  <div class="card-body">
    <div class="container">
      <?php
      $message_id = $_GET['id'];
      $sql = "SELECT * FROM messages where id = '$message_id' limit 1";
      $query = $conn->query($sql);
      while($row = $query->fetch_assoc()){ ?>
        <form class=""  method="post">
          <div class="card" style="width: 800px">
            <div class="card-body">
              <h3 class="card-title font-weight-bold"><?php echo $row['title'] ?></h3>
              <br>
              <hr>
              <p class="card-text"><?php echo $row['content'] ?></p>
              <?php if($row['status'] == 'Not answered'){ ?>
              <br>
              <hr>
              <h5>Reply: </h5>
              <textarea name="response" rows="8" cols="80"></textarea>
              <br>
              <hr>
            <?php } ?>
              <a href="messages.php" class="btn btn-danger">Close</a>
              <?php if($row['status'] == 'Not answered'){ ?>
              <input name="reply" type="submit" class="btn btn-success" value="Send Message">
              <?php } ?>
            </div>
          </div>
        </form>
      <?php }
        if(isset($_POST['reply'])){
          $conn->query("UPDATE `messages` SET `response` = '".$_POST['response']."', `status` = 'Answered' WHERE `messages`.`id` =".$message_id);
          $_SESSION['success_message'] = "Message sent successfully!";
          echo "<script>window.location='messages.php';</script>";
        }
      ?>
    </div>
  </div>
</div>
<?php }
require 'includes/footer.php';
