<div class="modal-dialog">
  <div class="modal-content">
	  <form action="" method="post" role="form">
	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal">&times;</button>
	      <h4 class="modal-title text-success">User Update</h4>
	    </div>
	    <div class="modal-body">

	        <?php
	        if(isset($success) || isset($create)){
	        	
		        // var_dump($user_data);
		        ?>

		    	<table class="table table-striped m-b-none">
					<thead>
						<tr>
							<th colspan="2"> <?php echo (!empty($success) ? "User Data Update For Id: &nbsp;": (!empty($create) ? "Create New User ID:&nbsp;":''));?> <?php echo $user_id; ?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><i class="fa fa-check-circle"></i> <h4><?php echo (!empty($success) ? "Update Data Successfully!!" : (!empty($create) ?  "User Create Successfully!!" : '' )); ?>.</h4></td>
						</tr>
					</tbody>
				</table>
		        <?php
	        }
	        else{
				echo 'Invalid quote ID';
	        }
	        ?>
	    </div>
    </form>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->