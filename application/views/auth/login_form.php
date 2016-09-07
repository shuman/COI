<?php
$login = array(
	'type'        => 'email',
	'name'        => 'login',
	'id'          => 'login',
	'class'       => 'form-control ar text-center no-border',
	'value'       => set_value('login'),
	'maxlength'   => 80,
	'size'        => 30,
	'placeholder' =>'Email Address',
);
if ($login_by_username AND $login_by_email) {
	$login_label = 'Email or login';
} else if ($login_by_username) {
	$login_label = 'Login';
} else {
	$login_label = 'Email';
}

$password = array(
	'name'        => 'password',
	'id'          => 'password',
	'class'       => 'form-control ar text-center no-border',
	'size'        => 30,
	'placeholder' => 'Password',
);
$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember'),
	'style' => 'margin:0;padding:0',
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
);
?>
<section id="content" class="external m-t-lg wrapper-md animated fadeInDownBig">    
	<div class="container aside-xl">
		<a class="navbar-brand2 block" href="<?php echo site_url('/portal');?>"><img src="<?php echo base_url();?>assets/images/logo.svg" alt="Cut Out Image" /></a>
		<section id="auth_form" class="m-b-lg">
			<header class="wrapper text-center text-white-ar">
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
					<div class="list-group-item ar">
						<?php echo form_input($login); ?>
						<?php $login_error = form_error($login['name']); ?>
						<div class="error login <?php echo ($login_error) ? '':'hide';?>"><i class="i i-arrow"></i>The login field is required.</div>
						<?php $login_invalid = isset($errors[$login['name']]) ? $errors[$login['name']] : false; ?>
						<div class="error login_invalid <?php echo ($login_invalid) ? '':'hide';?>"><i class="i i-arrow"></i><?php echo $login_invalid;?></div>
					</div>
					<div class="list-group-item ar">
						<?php echo form_password($password); ?>
						<?php //echo form_error($password['name'], '<div class="error"><i class="i i-arrow"></i>', '</div>'); ?>
						<?php $password = form_error($password['name']); ?>
						<div class="error password <?php echo ($password) ? '':'hide';?>"><i class="i i-arrow"></i>The password field is required.</div>
					</div>
				</div>
				<button type="submit" class="btn btn-lg btn-dark btn-block">Login</button>
				<div class="text-center dk m-t m-b"><a href="<?php echo site_url('/auth/forgot_password');?>"><small class="text-warning-dk">Forgot Password?</small></a></div>
				<div class="line line-dashed"></div>
				<p class="text-white-ar text-center"><small>Do not have an account?</small></p>
				<a href="<?php echo site_url('/auth/register');?>" class="btn btn-lg btn-info ar btn-block">Register Now</a>
			
			<?php echo form_close(); ?>
		</section>
	</div>
</section>
<footer id="footer">
	<div class="text-center padder">
		<p>
			<small><a class="text-white" href="<?php echo site_url();?>">Copyright &copy; 2016, Cut Out Image</a></small>
		</p>
	</div>
</footer>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(window).resize(function(event) {
			$("body").css("min-height", $(window).height());
		});
			
		$("body").css("min-height", $(window).height());
		

		$('form').on('submit', function(event){
			if(!Portal.Helpers.validateLoginForm()){
				return false;
			}
			return true;
		});
	});
</script>