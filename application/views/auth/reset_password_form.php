<?php
$new_password = array(
	'name'	=> 'new_password',
	'id'	=> 'new_password',
	'class' => 'form-control no-border',
	'placeholder' => 'New Password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
);
$confirm_new_password = array(
	'name'	=> 'confirm_new_password',
	'id'	=> 'confirm_new_password',
	'class' => 'form-control no-border',
	'placeholder' => 'Confirm New Password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
);
?>
<section id="content" class="m-t-lg wrapper-md animated fadeInDownBig">    
	<div class="container aside-xl">
		<a class="navbar-brand2 block" href="<?php echo site_url('/portal');?>"><img src="<?php echo base_url();?>assets/images/logo.svg" alt="Cut Out Image" /></a>
		<section class="m-b-lg">
			<header class="wrapper text-center">
				<span>Service Portal / Client Area</span>
			</header>
			<?php
			if(isset($errors) && !empty($errors)){
				foreach ($errors as $error) {
					?>
					<div class="alert alert-danger">
	                	<button type="button" class="close" data-dismiss="alert">×</button>
	                	<i class="fa fa-ban-circle"></i><?php echo $error;?>
	                </div>
					<?php
				}
			}
			?>

			<?php echo form_open(current_fullurl()); ?>
				<div class="list-group">
					<div class="list-group-item">
						<?php echo form_password($new_password); ?>
						<?php echo form_error($new_password['name'], '<div class="error">', '</div>'); ?>
					</div>
					<div class="list-group-item">
						<?php echo form_password($confirm_new_password); ?>
						<?php echo form_error($confirm_new_password['name'], '<div class="error">', '</div>'); ?>
					</div>
				</div>
				<button type="submit" name="change" class="btn btn-lg btn-primary btn-block">Change Password</button>
				<div class="line line-dashed"></div>
			
			<?php echo form_close(); ?>
		</section>
	</div>
</section>
<footer id="footer">
	<div class="text-center padder">
		<p>
			<small>Copyright &copy; 2016, <a href="<?php echo site_url();?>">Cut Out Image</a></small>
		</p>
	</div>
</footer>