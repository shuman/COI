<div class="modal-dialog">
  	<div class="modal-content">
	  	<form id="submit_ban_user" action="" method="post" role="form">
		    <div class="modal-header">
		      	<button type="button" class="close" data-dismiss="modal">&times;</button>
		    	<h4 class="modal-title text-success">Admin Note</h4>
		    </div>
		    <div class="modal-body">
				<table class="table table-striped">
					<tr>
						<td>
							<input type="hidden" name="user_id" value="" />
							<textarea name="ban_reason" rows="3" cols="60" class="form-control pull-left block" style="display:inline-block; width:auto; margin-right:10px;" /></textarea>
							<input type="submit" onclick="Admin.jobCompletePopup('');" class="btn btn-primary inline m-t-sm" value="Mark As Done" />
						</td>
					</tr>
				</table>
		    </div>
		    <div class="modal-footer">
		    </div>
    	</form>
  	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->