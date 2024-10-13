<?php
require 'includes/header.php';
require 'includes/topbar.php';
require 'includes/sidebar.php';
?>
<div class="content-wrapper" style="width: 100%;">
  <div class="content-header">
  <h3>Manage Users</h3>
  <hr>
</div>
<div class="card-body">
  <?php include 'includes/alerts.php'; ?>
    <div class="col-sm-8 col-sm-offset-2">
      <div class="ml-5 mb-3">
        <i class="fa fa-user-plus" aria-hidden="true"></i>
        <a href="#addnew" data-toggle="modal">Add new user</a>
      </div>
      <div class="row">
        <table id="myTable" class="table table-bordered table-striped ml-5 text-center">
					<thead>
						<th>ID</th>
						<th>username</th>
						<th>password</th>
						<th>Address</th>
						<th>user_type</th>
						<th>email</th>
						<th>mobile</th>
						<th >Action</th>
					</thead>
					<tbody>
						<?php
							include_once('includes/database.php');
							$sql = "SELECT * FROM users";

							//use for MySQLi-OOP
							$query = $conn->query($sql);
							while($row = $query->fetch_assoc()){
								echo
								"<tr>
									<td>".$row['id']."</td>
									<td>".$row['username']."</td>
									<td>".$row['password']."</td>
									<td>".$row['address']."</td>
									<td>".$row['user_type']."</td>

									<td>".$row['email']."</td>
									<td>".$row['mobile']."</td>
									<td>
										<a href='#edit_".$row['id']."' class='btn btn-success btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-edit'></span> Update </a>

										<a href='#delete_".$row['id']."' class='btn btn-danger btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-trash'></span> Delete</a>
									</td>
								</tr>";
								include('manage_users/edit_delete_modal.php');
							}

						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php include('manage_users/add_modal.php') ?>

<script src="manage_users/jquery/jquery.min.js"></script>
<script src="manage_users/bootstrap/js/bootstrap.min.js"></script>
<script src="manage_users/datatable/jquery.dataTables.min.js"></script>
<script src="manage_users/datatable/dataTable.bootstrap.min.js"></script>
<!-- generate datatable on our table -->
<script>
$(document).ready(function(){
	//inialize datatable
    $('#myTable').DataTable();

    //hide alert
    $(document).on('click', '.close', function(){
    	$('.alert').hide();
    })
});
</script>
</div>
<?php
require 'includes/footer.php';
