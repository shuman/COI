<section class="vbox">
	<section class="scrollable">
		<section class="hbox stretch">
			<aside class="col-lg-4 bg-light lter b-r no-padder view_profile">
				<section class="vbox">
					<section class="scrollable">
						<div class="wrapper">
							<section class="panel no-border bg-primary lt">
								<div class="panel-body">
									<div class="row m-t-md">

										<div class="col-lg-12 text-center">
											<div class="inline">
												<div class="easypiechart" data-percent="100" data-line-width="8" data-bar-color="#fff" data-track-Color="#2796de" data-scale-Color="false" data-size="140" data-line-cap='butt' data-animate="1000">
													<div id="profile_avatar" class="thumb-lg avatar">
														<img src="<?php echo $this->avatar;?>" class="dker">
														<form action="<?php echo site_url('ajax/upload_avatar');?>" class="dz-clickable dropzone" id="file-upload" enctype="multipart/form-data">
													        <div class="dz-default dz-message"><span>Click or drop your picture here!</span></div>
													    </form>
													</div>
												</div>
												<div class="h4 m-t m-b-xs font-bold text-lt"><?php echo (isset($profile->fullname)) ? $profile->fullname : '';?></div>
												<!--small class="text-muted m-b">Web Developer</small-->
											</div>
										</div>
									</div>
								</div>
								<footer class="panel-footer dk text-left no-border">
									<div class="row pull-out">
										<div class="col-xs-4 b-b hidden-xs">
											<div class="m-t-sm m-b-sm">
												<span class="text-white pull-left m-t-n-xs m-r-xs"><i class="fa fa-briefcase"></i></span>
												<span class="m-b-xs h6 block text-white">Company</span>

											</div>
										</div>
										<div class="col-xs-8 dker b-b">
											<div class="m-t-sm m-b-sm">
												<span class="m-b-xs h6 block text-white"><?php echo (isset($company->name)) ? $company->name : '';?>&nbsp;</span>

											</div>
										</div>

									</div>
									<div class="row pull-out">
										<div class="col-xs-4 b-b hidden-xs">
											<div class="m-t-sm m-b-sm">
												<span class="text-white pull-left m-t-n-xs m-r-xs"><i class="fa fa-phone"></i></span>
												<span class="m-b-xs h6 block text-white">Phone</span>

											</div>
										</div>
										<div class="col-xs-8 dker b-b">
											<div class="m-t-sm m-b-sm">
												<span class="m-b-xs h6 block text-white"><?php echo (isset($company->phone)) ? $company->phone : '';?>&nbsp;</span>
											</div>
										</div>

									</div>
									<div class="row pull-out">
										<div class="col-xs-4">
											<div class="m-t-sm m-b-sm hidden-xs">
												<span class="text-white pull-left m-t-n-xs m-r-xs"><i class="i i-mail2"></i></span>
												<span class="m-b-xs h6 block text-white">Email</span>

											</div>
										</div>
										<div class="col-xs-8 dker">
											<div class="m-t-sm m-b-sm">
												<span class="m-b-xs h6 block text-white"><?php echo (isset($profile->email)) ? $profile->email : '';?>&nbsp;</span>

											</div>
										</div>

									</div>
								</footer>
							</section>
							<section class="panel panel-default">
								<header class="panel-heading">
									<a href="<?php echo site_url('ajax/invite_user');?>" data-toggle="ajaxModal" class="btn btn-xs btn-default pull-right"><i class="i i-user2"></i> Invite User</a>
									<span class="h5 font-bold">User List</span>
								</header>
							</section>  
							<?php
							if($invited_members){
								foreach ($invited_members as $invited) {
									?>
									<section class="panel clearfix bg-light dker m-t-md">
										<div class="panel-body">
											<a href="#" class="thumb pull-left m-r">
												<img src="<?php echo avatar($invited->invite_to, array(50,50));?>" class="img-circle b-a b-3x b-white">
											</a>
											<div class="clear">
												<div class="text-info"><?php echo $invited->invite_to_name;?></div>
												<small class="block text-muted">Invited (Pending)</small>
												<small class="block text-muted"><?php echo date("d F, Y", strtotime($invited->invite_date));?></small>
											</div>
										</div>
									</section>
									<?php
								}
							}
							if($company_members){
								foreach ($company_members as $member) {
									?>
									<section class="panel clearfix bg-light dker m-t-md">
										<div class="panel-body">
											<a href="#" class="thumb pull-left m-r">
												<img src="<?php echo avatar($member->email, array(50,50));?>" class="img-circle b-a b-3x b-white">
											</a>
											<div class="clear">
												<a href="#" class="text-info"><?php echo $member->fullname;?></a>
												<!--span class="text-right pull-right">
													<a href="#" class="text-danger" data-toggle="tooltip" data-placement="left" title="Delete User"><i class="fa fa-trash-o"></i></a>
													<a href="#" class="text-black m-l-xs" data-toggle="tooltip" data-placement="left" title="Edit User"> <i class="i i-pencil2"></i></a>
												</span-->
												<small class="block text-muted"><?php echo $member->designation;?></small>
											</div>
										</div>
									</section>
									<?php
								}
							}
							?>
						</div>
					</section>
				</section>
			</aside>
			<aside class="col-lg-8 b-l no-padder user_information">
				<section class="vbox">
					<section class="scrollable">
						<div class="wrapper">
							<!-- .breadcrumb -->
							<ul class="breadcrumb">
								<li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
								<li class="active"><a href="#"><?php echo (isset($profile->fullname)) ? $profile->fullname : '';?></a></li>

							</ul>
							<!-- / .breadcrumb -->

							<!-- left tab -->
							<section class="panel panel-default">
								<header class="panel-heading bg-light">
									<ul class="nav nav-tabs pull-right">
										<li class="active"><a href="#profile" data-toggle="tab"><i class="fa fa-user text-muted"></i> Profile</a></li>
										<?php if(is_company_owner($this->user_id)): ?>
										<li><a href="#company" data-toggle="tab"><i class="fa fa-building-o text-muted"></i> Billing</a></li>
										<?php endif; ?>
										<!--li><a href="#billing-1" data-toggle="tab"><i class="fa fa-dollar text-muted"></i> Billing Info</a></li-->
										<li><a href="#notifications" data-toggle="tab"><i class="fa fa-cog text-muted"></i> Email <span class="hidden-xs">Settings</span></a></li>
									</ul>
									<span class="hidden-xs user_information_title">User Information</span>
								</header>
								<div class="panel-body">
									<div class="tab-content">              
										<div class="tab-pane active" id="profile">
											<div class="panel-body">
												<form id="profile_form" onsubmit="return Portal.User.Profile.save();" class="bs-example form-horizontal" name="profile_form" method="post" action="">
													<div class="form-group">
														<label class="col-lg-3 control-label">Full Name</label>
														<div class="col-lg-9">
															<input type="text" name="fullname" class="form-control" placeholder="your name" value="<?php echo (isset($profile->fullname)) ? $profile->fullname : '';?>">
														</div>
													</div>
													<div class="form-group">
														<label class="col-lg-3 control-label">Email Address</label>
														<div class="col-lg-9">
															<input type="email" name="email" class="form-control" placeholder="your email address" value="<?php echo (isset($profile->email)) ? $profile->email : '';?>">
														</div>
													</div>
													<?php /*
													<div class="form-group">
														<label class="col-lg-2 control-label">Password</label>
														<div class="col-lg-10">
															<div class="row">
																<div class="col-md-6">
																	<input type="password" name="newpassword" class="form-control" placeholder="enter password if new set" value="" autocomplete="off">
																</div>
																<div class="col-md-6">
																	<input type="password" name="newpassword2" class="form-control" placeholder="re-type password">
																</div>

															</div>
														</div>
													</div>
													*/ ?>

													<div class="form-group">
														<label class="col-sm-3 control-label">Newsletter</label>
														<div class="col-sm-9 newsletter_switch">
															<label class="switch">
																<input name="<?php echo NEWSLETTER;?>" type="checkbox" checked value="1">
																<span></span>
															</label>
														</div>
													</div>

													<div class="form-group">
														<div class="col-sm-10 col-sm-offset-2">
															<button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
															<span class="ajax_msg" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Please wait...</span>
														</div>
													</div>
												</form>
											</div>
										</div>
										<?php if(is_company_owner($this->user_id)): ?>
										<div class="tab-pane" id="company">
											<div class="panel-body">
												<form id="company_form" onsubmit="return Portal.User.Company.save();" class="bs-example form-horizontal" method="post" action="">
													<input type="hidden" id="company_action" name="action" value="update"/>
													<div class="form-group">
														<label class="col-lg-3 control-label">Company Name<span class="text-danger">*</span></label>
														<div class="col-lg-9">
															<input type="text" class="form-control" data-required="true" name="name" value="<?php echo (isset($company->name)) ? $company->name : '';?>" required />
														</div>
													</div>
													<div class="form-group">
														<label class="col-lg-3 control-label">Website</label>
														<div class="col-lg-9">
															<input type="text" class="form-control" data-type="url" data-required="true" name="website" value="<?php echo (isset($company->website)) ? $company->website : '';?>">
														</div>
													</div>
													<div class="form-group">
														<label class="col-lg-3 control-label">Billing Email</label>
														<div class="col-lg-9">
															<input type="email" class="form-control" data-type="email" data-required="true" name="email" value="<?php echo (isset($company->email)) ? $company->email : $profile->email;?>">
														</div>
													</div>

													<div class="form-group">
														<label class="col-lg-3 control-label">Address Line 1<span class="text-danger">*</span></label>
														<div class="col-lg-9">
															<input type="text" class="form-control" data-required="true" name="address1" value="<?php echo (isset($company->address1)) ? $company->address1 : '';?>" required />
														</div>
													</div>

													<div class="form-group">
														<label class="col-lg-3 control-label">Address Line 2</label>
														<div class="col-lg-9">
															<input type="text" class="form-control" name="address2" value="<?php echo (isset($company->address2)) ? $company->address2 : '';?>">
														</div>
													</div>

													<div class="form-group">
														<label class="col-lg-3 control-label">Zip / Postal Code<span class="text-danger">*</span></label>
														<div class="col-lg-6">
															<input type="text" class="form-control" data-required="true" name="postal_code" value="<?php echo (isset($company->postal_code)) ? $company->postal_code : '';?>" required />
														</div>
													</div>

													<div class="form-group">
														<label class="col-lg-3 control-label">Town / City<span class="text-danger">*</span></label>
														<div class="col-lg-9">
															<input type="text" class="form-control" data-required="true" name="city" value="<?php echo (isset($company->city)) ? $company->city : '';?>" required />
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label">Country</label>
														<div class="col-lg-9">
															<select name="country" data-required="true" disabled class="form-control">
																<option value="<?php echo (isset($company->country)) ? $company->country : '';?>" selected=""><?php echo (isset($company->country)) ? country_name($company->country) : '';?></option>
															</select>
														</div>
													</div>

													<div class="form-group">
														<label class="col-lg-3 control-label">VAT ID</label>
														<div class="col-lg-9">
															<input type="text" class="form-control" data-required="true" name="vat_id" value="<?php echo (isset($company->vat_id)) ? $company->vat_id : '';?>">
														</div>
													</div>

													<div class="form-group">
														<label class="col-lg-3 control-label">Phone Number<span class="text-danger">*</span></label>
														<div class="col-lg-9">
															<input type="text" class="form-control" data-type="phone" data-required="true" name="phone" required value="<?php echo (isset($company->phone)) ? $company->phone : '';?>">
														</div>
													</div>

													<div class="form-group">
														<div class="col-sm-9 col-sm-offset-3">
															<button type="submit" class="btn btn-primary">Save Changes</button>
															<span class="ajax_msg" style="display:none;">Submitting. Please wait...</span>
														</div>
													</div>
												</form>
											</div>
										</div>
										<?php endif; ?>
										<div class="tab-pane" id="notifications">
											<span class="m-l-sm block text-left"><strong>Email Notification:</strong> You will receive the every notificaiton via email as checked below. Please un-check if you do not wish to receive notification via email. You will still be able to see all the notifications on your dashboard.  </span>
											<div class="panel-body">
												<form id="notification_settings_form" onsubmit="return Portal.User.Settings.saveNotify();" name="notification_settings_form" class="bs-example form-horizontal" method="post" action="">
													<div class="col-sm-10">
														<div class="checkbox i-checks">
															<label>
																<input name="<?php echo NOTIFY_ORDER_SUBMIT;?>" type="checkbox"<?php echo (isset($settings[NOTIFY_ORDER_SUBMIT]) && $settings[NOTIFY_ORDER_SUBMIT] > 0) ? ' checked':'checked';?> value="1">
																<i></i>
																Order Submit - Customer
															</label>
														</div>
														<div class="checkbox i-checks">
															<label>
																<input name="<?php echo NOTIFY_QUOTE_SUBMIT;?>" type="checkbox"<?php echo (isset($settings[NOTIFY_QUOTE_SUBMIT]) && $settings[NOTIFY_QUOTE_SUBMIT] > 0) ? ' checked':'checked';?> value="1">
																<i></i>
																Quote Submit - Customer
															</label>
														</div>
														<div class="checkbox i-checks">
															<label>
																<input name="<?php echo NOTIFY_QUOTE_REVIEWED;?>" type="checkbox"<?php echo (isset($settings[NOTIFY_QUOTE_REVIEWED]) && $settings[NOTIFY_QUOTE_REVIEWED] > 0) ? ' checked':'checked';?> value="1">
																<i></i>
																Quotation Reviewed
															</label>
														</div>
														<div class="checkbox i-checks">
															<label>
																<input name="<?php echo NOTIFY_QUOTE_ACCEPT;?>" type="checkbox"<?php echo (isset($settings[NOTIFY_QUOTE_ACCEPT]) && $settings[NOTIFY_QUOTE_ACCEPT] > 0) ? ' checked':'checked';?> value="1">
																<i></i>
																Quote Accept - Customer
															</label>
														</div>
														<div class="checkbox i-checks">
															<label>
																<input name="<?php echo NOTIFY_ORDER_RECEIVED;?>" type="checkbox"<?php echo (isset($settings[NOTIFY_ORDER_RECEIVED]) && $settings[NOTIFY_ORDER_RECEIVED] > 0) ? ' checked':'checked';?> value="1">
																<i></i>
																Order Received
															</label>
														</div>
														<div class="checkbox i-checks">
															<label>
																<input name="<?php echo NOTIFY_ORDER_READY;?>" type="checkbox"<?php echo (isset($settings[NOTIFY_ORDER_READY]) && $settings[NOTIFY_ORDER_READY] > 0) ? ' checked':'checked';?> disabled value="1">
																<i></i>
																Order Ready
															</label>
														</div>
														<div class="checkbox i-checks">
															<label>
																<input name="<?php echo NOTIFY_BILLING_PAYMENT;?>" type="checkbox"<?php echo (isset($settings[NOTIFY_BILLING_PAYMENT]) && $settings[NOTIFY_BILLING_PAYMENT] > 0) ? ' checked':'checked';?> disabled value="1">
																<i></i>
																Billing &amp; Payment
															</label>
														</div>
														<div class="checkbox i-checks">
															<label>
																<input name="<?php echo NOTIFY_NEW_MESSAGE;?>" type="checkbox"<?php echo (isset($settings[NOTIFY_NEW_MESSAGE]) && $settings[NOTIFY_NEW_MESSAGE] > 0) ? ' checked':'checked';?> value="1">
																<i></i>
																New Massage
															</label>
														</div>
													</div>

													<div class="form-group">
														<div class="col-sm-4 m-t">
															<button type="submit" class="btn btn-primary">Save Changes</button>
															<span class="ajax_msg" style="display:none;">Submitting. Please wait...</span>
														</div>
													</div>

												</form>
											</div>
										</div>
									</div>
								</div>
							</section>
							<!-- / left tab -->
						</div>
					</section>
				</section>              
			</aside>
		</section>
	</section>
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		Portal.PageInit.Profile();

		Dropzone.options.fileUpload = {
			init: function() {
                this.on("addedfile", function(file) { 
                	$(".dropzone").css('opacity', '1');
                });

                this.on("success", function(file, response) {
                   // window.location = document.URL;
                   $(".my_avatar").attr("src", base_url +'assets/timthumb.php?src=avatar/'+response.filename+'&h=140&w=140');
                   $(".dker").attr("src", base_url +'assets/timthumb.php?src=avatar/'+response.filename+'&h=140&w=140');
                   $(".dz-error-message").css('opacity', '0'); 
                });

                this.on("removedfile", function(file){
                   $(".dropzone").css('opacity', ''); 
                });
            },
			paramName: "file",
			maxFilesize: 0.5, // MB
			addRemoveLinks: false,
			thumbnailWidth: 120,
			maxThumbnailFilesize: 5, //MB
			thumbnailHeight: 120,
      		addRemoveLinks: true,
			maxFiles: 1,
			acceptedFiles: 'image/*',
			dictRemoveFile: "Upload Again?",
			dictFileTooBig: "Max image size 512kB",
		};
	});

</script>
