<?php
require 'includes/header.php';
require 'includes/topbar.php';
require 'includes/sidebar.php';
$username = $_SESSION['username'];
$userType = $_SESSION['user_type'];
?>
<div class="content-wrapper">
  <div class="content-header">
    <h3>Manage Orders</h3>
    <hr>
    <?php include 'includes/alerts.php'; ?>
  </div>
  <div class="card-body">
    <div class="col-sm-8 col-sm-offset-2">
      <div class="row">
        <table id="myTable" class="table table-bordered table-striped ml-5 text-center">
          <thead>
            <th>ID</th>
            <th>Customer</th>
            <?php if($_SESSION['user_type'] == 'admin'){ ?>
              <th>Provider</th>
            <?php } ?>
            <th>Product</th>
            <th>Manufacture</th>
            <th>Total Price</th>
            <th>Tracking Number</th>
            <th>Status</th>
            <?php
              if($userType == 'provider'){ ?>
                <th>Options</th>
              <?php } ?>
          </thead>
          <tbody>
            <?php
              include_once('includes/database.php');
              if($username == 'admin'){
                $sql = "SELECT tracking.id, users.username, products.created_by, products.product_name, tracking.product_prand, tracking.product_price, tracking.tracking_number, tracking.product_status
                FROM products
                inner join tracking on products.id = tracking.product_id
                inner join users on tracking.user_id = users.id";
              }else{
                $sql = "SELECT tracking.id, users.username, products.created_by, products.product_name, tracking.product_prand, tracking.product_price, tracking.tracking_number, tracking.product_status
                FROM products
                inner join tracking on products.id = tracking.product_id
                inner join users on tracking.user_id = users.id
                where created_by = '$username'";
              }
              //use for MySQLi-OOP
              $query = $conn->query($sql);
              while($row = $query->fetch_assoc()){ ?>
                 <tr>
                  <td><?php echo $row['id'] ?></td>
                  <td><?php echo $row['username']; ?></td>
                  <?php if($_SESSION['user_type'] == 'admin'){ ?>
                    <td><?php echo $row['created_by']; ?></td>
                  <?php } ?>
                  <td><?php echo $row['product_name']; ?></td>
                  <td><?php echo $row['product_prand']; ?></td>
                  <td><?php echo $row['product_price']; ?></td>
                  <td><?php echo $row['tracking_number']; ?></td>
                  <td>
                    <?php
                      if($row['product_status'] == 'false'){
                        echo 'Delievery in progress';
                      } else{
                        echo 'Delivered';
                      }
                    ?>
                  </td>
                  <?php
                      if($userType == 'provider'){ ?>
                        <td>
                          <?php
                          if($row['product_status'] == 'false'){ ?>
                            <form method="post">
                              <button type="submit" name="delivered_<?php echo $row['id'] ?>" class="btn btn-sm btn-success">Delivered</button>
                            </form>
                            <?php } ?>
                        </td>
                      <?php }
                      if(isset($_POST['delivered_'.$row['id']])){
                      $conn->query("UPDATE `tracking` SET `product_status`='true' WHERE id = ".$row['id']);
                      $_SESSION['success_message'] = "Order status has been changed successfully";
                      header('location: orders.php');
                      }
                    } ?>
                </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php
require 'includes/footer.php';
