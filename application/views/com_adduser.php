<div id="add_user_modal" class="modal-dialog">
  <div class="modal-content">
	  <form id="add_user_form" onsubmit="return Portal.User.addNew();" action="" method="post" role="form">
	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal">&times;</button>
	      <h4 class="modal-title">Add New User</h4>
	    </div>
	    <div class="modal-body">
	        <div class="form-group">
	          <label>Full Name</label>
	          <input type="text" name="fullname" placeholder="Enter Fullname" class="form-control" required>
	        </div>
	        <div class="form-group">
	          <label>Email</label>
	          <input type="email" name="email" placeholder="Enter email" class="form-control" required>
	        </div>
	        <div class="form-group">
	          <label>Password</label>
	          <input type="text" name="password" placeholder="Password" class="form-control" required>
	        </div>
	        <div class="form-group">
	          <label>Phone</label>
	          <input type="text" name="phone" placeholder="(xxx)-xxx-xxxx" class="form-control" required>
	        </div>
	    </div>
	    <div class="modal-footer">
	      <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
	      <input type="submit" name="submit" class="btn btn-primary" value="Save" />
	    </div>
    </form>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->