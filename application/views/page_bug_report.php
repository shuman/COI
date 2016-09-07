<?php
$problem_type = array(
	'name'	=> 'problem_type',
	'class' => 'form-control',
	'value' => set_value('problem_type'),
	'required' => '',
);

$where_is_problem = array(
	'name'	=> 'where_is_problem',
	'class' => 'form-control',
	'value' => set_value('where_is_problem'),
);

$problem_summery = array(
	'name'	=> 'problem_summery',
	'class' => 'form-control',
	'value' => set_value('problem_summery'),
);

$bug_url = array(
	'name'	=> 'bug_url',
	'class' => 'form-control',
	'value' => set_value('bug_url'),
);

$email = array(
	'name'	=> 'email',
	'class' => 'form-control',
	'value' => set_value('email'),
	'required' => '',
);

$error_message = array(
	'name'	=> 'error_message',
	'class' => 'form-control',
	'value' => set_value('error_message'),
);


?>
<section class="hbox stretch">
	<section>
		<section class="vbox">
			<section class="scrollable padder">              
				<section class="row m-b-md">
					<div class="col-sm-6">
						<h3 class="m-b-xs text-black">Report Bug</h3>
						<small>If something's not working please follow the instructions below to let us know more.</small>
					</div>
				</section>
				<div class="row">
					<div class="col-md-8">
						<form name="bugreport_form" id="bugreport_form" action="" method="post" data-validate="parsley">
							<input type="hidden" name="nonce" value="<?php echo create_nonce('bugs');?>">
							<section class="panel panel-default">
								<header class="panel-heading">
									<span class="h4">COI Portal Bug Report Wizard</span>
								</header>
								<div class="panel-body">
									<?php if(isset($sent)) : ?>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">×</button>
										<i class="fa fa-ok-sign"></i> <?php echo lang('contact_thank_msg');?>
									</div>
									<?php endif; ?>

									<p class="alert alert-warning">All bug reports must be written in English. The bug report wizard should only be used for reporting bugs, and not for support. For support related queries please visit the <a href="/support">Support</a> pages.</p>
									<fieldset>
										<legend>Bug description</legend>
										<div class="form-group">
											<label>What kind of problem is this? *</label>
											<?php echo form_input($problem_type); ?>
											<?php echo form_error($problem_type['name'], '<div class="error"><i class="i i-arrow"></i>', '</div>'); ?>
										</div>
										<div class="form-group">
											<label>Where is the problem?</label>
											<?php echo form_input($where_is_problem); ?>
											<?php echo form_error($where_is_problem['name'], '<div class="error"><i class="i i-arrow"></i>', '</div>'); ?>
										</div>
										<div class="form-group">
											<label>Brief summary of the problem encountered:</label>
											<?php echo form_input($problem_summery); ?>
											<?php echo form_error($problem_summery['name'], '<div class="error"><i class="i i-arrow"></i>', '</div>'); ?>
										</div>
										<div class="form-group">
											<label>What URL triggers this bug (if any)?</label>
											<?php echo form_input($bug_url); ?>
											<?php echo form_error($bug_url['name'], '<div class="error"><i class="i i-arrow"></i>', '</div>'); ?>
										</div>
										<div class="form-group">
											<label>Provide an email address where we can contact you: *</label>
											<?php echo form_input($email); ?>
											<?php echo form_error($email['name'], '<div class="error"><i class="i i-arrow"></i>', '</div>'); ?>
										</div>
										<div class="form-group">
											<label>Paste all error messages here (if any):</label>
											<?php echo form_textarea($error_message); ?>
											<?php echo form_error($error_message['name'], '<div class="error"><i class="i i-arrow"></i>', '</div>'); ?>
										</div>
									</fieldset>
								</div>
								<footer class="panel-footer text-right bg-light lter">
									<button type="submit" class="btn btn-success btn-s-xs">SEND REPORT</button>
								</footer>
							</section>
						</form>
					</div>
				</div>
			</section>
		</section>
	</section>

</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>