<div id="invite_user_modal" class="modal-dialog">
  <div class="modal-content">
	  <form id="invite_user_form" onsubmit="return Portal.User.invite();" action="" method="post" role="form">
	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal">&times;</button>
	      <h4 class="modal-title text-info m-l-xs">Invite New Manager</h4>
	    </div>
	    <div class="modal-body">
		  	<section id="user_found" class="panel clearfix bg-light dker m-t-md" style="display:none;">
				<div class="panel-body">
					<a class="thumb pull-left m-r" href="#">
						<img id="invite_avatar" class="img-circle b-a b-3x b-white" src="<?php echo base_url();?>assets/images/avatar.png">
					</a>
					<div class="clear">
						<a class="text-info" href="#">Mark A.</a>
						<div><small id="com_name"></small></a>
					</div>
				</div>
			</section>
	        <div class="form-group">
	          <label class="font-bold">Email Address</label>
	          <input type="email" onblur="Portal.User.findEmail(this);" name="email" placeholder="Enter Manager's Email Address" class="form-control" required>
	        </div>
	        <div class="form-group">
	          <label class="font-bold">Full Name</label>
	          <input type="text" id="fullname" name="fullname" placeholder="Enter Manager's Full Name" class="form-control" required>
	        </div>
	    </div>
	    <div class="modal-footer ">
	      <a href="#" class="btn btn-danger pull-left" data-dismiss="modal">Close</a>
	      <input type="submit" name="submit" class="btn btn-info pull-right" value="Send Invitation" />
	      <span class="ajax_msg m-t-sm m-r-sm pull-right" style="display:none;"></span>
	    </div>
    </form>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->