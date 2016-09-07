
<?php
$fullname = array(
	'name'	=> 'fullname',
	'id'	=> 'fullname',
    'class' => 'form-control',
	// 'value' => set_value('fullname')
	'value' => (isset($user_data->username) && !empty($user_data->username)? $user_data->username : (empty($user_data->username) ?  set_value('fullname') : set_value('fullname')))
);
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'class' => 'form-control',
	// 'value'	=> set_value('email')
	'value' => (isset($user_data->email)? $user_data->email : set_value('email'))
);
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'class' => 'form-control',
	// 'value' => set_value('password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'value' => (isset($user_data->password)? $user_data->password : set_value('password'))
);
$company = array(
	'name'	=> 'company',
	'id'	=> 'company',
	'class' => 'form-control',
	// 'value' => set_value('company'),
	'value' => (isset($company_data->name)? $company_data->name : set_value('company'))
);
$phone = array(
	'name'	=> 'phone',
	'id'	=> 'phone_add',
	'class' => 'form-control',
	// 'value' => set_value('phone'),
	'value' => (isset($user_data->phone)? $user_data->phone : set_value('phone'))
);
$website = array(
	'name'	=> 'website',
	'id'	=> 'website',
	'class' => 'form-control',
	// 'value' => set_value('Website'),
	'value' => (isset($company_data->website)? $company_data->website : set_value('website'))
);
$address_one = array(
	'name'	=> 'address1',
	'id'	=> 'address1',
	'class' => 'form-control',
	// 'value' => set_value('address'),
	'value' => (isset($company_data->address1)? $company_data->address1 : set_value('address1'))
);
$address_two = array(
	'name'	=> 'address2',
	'id'	=> 'address2',
	'class' => 'form-control',
	// 'value' => set_value('address')
	'value' => (isset($company_data->address2)? $company_data->address2 : set_value('address2'))
);
$zip = array(
	'name'	=> 'zip',
	'id'	=> 'zip',
	'class' => 'form-control',
	// 'value' => set_value('zip')
	'value' => (isset($company_data->postal_code)? $company_data->postal_code : set_value('zip'))
);
$town = array(
	'name'	=> 'town',
	'id'	=> 'town',
	'class' => 'form-control',
	// 'value' => set_value('town')
	'value' => (isset($company_data->city)? $company_data->city : set_value('town'))
);
$vat_id = array(
	'name'	=> 'vatId',
	'id'	=> 'vatId',
	'class' => 'form-control',
	// 'value' => set_value('vatId'),
	'value' => (isset($company_data->vat_id)? $company_data->vat_id : set_value('vat_id'))
);

?>

	<section class="vbox">
	    <section class="scrollable padder">
			<div class="m-b-md">
				<h3 class="m-b-none"><?php echo (isset($user_data))? "UPDATA USER DATA ID &nbsp;".$user_data->user_id : "REGISTER NEW USER" ?></h3>
				<p><?php echo validation_errors(); ?></p>
			</div>
			<div class="row">
		      	<?php echo form_open((isset($user_data)) ? site_url().'/admin/update_user_data/'.$user_data->user_id : $this->uri->uri_string()); ?>
					<div class="col-sm-6">
					  <section class="panel panel-default">
					    <header class="panel-heading font-bold">Basic information:</header>
					    	<div class="panel-body">
						        <div class="form-group">
							        <?php echo form_label('Full Name *', 'fullname'); ?>
							        <?php echo form_input($fullname); ?>
							        <?php echo form_error('fullname'); ?>

						        </div>
						        <div class="form-group">
							        <?php echo form_label('Email *', 'email'); ?>
							        <?php echo form_input($email); ?>
							        <?php echo form_error('email'); ?>
						        </div>
						        <?php if (!isset($user_data)): ?>
							        <div class="form-group">
										<?php echo form_label('Password *', 'password'); ?>
										<?php echo form_password($password); ?>
										<?php echo form_error('password'); ?>
									</div>
						        <?php endif ?>
								<div class="form-group">
									<?php echo form_label('Company Name *', 'company'); ?>
									<?php echo form_input($company); ?>
									<?php echo form_error('company'); ?>
								</div>
								<div class="form-group">
									<?php echo form_label('Country *', 'country'); ?>
									<?php echo country_dropdown('country', 'select_country_add', 'form-control', (isset($user_data->country)? $user_data->country : set_value('country')), array('AU','AT','BE','DK','FR','DE','IE','IT','LU','NL','NO','PL','RO','ES','SE','CH','GB','US'));?>
								</div>
								<div class="form-group">
									<?php echo form_label('Phone Number *', 'phone'); ?>
									<?php echo form_input($phone); ?>
									<?php echo form_error('phone'); ?>
								</div>
					    	</div>
					  </section>
					</div>
					<div class="col-sm-6">
					  <section class="panel panel-default">
					    <header class="panel-heading font-bold">Billing information:</header>
					    	<div class="panel-body">
						        <div class="form-group">
									<?php echo form_label('Website', 'website'); ?>
									<?php echo form_input($website); ?>
									<?php echo form_error('website'); ?>
								</div>
								<div class="form-group">
									<?php echo form_label('Address 1', 'address_one'); ?>
									<?php echo form_input($address_one); ?>
									<?php echo form_error('address_one'); ?>
								</div>
								<div class="form-group">
									<?php echo form_label('Address 2', 'address_two'); ?>
									<?php echo form_input($address_two); ?>
									<?php echo form_error('address_two'); ?>
								</div>
								<div class="form-group">
									<?php echo form_label('Zip / Postal Code *', 'zip'); ?>
									<?php echo form_input($zip); ?>
									<?php echo form_error('zip'); ?>
								</div>
								<div class="form-group">
									<?php echo form_label('Town *', 'town'); ?>
									<?php echo form_input($town); ?>
									<?php echo form_error('town'); ?>
								</div>
								<div class="form-group">
									<?php echo form_label('VAT ID', 'vat_id'); ?>
									<?php echo form_input($vat_id); ?>
									<?php echo form_error('vat_id'); ?>
								</div>
					    	</div>
					  </section>
					</div>
					<div class="col-sm-12">
						<button type="submit" class="btn btn-lg btn-primary btn-block"><?php echo (isset($user_data))? "Update": "Register"; ?></button>
						<div class="line line-dashed"></div>
					</div>
				<?php echo form_close(); ?>
			</div>
	    </section>
	</section>
	<script type="text/javascript">

	jQuery(document).ready(function($) {

		$("#select_country_add").on('change', function(){
			// var callcode = $(this).data('callcode');
			var callcode = $('option:selected', this).data('callcode');
			$("#phone_add").val("+" + callcode + " ").focus();

		});

		// $('form').on('submit', function(event){
		// 	if(!Portal.Helpers.adminvalidateRegisterForm()){
		// 		return false;
		// 	}

			// if( ! $("input[name=check]").is(':checked')){
			// 	event.preventDefault();
			// 	var remote = site_url + 'auth/popup_tos/';
			// 	var modal = $('<div class="modal fade" id="ajaxModal"><div class="modal-body"></div></div>');
			// 	$('body').append(modal);
			// 	modal.modal();
			// 	modal.load(remote);
			// 	return false;
			// 	//return confirm('You must agree to our "TOS". Click OK to accept and continue or cancel otherwise.');
			// }
		// });

	});
</script>