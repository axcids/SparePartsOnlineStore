<?php
require 'includes/header.php';
require 'includes/topbar.php';
require 'includes/sidebar.php';
$username = $_SESSION['username'];
?>
<div class="content-wrapper" style="width: 100%;">
  <div class="content-header">
  <h3>Manage Products</h3>
  <hr>
</div>
<div class="card-body">
  <?php include 'includes/alerts.php'; ?>
    <div class="col-sm-8 col-sm-offset-2">
      <div class="ml-5 mb-3">
        <i class="fa fa-user-plus" aria-hidden="true"></i>
        <a href="add_product.php">Add new product</a>
      </div>
      <div class="row">
        <table id="myTable" class="table table-bordered table-striped ml-5 text-center">
					<thead>
						<th>ID</th>
						<th>Product Name</th>
						<th>Product Quantity</th>
						<th>Product Image</th>
						<th>Category Name</th>
						<th>Product Price</th>
						<th>Product Status</th>
            <?php if($_SESSION['user_type'] == 'admin'){ ?>
              <th>Provider</th>
            <?php } ?>
						<th width="20%">Action</th>
					</thead>
					<tbody>
						<?php
							include_once('includes/database.php');
              if($username == 'admin'){
                $sql = "SELECT * FROM products";
              }else{
                $sql = "SELECT * FROM products where created_by = '$username'";
              }
							//use for MySQLi-OOP
							$query = $conn->query($sql);
							while($row = $query->fetch_assoc()){ ?>
								 <tr>
									<td><?php echo $row['id'] ?></td>
									<td><?php echo $row['product_name']; ?></td>
									<td><?php echo $row['product_qty']; ?></td>
									<td><img src= "<?php echo 'http://127.0.0.1/uploads/'.$row['product_image'] ?>" style="height: 80px;"></td>
									<td><?php echo $row['category_name']; ?></td>
									<td><?php echo $row['product_price']; ?></td>
									<td><?php echo $row['product_status']; ?></td>
                  <?php if($_SESSION['user_type'] == 'admin'){ ?>
                    <td><?php echo $row['created_by']; ?></td>

                  <?php } ?>
									<td>
										<a href='update_product.php?id=<?php echo $row['id'] ?>' class='btn btn-success btn-sm'><span class='glyphicon glyphicon-edit'></span> Update </a>
										<a href='#delete_<?php echo $row['id'] ?>' class='btn btn-danger btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-trash'></span> Delete</a>
                    <?php
                      if($_SESSION['user_type'] == 'admin'){
                        if($row['product_status'] == 'pending'){ ?>
                          <a href="managproduct\approve.php?id=<?php echo $row['id'] ?>" class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-trash'></span> Approve</a>
                        <?php }
                      }
                    ?>
									</td>
								</tr>
                <?php include('managproduct/delete_product_modal.php'); ?>
              <?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php
require 'includes/footer.php';
