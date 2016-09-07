<?php
$fullname = array(
	'name'	=> 'fullname',
	'id'	=> 'fullname',
	'class' => 'form-control no-border',
	'value' => set_value('fullname'),
	'placeholder' => 'Full Name',
	// 'required' => '',
);
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'class' => 'form-control no-border',
	'value'	=> set_value('email'),
	'placeholder' => 'Email',
	// 'required' => '',
);
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'class' => 'form-control no-border',
	'value' => set_value('password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'placeholder' => 'Password',
	// 'required' => '',
);
$company = array(
	'name'	=> 'company',
	'id'	=> 'company',
	'class' => 'form-control no-border',
	'value' => set_value('company'),
	'placeholder' => 'Company Name',
	// 'required' => '',
);
$phone = array(
	'name'	=> 'phone',
	'id'	=> 'phone',
	'class' => 'form-control no-border',
	'value' => set_value('phone'),
	'placeholder' => 'Phone Number',
	// 'required' => '',
);
?>
<section id="content" class="external m-t-lg wrapper-md animated fadeInUpBig">
	<div class="container aside-xl">
		<a class="navbar-brand2 block" href="<?php echo site_url('');?>"><img src="<?php echo base_url();?>assets/images/logo.svg" alt="Cut Out Image" /></a>
		<section id="auth_form" class="m-b-lg">
			<header class="wrapper text-center">
				<span>Register To Access Service Portal</span>
			</header>
			<?php echo form_open($this->uri->uri_string()); ?>
				<div class="list-group">
					<div class="list-group-item">
						<?php echo form_input($fullname); ?>
						<?php $fullname_error = form_error($fullname['name']); ?>
						<div class="error fullname <?php echo ($fullname_error) ? '':'hide';?>"><i class="i i-arrow"></i>The name field is required.</div>
					</div>
					<div class="list-group-item">
						<?php echo form_input($email); ?>
						
						<?php $email_error = form_error($email['name']); ?>
						<div class="error email <?php echo ($email_error) ? '':'hide';?>"><i class="i i-arrow"></i>The email field is required.</div>

						<?php $email_invalid = isset($errors[$email['name']]) ? $errors[$email['name']] : false; ?>
						<div class="error email_invalid <?php echo ($email_invalid) ? '':'hide';?>"><i class="i i-arrow"></i><?php echo $email_invalid;?></div>
					</div>
					<div class="list-group-item">
						<?php echo form_password($password); ?>
						<?php //echo form_error($password['name'], '<div class="error"><i class="i i-arrow"></i>', '</div>'); ?>
						<?php $password = form_error($password['name']); ?>
						<div class="error password <?php echo ($password) ? '':'hide';?>"><i class="i i-arrow"></i>The password field is required.</div>
					</div>
					<div class="list-group-item">
						<?php echo form_input($company); ?>
						<?php //echo form_error($company['name'], '<div class="error"><i class="i i-arrow"></i>', '</div>'); ?>
						<?php $company = form_error($company['name']); ?>
						<div class="error company <?php echo ($company) ? '':'hide';?>"><i class="i i-arrow"></i>The company field is required.</div>
					</div>
					<div class="list-group-item">
						<?php echo country_dropdown('country', 'select_country', 'form-control no-border', set_value('country'), array('AU','AT','BE','DK','FR','DE','IE','IT','LU','NL','NO','PL','RO','ES','SE','CH','GB','US'));?>
					</div>
					<div class="list-group-item">
						<?php echo form_input($phone); ?>
						<?php //echo form_error($phone['name'], '<div class="error"><i class="i i-arrow"></i>', '</div>'); ?>
						<?php $phone = form_error($phone['name']); ?>
						<div class="error phone <?php echo ($phone) ? '':'hide';?>"><i class="i i-arrow"></i>The phone field is required.</div>
					</div>
				</div>
				<div class="checkbox i-checks text-center">
					<label>
						<input type="checkbox" name="check" data-required="true"><i></i> I agree to the <a href="https://www.cutoutimage.com/terms-of-service" target="_blank" class="text-info">Terms of Service</a>
					</label>
				</div>

				<!--<div class="checkbox m-b">
				<lebel>
				  <input type="checkbox"> Agree The <a href="https://www.cutoutimage.com/terms-of-service" target="_blank">TOS</a>
				</lebel>
				</div> -->
				
				<button type="submit" class="btn btn-lg btn-primary btn-block">Register</button>
				<div class="line line-dashed"></div>

				<!--div class="m-b-sm">
					<div class="btn-group btn-group-justified">
						<a href="#" class="btn btn-sm btn-info"><i class="fa fa-fw fa-twitter"></i> Twitter</a>
						<a href="#" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-facebook"></i> Facebook</a>
						<a href="#" class="btn btn-sm btn-danger"><i class="fa fa-fw fa-google-plus"></i> Google+</a>
					</div>
				</div-->

				<p class="text-muted text-center"><small>Already have an account?</small></p>
				<a href="<?php echo site_url('/auth/login');?>" class="btn btn-lg btn-default btn-block">Login</a>
			<?php echo form_close(); ?>
		</section>
	</div>
</section>

<footer id="footer">
	<div class="text-center padder clearfix">
		<p>
			<small>Copyright &copy; 2016, <a href="https://www.cutoutimage.com">Cut Out Image</a></small>
		</p>
	</div>
</footer>


<script type="text/javascript">

	jQuery(document).ready(function($) {

		$("#select_country").on('change', function(){
			// var callcode = $(this).data('callcode');
			var callcode = $('option:selected', this).data('callcode');
			$("#phone").val("+" + callcode + " ").focus();

		});

		$('form').on('submit', function(event){
			if(!Portal.Helpers.validateRegisterForm()){
				return false;
			}

			if( ! $("input[name=check]").is(':checked')){
				event.preventDefault();
				var remote = site_url + 'auth/popup_tos/';
				var modal = $('<div class="modal fade" id="ajaxModal"><div class="modal-body"></div></div>');
				$('body').append(modal);
				modal.modal();
				modal.load(remote);
				return false;
				//return confirm('You must agree to our "TOS". Click OK to accept and continue or cancel otherwise.');
			}
		});

	});
</script>

