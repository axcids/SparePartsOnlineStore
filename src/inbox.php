<?php
$title = 'Contact Us';
require 'includes/header.php';
require 'includes/dbh.inc.php';
include 'includes/alerts.php';
if(!isset($_GET['id'])){
  if ($_SESSION['username'] == NULL) {
      $_SESSION['danger_message'] = "You can't access this page";
      header("location:home.php");
  }
?>
<div class="container" style="width: 100%; min-height: 750px;">
  <div class="content-wrapper">
    <div class="mt-5 p-2">
      <a href="send_message.php"> + New Message</a>
    </div>
    <table class="table table-bordered table-striped mt-0 text-center">
      <thead>
        <th>#</th>
        <th>From</th>
        <th>Title</th>
        <th>Status</th>
        <th>Actions</th>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM messages ORDER BY id DESC";
        //use for MySQLi-OOP
        $query = $conn->query($sql);
        $i = 1;
        while($row = $query->fetch_assoc()){
          if($row['sender'] == $_SESSION['username']){ ?>
            <tr>
             <td><?php echo $i ?></td>
             <td><?php echo $row['sender']; ?></td>
             <td><?php echo $row['title']; ?></td>
             <td <?php
                if($row['status'] == "Answered"){
                  echo "class='text-success'";
                }
             ?>><?php echo $row['status'] ?></td>
             <td style="width: 200px;">
               <a href="?id=<?php echo $row['id'] ?>" class='btn btn-success btn-sm'><span class='glyphicon glyphicon-edit'></span>View</a>
             </td>
           </tr>
         <?php $i++; }  ?>
       <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<?php
}else{
  if ($_SESSION['username'] == NULL) {
      $_SESSION['danger_message'] = "You can't access this page";
      header("location:home.php");
  }
?>
<div class="container" style="width: 100%; min-height: 750px;">
  <div class="content-wrapper  mt-5 ml-5">
      <?php
      $message_id = $_GET['id'];
      $sql = "SELECT * FROM messages where id = '$message_id' limit 1";
      $query = $conn->query($sql);
      while($row = $query->fetch_assoc()){ ?>
        <div class="card" style="width: 800px">
          <div class="card-body">
            <h3 class="card-title font-weight-bold"><?php echo $row['title'] ?></h3>
            <hr>
            <p class="card-text"><?php echo $row['content'] ?></p>
            <?php
              if($row['status'] == 'Answered'){ ?>
                <br>
                <hr>
                <h5 class="card-title font-weight-bold text-primary">Admin Response</h5>
                <p class="card-text"><?php echo $row['response'] ?></p>
              <?php } ?>
            <a href="inbox.php" class="btn btn-danger">Close</a>
          </div>
        </div>
      <?php } ?>
  </div>
</div>
<?php }
require 'includes/footer.php';
