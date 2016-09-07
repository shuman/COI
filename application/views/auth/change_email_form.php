<?php
$password = array(
	'name'        => 'password',
	'id'          => 'password',
	'class'       => 'form-control no-border',
	'placeholder' => 'Re-enter your password',
);
$email = array(
	'name'        => 'email',
	'id'          => 'email',
	'class'       => 'form-control no-border',
	'placeholder' => 'New Email',
	'value'       => set_value('email'),
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
						<?php echo form_password($password); ?>
						<?php echo form_error($password['name'], '<div class="error">', '</div>'); ?>
					</div>
					<div class="list-group-item">
						<?php echo form_input($email); ?>
						<?php echo form_error($email['name'], '<div class="error">', '</div>'); ?>
					</div>
				</div>
				<button type="submit" name="change" class="btn btn-lg btn-primary btn-block">Send Confirmation Email</button>
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