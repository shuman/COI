<?php
$login = array(
	'name'        => 'login',
	'id'          => 'login',
	'class'       => 'form-control no-border',
	'placeholder' => 'Email Address',
	'value'       => set_value('login'),
);
if ($this->config->item('use_username', 'tank_auth')) {
	$login_label = 'Email or login';
} else {
	$login_label = 'Email';
}
?>
<section id="content" class="external m-t-lg wrapper-md animated fadeInDownBig">    
	<div class="container aside-xl">
		<a class="navbar-brand2 block" href="<?php echo site_url('/portal');?>"><img src="<?php echo base_url();?>assets/images/logo.svg" alt="Cut Out Image" /></a>
		<section id="auth_form" class="m-b-lg">
			<header class="wrapper text-center">
				<span>Service Portal / Client Area</span>
			</header>
			<?php echo form_open($this->uri->uri_string()); ?>
				<div class="list-group">
					<div class="list-group-item">
						<?php echo form_input($login); ?>
						<?php echo form_error($login['name'], '<div class="error"><i class="i i-arrow"></i>', '</div>'); ?>
						<?php echo (isset($errors['login']) && !empty($errors['login'])) ? '<div class="error"><i class="i i-arrow"></i>'.$errors['login'].'</div>' : ''; ?>
					</div>
				</div>
				<button type="submit" class="btn btn-lg btn-primary btn-block">Retrive Account</button>
				<div class="line line-dashed"></div>
				<p class="text-muted text-center"><small>OR</small></p>
				<a href="<?php echo site_url('/auth/login');?>" class="btn btn-lg btn-default btn-block">Try Login</a>
			
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
