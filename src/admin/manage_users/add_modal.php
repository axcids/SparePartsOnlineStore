<!-- Add New -->
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <br>
            <center><h4 class="modal-title" id="myModalLabel">Add New User</h4></center>
            <div class="modal-body">
			<div class="container-fluid">
			<form method="POST" action="manage_users/add.php">
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">username:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control ml-2" name="username" required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">password:</label>
					</div>
					<div class="col-sm-10">
						<input type="password" class="form-control ml-2" name="password" required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">Address:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control ml-2" name="address" required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">user_type:</label>
					</div>
					<div class="col-sm-10">
            <select name="user_type" class="form-control  ml-2" aria-label="Default select example">
              <option value="customer">Customer</option>
              <option value="provider">Provider</option>
            </select>
					</div>
				</div>
        <div class="row form-group">
          <div class="col-sm-2">
            <label class="control-label modal-label">Security Question:</label>
          </div>
          <div class="col-sm-10">
            <select name="sec_question" class="form-control" name="">
              <option value="">Select a security question</option>
              <option value="What was your first car?">What was your first car?</option>
              <option value="What city were you born in?">What city were you born in?</option>
              <option value="What was your favorite food as a child">What was your favorite food as a child?</option>
            </select>
          </div>
        </div>
        <div class="row form-group">
          <div class="col-sm-2">
            <label class="control-label modal-label">Security Answer:</label>
          </div>
          <div class="col-sm-10">
            <input type="text" class="form-control ml-2" name="sec_answer" required>
          </div>
        </div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">email:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control ml-2" name="email" required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">mobile:</label>
					</div>
					<div class="col-sm-10">
						<input type="phone" class="form-control ml-2" name="mobile" required>
					</div>
				</div>
            </div>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" name="add" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Save</a>
			</form>
            </div>

        </div>
    </div>
</div>
