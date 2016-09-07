<div class="modal-over">
	<div class="modal-center animated fadeInUp text-center" style="width:200px;margin:-80px 0 0 -100px;">
		<div class="thumb-md"><img src="<?php echo avatar();?>" class="img-circle b-a b-light b-3x"></div>
		<p class="text-white h4 m-t m-b"><?php echo (isset($user_ref->name))? $user_ref->name : '';?></p>
		<div class="input-group">
			<form id="lockform" name="login" method="post" action="<?php echo site_url('/auth/login/');?>">
				<input type="hidden" name="login" value="<?php echo (isset($user_ref->email)) ? $user_ref->email : '';?>">
				<input type="password" name="password" class="form-control text-sm btn-rounded" placeholder="Password To Continue">
				<span class="input-group-btn" style="position:absolute; z-index:9; right:2px;">
					<button id="unlock" class="btn btn-info btn-rounded" type="submit"><i class="fa fa-arrow-right"></i></button>
				</span>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	var ref_url = "<?php echo site_url('/auth/login/');?>?ref=" + encodeURIComponent(document.URL);
	$("#lockform").attr("action", ref_url);
</script>