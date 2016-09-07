
<div class="modal-dialog">
  <div class="modal-content">
	  <form id="submit_ban_user" action="" method="post" role="form">
	    <div class="modal-header">
	      	<button type="button" class="close" data-dismiss="modal">&times;</button>
	    	<h4 class="modal-title text-success">Admin Ban Rason</h4>
	    </div>

	    <div class="modal-body">
	    	<?php
	    	echo validation_errors(); 
	        if(isset($user_id) && !empty($user_id)){
	        	//var_dump($quote);
	        	?>
				
				<table class="table table-striped">
					<tr>
						<td>
							<input type="hidden" name="user_id" value="<?php echo  $user_id; ?>" />
							<textarea name="ban_reason" rows="3" cols="50" class="form-control pull-left" style="display:inline-block; width:auto; margin-right:10px;" /></textarea>
							<input type="submit" class="btn btn-primary pull-left" value="Submit" />
						</td>
					</tr>
				</table>
				
	        	<?php
	        }
	        else{
	        	echo 'Quote not found!';
	        }
	        ?>
	    </div>
	    <div class="modal-footer">
	    </div>
    </form>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

