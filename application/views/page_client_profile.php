<section class="hbox stretch">
    <section>
        <section class="vbox">
            <section class="scrollable padder">
                <section class="panel panel-default" >
                    <div class="panel-body" id="profile-custom-style">
                        <div class="clearfix text-center" >
                            <div class="inline">
                                <div class="profile-box">
                                    <div id="profile_avatar" class="thumb-lg">

                                        <?php $gravatar_url = 'http://www.gravatar.com/avatar/' . md5($profile->email) . '?s=140'; ?>
                                        <?php if (!empty($profile->avatar)): ?>
                                            <img src="<?php echo $this->avatar; ?>" class="dker">
                                        <?php else: ?>
                                            <img src="<?php echo $gravatar_url; ?>" class="dker">
                                        <?php endif ?>

                                        <form action="<?php echo site_url('ajax/upload_avatar'); ?>" class="dz-clickable dropzone" id="file-upload" enctype="multipart/form-data">
                                            <div class="dz-default dz-message"><span>Click Here</span></div>
                                        </form>
                                    </div>
                                </div>

                                <div class="p-description">
                                    <div class="b-inline">
                                        <h4 class="h4 m-b-xs"><strong><?php echo (!empty($profile->fullname)) ? $profile->fullname : ''; ?></strong></h4>
                                        <small class="text-muted m-b"><span class="t-bold"><?php echo (!empty($profile->designation)) ? $profile->designation . " at&nbsp;&nbsp;" : ""; ?><?php echo (!empty($company->name)) ? $company->name : ''; ?></span></small>
                                    </div>
                                    <div class="b-inline">
                                        <small class="text-muted m-b"><span><i class="fa fa-envelope-o"></i></span><?php echo (!empty($profile->email)) ? $profile->email : ''; ?></small>
                                        <small class="text-muted m-b"><span><i class="i i-phone"></i></span><?php echo (!empty($profile->phone)) ? $profile->phone : ''; ?></small>
                                    </div>                        		
                                </div>
                            </div>
                            <!--                            <div class="message-box">
                                                                 <a href="<?php echo site_url('/admin/update_user_details_by_id/'); ?>/<?php echo $user_profile->user_id; ?>" class="btn btn-s-md btn-info inline"><i class="fa fa-edit"></i> Edit Profile</a> 
                                                            <a data-toggle="ajaxModal" href="<?php echo site_url('/ajax/edit_profile/'); ?>/<?php echo $profile->user_id; ?>" class="btn btn-s-md btn-default inline"><i class="fa fa-edit"></i> Edit Profile</a>
                                                             <a href="#" class="btn btn-s-md btn-info inline m-l-sm"><i class="fa fa-envelope"></i> Send Message</a> 
                                                        </div>                      -->
                        </div>
                    </div>
                    <div class="row" id="profile-custom-style2">
                        <div class="col-sm-5 m-r-n">
                            <div class="row m-n">
                                <header class="panel-heading b-r b-b">
                                    <strong>Quick Summary</strong>
                                </header>
                                <section class="p-l-sm p-r-sm p-t-sm p-b-sm b-r b-light">
                                    <div class="bg-light dk wrapper">
                                        <div class="text-center m-b-n m-t-sm">
                                            <div class="sparkline" data-type="line" data-height="65" data-width="100%" data-line-width="2" data-line-color="#dddddd" data-spot-color="#bbbbbb" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="3" data-resize="true" values="280,320,220,385,450,320,345,250,250,250,400,380"></div>
                                            <div class="sparkline inline" data-type="bar" data-height="45" data-bar-width="6" data-bar-spacing="6" data-bar-color="#1ccc88">10,9,11,10,11,10,12,10,9,10,11,9,8</div>
                                        </div>
                                    </div>
                                    <div class="panel-body b-a m-b-sm">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <small class="text-muted block font-bold">Today</small>
                                                <span>Files: <?php echo!empty($this->notifications->today_file_processed) ? $this->notifications->today_file_processed : '0'; ?></span>
                                                <small class="text-muted block">Orders <span class="badge bg-default"><?php echo $this->notifications->todays_order; ?></span></small>
                                            </div>
                                            <div class="col-xs-4">
                                                <small class="text-muted block font-bold">Last Week</small>
                                                <span>Files: <?php echo!empty($this->notifications->weeks_file_processed) ? $this->notifications->weeks_file_processed : '0'; ?></span>
                                                <small class="text-muted block">Orders <span class="badge bg-default"><?php echo $this->notifications->weeks_order; ?></span></small>
                                            </div>
                                            <div class="col-xs-4">
                                                <small class="text-muted block font-bold">Last Month</small>
                                                <span>Files: <?php echo!empty($this->notifications->months_file_processed) ? $this->notifications->months_file_processed : '0'; ?></span>
                                                <small class="text-muted block">Orders <span class="badge bg-default"><?php echo $this->notifications->months_order; ?></span></small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="b-l b-r b-t inline ar-block">
                                        <div class="col-md-6 b-b b-r">
                                            <a href="#" class="block padder-v hover">
                                                <span class="i-s i-s-2x pull-left m-r-sm">
                                                    <i class="i i-hexagon2 i-s-base text-info hover-rotate"></i>
                                                    <i class="i i-stack i-sm text-dark"></i>
                                                </span>
                                                <span class="clear">
                                                    <span class="h4 block m-t-xs text-black"><?php echo $this->notifications->count_total_orders; ?></span>
                                                    <small class="text-muted text-u-c">Total Orders</small>
                                                </span>

                                            </a>
                                        </div>
                                        <div class="col-md-6 b-b">
                                            <a href="#" class="block padder-v hover">
                                                <span class="i-s i-s-2x pull-left m-r-sm">
                                                    <i class="i i-hexagon2 i-s-base text-primary hover-rotate"></i>
                                                    <i class="fa fa-dollar i-sm text-dark"></i>
                                                </span>
                                                <span class="clear">
                                                    <span class="h4 block m-t-xs text-black">US $<?php echo $this->notifications->total_paid + $this->notifications->total_due; ?><span class="text-sm"></span></span>
                                                    <small class="text-muted text-u-c">Total Spent</small>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="col-md-6 b-b b-r">
                                            <a href="#" class="block padder-v hover">
                                                <span class="i-s i-s-2x pull-left m-r-sm">
                                                    <i class="i i-hexagon2 i-s-base text-warning hover-rotate"></i>
                                                    <i class="i i-stack i-sm text-dark"></i>
                                                </span>
                                                <span class="clear">
                                                    <span class="h4 block m-t-xs text-black"><?php echo $this->notifications->count_pending_orders; ?></span>
                                                    <small class="text-muted text-u-c">Pending Orders</small>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="col-md-6 b-b">
                                            <a href="#" class="block padder-v hover">
                                                <span class="i-s i-s-2x pull-left m-r-sm">
                                                    <i class="i i-hexagon2 i-s-base  text-info hover-rotate"></i>
                                                    <i class="fa fa-dollar i-sm text-dark"></i>
                                                </span>
                                                <span class="clear">
                                                    <span class="h4 block m-t-xs  text-black">US $<?php echo $this->notifications->total_paid; ?></span>
                                                    <small class="text-muted text-u-c">Total Paid</small>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="col-md-6 b-b b-r">
                                            <a href="#" class="block padder-v hover">
                                                <span class="i-s i-s-2x pull-left m-r-sm">
                                                    <i class="i i-hexagon2 i-s-base text-primary hover-rotate"></i>
                                                    <i class="i i-docs i-sm text-dark"></i>
                                                </span>
                                                <span class="clear">
                                                    <span class="h4 block m-t-xs text-black"><?php echo $this->notifications->total_files_processed; ?></span>
                                                    <small class="text-muted text-u-c">Files Processed</small>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="col-md-6 b-b">
                                            <a href="#" class="block padder-v hover">
                                                <span class="i-s i-s-2x pull-left m-r-sm">
                                                    <i class="i i-hexagon2 i-s-base text-danger hover-rotate"></i>
                                                    <i class="fa fa-dollar i-sm text-dark"></i>
                                                </span>
                                                <span class="clear">
                                                    <span class="h4 block m-t-xs text-black">US $<?php echo $this->notifications->total_due; ?></span>
                                                    <small class="text-muted text-u-c">Total Due</small>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="col-md-6 b-b b-r">
                                            <a href="#" class="block padder-v hover">
                                                <span class="i-s i-s-2x pull-left m-r-sm">
                                                    <i class="i i-hexagon2 i-s-base text-warning hover-rotate"></i>
                                                    <i class="fa fa-file-text-o i-sm text-dark"></i>
                                                </span>
                                                <span class="clear">
                                                    <span class="h4 block m-t-xs text-black"><?php echo $this->notifications->count_total_quotes; ?></span>
                                                    <small class="text-muted text-u-c">Total Quotes</small>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="col-md-6 b-b">
                                            <a href="#" class="block padder-v hover">
                                                <span class="i-s i-s-2x pull-left m-r-sm">
                                                    <i class="i i-hexagon2 i-s-base text-info hover-rotate"></i>
                                                    <i class="fa fa-file-text-o i-sm text-dark"></i>
                                                </span>
                                                <span class="clear">
                                                    <span class="h4 block m-t-xs text-black"><?php echo $this->notifications->count_accepted_quotes; ?></span>
                                                    <small class="text-muted text-u-c"> QT. Accepted</small>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="col-md-6 b-b b-r">
                                            <a href="#" class="block padder-v hover">
                                                <span class="i-s i-s-2x pull-left m-r-sm">
                                                    <i class="i i-hexagon2 i-s-base text-info hover-rotate"></i>
                                                    <i class="fa fa-users i-sm text-dark"></i>
                                                </span>
                                                <span class="clear">
                                                    <span class="h4 block m-t-xs text-black"><?php echo $this->notifications->total_managers; ?></span>
                                                    <small class="text-muted text-u-c">Managers</small>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="col-md-6 b-b">
                                            <a href="#" class="block padder-v hover">
                                                <span class="i-s i-s-2x pull-left m-r-sm">
                                                    <i class="i i-hexagon2 i-s-base text-primary hover-rotate"></i>
                                                    <i class="i i-user2 i-sm text-dark"></i>
                                                </span>
                                                <span class="clear">
                                                    <span class="h4 block m-t-xs text-black">You Are</span>
                                                    <small class="text-muted text-u-c">Lovely</small>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                        <div class="col-sm-7 no-padder">
                            <div class="row m-n">    
                                <header class="panel-heading bg-light b-b">
                                    <ul class="nav nav-tabs nav-justified">
                                        <!-- <li class="active"><a href="#activities" data-toggle="tab">Activities</a></li> -->
                                        <li class="active"><a href="#edit-profile" data-toggle="tab">Edit Profile</a></li>
                                        <li class=""><a href="#email-notification" data-toggle="tab">Email Notification</a></li>
                                        <li class=""><a href="#managers" data-toggle="tab">Managers</a></li>
                                    </ul>
                                </header>
                                <section>
                                    <div class="panel-body p-sm">
                                        <div class="tab-content">
                                            <div class="tab-pane " id="activities">
                                                <section class="comment-list block">
                                                    <article id="comment-id-1" class="comment-item">
                                                        <a class="pull-left thumb-sm avatar">
                                                            <img src="<?php echo base_url(); ?>assets/images/atik-rahman.jpg" class="img-circle">
                                                        </a>
                                                        <span class="arrow left"></span>
                                                        <section class="comment-body panel panel-default">
                                                            <header class="panel-heading bg-white">
                                                                <a href="#">John smith</a>
                                                                <label class="label bg-info m-l-xs">Editor</label> 
                                                                <span class="text-muted m-l-sm pull-right">
                                                                    <i class="fa fa-clock-o"></i>
                                                                    Just now
                                                                </span>
                                                            </header>
                                                            <div class="panel-body">
                                                                <div>Lorem ipsum dolor sit amet, consecteter adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet.</div>
                                                                <div class="comment-action m-t-sm">
                                                                    <a href="#" data-toggle="class" class="btn btn-default btn-xs active">
                                                                        <i class="fa fa-star-o text-muted text"></i>
                                                                        <i class="fa fa-star text-danger text-active"></i> 
                                                                        Like
                                                                    </a>
                                                                    <a href="#comment-form" class="btn btn-default btn-xs">
                                                                        <i class="fa fa-mail-reply text-muted"></i> Reply
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </section>
                                                    </article>
                                                    <!-- .comment-reply -->
                                                    <article id="comment-id-2" class="comment-item comment-reply">
                                                        <a class="pull-left thumb-sm avatar">
                                                            <img src="<?php echo base_url(); ?>assets/images/manager2.jpg" alt="">
                                                        </a>
                                                        <span class="arrow left"></span>
                                                        <section class="comment-body panel panel-default text-sm">
                                                            <div class="panel-body">
                                                                <span class="text-muted m-l-sm pull-right">
                                                                    <i class="fa fa-clock-o"></i>
                                                                    10m ago
                                                                </span>
                                                                <a href="#">Mika Sam</a>
                                                                <label class="label bg-dark m-l-xs">Admin</label> 
                                                                Report this comment is helpful                           
                                                            </div>
                                                        </section>
                                                    </article>
                                                    <!-- / .comment-reply -->
                                                    <article id="comment-id-3" class="comment-item">
                                                        <a class="pull-left thumb-sm avatar"><img src="<?php echo base_url(); ?>assets/images/manager3.jpg"></a>
                                                        <span class="arrow left"></span>
                                                        <section class="comment-body panel panel-default">
                                                            <header class="panel-heading">                      
                                                                <a href="#">By me</a>
                                                                <label class="label bg-success m-l-xs">User</label> 
                                                                <span class="text-muted m-l-sm pull-right">
                                                                    <i class="fa fa-clock-o"></i>
                                                                    1h ago
                                                                </span>
                                                            </header>
                                                            <div class="panel-body">
                                                                <div>This comment was posted by you.</div>
                                                                <div class="comment-action m-t-sm">
                                                                    <a href="#comment-id-3" data-dismiss="alert" class="btn btn-default btn-xs">
                                                                        <i class="fa fa-trash-o text-muted"></i> 
                                                                        Remove
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </section>
                                                    </article>
                                                    <article id="comment-id-4" class="comment-item">
                                                        <a class="pull-left thumb-sm avatar"><img src="<?php echo base_url(); ?>assets/images/manager.jpg"></a>
                                                        <span class="arrow left"></span>
                                                        <section class="comment-body panel panel-default">
                                                            <header class="panel-heading">
                                                                <a href="#">Peter</a>
                                                                <label class="label bg-primary m-l-xs">Vip</label> 
                                                                <span class="text-muted m-l-sm pull-right">
                                                                    <i class="fa fa-clock-o"></i>
                                                                    2hs ago
                                                                </span>
                                                            </header>
                                                            <div class="panel-body">
                                                                <blockquote>
                                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                                                    <small>Someone famous in <cite title="Source Title">Source Title</cite></small>
                                                                </blockquote>
                                                                <div>Lorem ipsum dolor sit amet, consecteter adipiscing elit...</div>
                                                                <div class="comment-action m-t-sm">
                                                                    <a href="#" data-toggle="class" class="btn btn-default btn-xs">
                                                                        <i class="fa fa-star-o text-muted text"></i>
                                                                        <i class="fa fa-star text-danger text-active"></i> 
                                                                        Like
                                                                    </a>
                                                                    <a href="#comment-form" class="btn btn-default btn-xs"><i class="fa fa-mail-reply text-muted"></i> Reply</a>
                                                                </div>
                                                            </div>
                                                        </section>
                                                    </article>
                                                    <!-- comment form -->
                                                    <article class="comment-item media" id="comment-form"> 
                                                        <a class="pull-left thumb-sm avatar"><img src="<?php echo base_url(); ?>assets/images/manager2.jpg"></a> 
                                                        <section class="media-body"> 
                                                            <form action="" class="m-b-none"> 
                                                                <div class="input-group"> 
                                                                    <input type="text" class="form-control" placeholder="Input your comment here"> 
                                                                    <span class="input-group-btn"> 
                                                                        <button class="btn btn-primary" type="button">POST</button> 
                                                                    </span>
                                                                </div> 
                                                            </form>
                                                        </section>
                                                    </article>
                                                </section>
                                            </div>
                                            <div class="tab-pane active" id="edit-profile">
                                                <div class="col-sm-12 no-padder">
                                                    <p class="text-black lead-18 m-t-none p-t-none m-b-none p-b-none">Update Information</p>
                                                    <small class="ar-text-justify">Below are the information you have on your account</small>
                                                </div>

                                                <div class="clearfix"></div>
                                                <hr class="m-t-sm" />

                                                <form id="profile_form" onsubmit="return Portal.User.Profile.saveNew();" class="bs-example form-horizontal" name="profile_form">
                                                    <div id="profilEditMsg" class="alert alert-success hide"> <!-- Ajax Message --></div>
                                                    <div class="row form-group"> 
                                                        <div class="col-md-12">
                                                            <label>Full Name<span class="text-danger">*</span></label> 
                                                            <input type="text" class="form-control" name="fullname" value="<?php echo $profile->fullname; ?>">
                                                        </div>
                                                    </div> 
                                                    <div class="row form-group"> 
                                                        <div class="col-md-6">
                                                            <label>Company Name<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="company" value="<?php echo $profile->company; ?>">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Position</label>
                                                            <input type="text" class="form-control" name="designation" value="<?php echo $profile->designation; ?>">
                                                        </div>
                                                    </div> 
                                                    <div class="row form-group"> 
                                                        <div class="col-md-6">
                                                            <label>Email<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="email" value="<?php echo $profile->email; ?>">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Phone<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="phone" value="<?php echo $profile->phone; ?>" placeholder="Phone">
                                                        </div>
                                                    </div> 
                                                    <div class="row form-group"> 
                                                        <div class="col-md-6">
                                                            <label>Address Line 1<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="address1" value="<?php echo $company->address1; ?>">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Address Line 2</label>
                                                            <input type="text" class="form-control" name="address2" value="<?php echo $company->address2; ?>">
                                                        </div>
                                                    </div> 
                                                    <div class="row form-group"> 
                                                        <div class="col-md-6">
                                                            <label>City<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="city" value="<?php echo $company->city; ?>">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Zip/Postal Code<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="postal_code" value="<?php echo $company->postal_code; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row form-group"> 
                                                        <div class="col-md-6">
                                                            <label>Country</label>
                                                            <input type="text" class="form-control" name="country" value="<?php echo country_name($profile->country); ?>" readonly>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>VAT ID</label>
                                                            <input type="text" class="form-control" name="vat_id" value="<?php echo $company->vat_id; ?>">
                                                        </div>
                                                    </div> 
                                                    <div class="row form-group"> 
                                                        <div class="col-md-6">
                                                            <label>Website</label>
                                                            <input type="text" class="form-control" name="website" value="<?php echo $company->website; ?>">
                                                        </div>
                                                        <div class="col-md-6 text-right">
                                                            <label>&nbsp;</label>
                                                            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-spinner fa-spin ajax-loading" style="display:none;"></i> Update Profile</button>
                                                        </div>
                                                    </div> 
                                                    <div class="row form-group"> 
                                                    </div> 
                                                </form>
                                            </div>
                                            <div class="tab-pane" id="email-notification">
                                                <form id="notification_form" onsubmit="return Portal.User.Settings.saveNotify();" class="bs-example form-horizontal" name="notification_form">
                                                    <div class="col-sm-12 no-padder">
                                                        <p class="text-black lead-18 m-t-none p-t-none m-b-none p-b-none">Notification Settings</p>
                                                        <small class="ar-text-justify">You will receive the every notificaiton via email as checked below. Please un-check if you do not wish to receive notification via email. You will still be able to see all the notifications on your dashboard.</small>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <hr class="m-t-sm" />
                                                    <div class="col-sm-12 b-a p-t-xs p-b-xs p-l-sm p-r-sm r inline m-b-sm">
                                                        <div class="col-md-6 col-sm-6 no-padder">
                                                            <div class="lead-14">Profile Changes Notification</div>
                                                            <!-- <small class="text-muted">Description</small> -->
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 no-padder ar-text-right">
                                                            <span class="msg">

                                                            </span>
                                                        </div>
                                                        <div class="col-md-2 col-sm-2 no-padder ar-text-right">
                                                            <!--<input type="checkbox" name="profile-notification" class="form-control" checked="checked">-->
                                                            <button class="btn btn-xs btn-default <?php echo (isset($settings[NOTIFY_PROFILE_UPDATE])) ? ($settings[NOTIFY_PROFILE_UPDATE] == '1' ? '' : 'active') : 'active' ?> emailNotification" data-toggle="button" data-title="<?php echo NOTIFY_PROFILE_UPDATE; ?>"> 
                                                                <span class="text">
                                                                    <i class="fa fa-circle-o text-dark"></i> OFF
                                                                </span> 
                                                                <span class="text-active">
                                                                    <i class="fa fa-circle text-info"></i> ON 
                                                                </span> 
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="col-sm-12 b-a p-t-xs p-b-xs p-l-sm p-r-sm r inline m-b-sm">
                                                        <div class="col-md-6 col-sm-6 no-padder">
                                                            <div class="lead-14">New Message from Admin</div>
                                                            <!-- <small class="text-muted">You will receive an order confirmation as soon as you place an order.</small> -->
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 no-padder ar-text-right">
                                                            <span class="msg">

                                                            </span>
                                                        </div>
                                                        <div class="col-md-2 col-sm-2 no-padder ar-text-right">
                                                            <button class="btn btn-xs btn-default  emailNotification <?php echo (isset($settings[NOTIFY_ADMIN_MESSAGE])) ? ($settings[NOTIFY_ADMIN_MESSAGE] == '1' ? '' : 'active') : 'active' ?>" href="#btn-1" data-title="<?php echo NOTIFY_ADMIN_MESSAGE; ?>" data-toggle="button"> 
                                                                <span class="text"><i class="fa fa-circle-o text-dark"></i> OFF</span> 
                                                                <span class="text-active"><i class="fa fa-circle text-info"></i> ON </span> 
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="col-sm-12 b-a p-t-xs p-b-xs p-l-sm p-r-sm r inline m-b-sm">
                                                        <div class="col-md-6 col-sm-6 no-padder">
                                                            <div class="lead-14">New Message from Manager</div>
                                                            <!-- <small class="text-muted">You will receive an order confirmation as soon as you place an order.</small> -->
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 no-padder ar-text-right">
                                                            <span class="msg">

                                                            </span>
                                                        </div>
                                                        <div class="col-md-2 col-sm-2 no-padder ar-text-right">
                                                            <button class="btn btn-xs btn-default  emailNotification <?php echo (isset($settings[NOTIFY_MANAGER_MESSAGE])) ? ($settings[NOTIFY_MANAGER_MESSAGE] == '1' ? '' : 'active') : 'active' ?>" href="#btn-1" data-title="<?php echo NOTIFY_MANAGER_MESSAGE; ?>" data-toggle="button"> 
                                                                <span class="text"><i class="fa fa-circle-o text-dark"></i> OFF</span> 
                                                                <span class="text-active"><i class="fa fa-circle text-info"></i> ON </span> 
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="col-sm-12 b-a p-t-xs p-b-xs p-l-sm p-r-sm r inline m-b-sm">
                                                        <div class="col-md-6 col-sm-6 no-padder">
                                                            <div class="lead-14">Order Confirmation</div>
                                                            <!-- <small class="text-muted">You will receive an order confirmation as soon as you place an order.</small> -->
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 no-padder ar-text-right">
                                                            <span class="msg">

                                                            </span>
                                                        </div>

                                                        <div class="col-md-2 col-sm-2 no-padder ar-text-right">
                                                            <button class="btn btn-xs btn-default  emailNotification <?php echo (isset($settings[NOTIFY_ORDER_CONFIRM])) ? ($settings[NOTIFY_ORDER_CONFIRM] == '1' ? '' : 'active') : 'active' ?>" href="#btn-1" data-title="<?php echo NOTIFY_ORDER_CONFIRM; ?>" data-toggle="button"> 
                                                                <span class="text"><i class="fa fa-circle-o text-dark"></i> OFF</span> 
                                                                <span class="text-active"><i class="fa fa-circle text-info"></i> ON </span> 
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="col-sm-12 b-a p-t-xs p-b-xs p-l-sm p-r-sm r inline m-b-sm">
                                                        <div class="col-md-6 col-sm-6 no-padder">
                                                            <div class="lead-14">Order Status Updates</div>
                                                            <!-- <small class="text-muted">You will receive an order confirmation as soon as you place an order.</small> -->
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 no-padder ar-text-right">
                                                            <span class="msg">

                                                            </span>
                                                        </div>
                                                        <div class="col-md-2 col-sm-2 no-padder ar-text-right">
                                                            <button class="btn btn-xs btn-default  emailNotification <?php echo (isset($settings[NOTIFY_ORDER_STATUS])) ? ($settings[NOTIFY_ORDER_STATUS] == '1' ? '' : 'active') : 'active' ?>" href="#btn-1" data-title="<?php echo NOTIFY_ORDER_STATUS ?>" data-toggle="button"> 
                                                                <span class="text"><i class="fa fa-circle-o text-dark"></i> OFF</span> 
                                                                <span class="text-active"><i class="fa fa-circle text-info"></i> ON </span> 
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="col-sm-12 b-a p-t-xs p-b-xs p-l-sm p-r-sm r inline m-b-sm">
                                                        <div class="col-md-6 col-sm-6 no-padder">
                                                            <div class="lead-14">Order Delivery Confirmation</div>
                                                            <!-- <small class="text-muted">You will receive an order confirmation as soon as you place an order.</small> -->
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 no-padder ar-text-right">
                                                            <span class="msg">

                                                            </span>
                                                        </div>
                                                        <div class="col-md-2 col-sm-2 no-padder ar-text-right">
                                                            <button class="btn btn-xs btn-default  emailNotification <?php echo (isset($settings[NOTIFY_ORDER_DELIVERY])) ? ($settings[NOTIFY_ORDER_DELIVERY] == '1' ? '' : 'active') : 'active' ?>" href="#btn-1" data-title="<?php echo NOTIFY_ORDER_DELIVERY; ?>" data-toggle="button"> 
                                                                <span class="text"><i class="fa fa-circle-o text-dark"></i> OFF</span> 
                                                                <span class="text-active"><i class="fa fa-circle text-info"></i> ON </span> 
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="col-sm-12 b-a p-t-xs p-b-xs p-l-sm p-r-sm r inline m-b-sm">
                                                        <div class="col-md-6 col-sm-6 no-padder">
                                                            <div class="lead-14">Quote Confirmation</div>
                                                            <!-- <small class="text-muted">You will receive an order confirmation as soon as you place an order.</small> -->
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 no-padder ar-text-right">
                                                            <span class="msg">

                                                            </span>
                                                        </div>
                                                        <div class="col-md-2 col-sm-2 no-padder ar-text-right">
                                                            <button class="btn btn-xs btn-default  emailNotification <?php echo (isset($settings[NOTIFY_QUOTE_CONFIRM])) ? ($settings[NOTIFY_QUOTE_CONFIRM] == '1' ? '' : 'active') : 'active' ?>" href="#btn-1" data-title="<?php echo NOTIFY_QUOTE_CONFIRM; ?>" data-toggle="button"> 
                                                                <span class="text"><i class="fa fa-circle-o text-dark"></i> OFF</span> 
                                                                <span class="text-active"><i class="fa fa-circle text-info"></i> ON </span> 
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="col-sm-12 b-a p-t-xs p-b-xs p-l-sm p-r-sm r inline m-b-sm">
                                                        <div class="col-md-6 col-sm-6 no-padder">
                                                            <div class="lead-14">Quote Review Confirmation</div>
                                                            <!-- <small class="text-muted">You will receive an order confirmation as soon as you place an order.</small> -->
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 no-padder ar-text-right">
                                                            <span class="msg">

                                                            </span>
                                                        </div>
                                                        <div class="col-md-2 col-sm-2 no-padder ar-text-right">
                                                            <button class="btn btn-xs btn-default  emailNotification <?php echo (isset($settings[NOTIFY_QUOTE_REVIEWED])) ? ($settings[NOTIFY_QUOTE_REVIEWED] == '1' ? '' : 'active') : 'active' ?>" href="#btn-1" data-title="<?php echo NOTIFY_QUOTE_REVIEWED; ?>" data-toggle="button"> 
                                                                <span class="text"><i class="fa fa-circle-o text-dark"></i> OFF</span> 
                                                                <span class="text-active"><i class="fa fa-circle text-info"></i> ON </span> 
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="col-sm-12 b-a p-t-xs p-b-xs p-l-sm p-r-sm r inline m-b-sm">
                                                        <div class="col-md-6 col-sm-6 no-padder">
                                                            <div class="lead-14">Quote Accepted Confirmation</div>
                                                            <!-- <small class="text-muted">You will receive an order confirmation as soon as you place an order.</small> -->
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 no-padder ar-text-right">
                                                            <span class="msg">

                                                            </span>
                                                        </div>
                                                        <div class="col-md-2 col-sm-2 no-padder ar-text-right">
                                                            <button class="btn btn-xs btn-default  emailNotification <?php echo (isset($settings[NOTIFY_QUOTE_ACCEPT])) ? ($settings[NOTIFY_QUOTE_ACCEPT] == '1' ? '' : 'active') : 'active' ?>" href="#btn-1" data-title="<?php echo NOTIFY_QUOTE_ACCEPT; ?>" data-toggle="button"> 
                                                                <span class="text"><i class="fa fa-circle-o text-dark"></i> OFF</span> 
                                                                <span class="text-active"><i class="fa fa-circle text-info"></i> ON </span> 
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="col-sm-12 b-a p-t-xs p-b-xs p-l-sm p-r-sm r inline m-b-sm">
                                                        <div class="col-md-6 col-sm-6 no-padder">
                                                            <div class="lead-14">Quote Rejected Confirmation</div>
                                                            <!-- <small class="text-muted">You will receive an order confirmation as soon as you place an order.</small> -->
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 no-padder ar-text-right">
                                                            <span class="msg">

                                                            </span>
                                                        </div>
                                                        <div class="col-md-2 col-sm-2 no-padder ar-text-right">
                                                            <button class="btn btn-xs btn-default  emailNotification <?php echo (isset($settings[NOTIFY_QUOTE_REJECT])) ? ($settings[NOTIFY_QUOTE_REJECT] == '1' ? '' : 'active') : 'active' ?>" href="#btn-1" data-title="<?php echo NOTIFY_QUOTE_REJECT; ?>" data-toggle="button"> 
                                                                <span class="text"><i class="fa fa-circle-o text-dark"></i> OFF</span> 
                                                                <span class="text-active"><i class="fa fa-circle text-info"></i> ON </span> 
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="col-sm-12 b-a p-t-xs p-b-xs p-l-sm p-r-sm r inline m-b-sm">
                                                        <div class="col-md-6 col-sm-6 no-padder">
                                                            <div class="lead-14">Managers Updates</div>
                                                            <!-- <small class="text-muted">You will receive an order confirmation as soon as you place an order.</small> -->
                                                        </div>
                                                        <div class="col-md-4 col-sm-4  no-padder ar-text-right">
                                                            <span class="msg">

                                                            </span>
                                                        </div>
                                                        <div class="col-md-2 col-sm-2 no-padder ar-text-right">
                                                            <button class="btn btn-xs btn-default  emailNotification <?php echo (isset($settings[NOTIFY_MANAGER_UPDATES])) ? ($settings[NOTIFY_MANAGER_UPDATES] == '1' ? '' : 'active') : 'active' ?>" href="#btn-1" data-title="<?php echo NOTIFY_MANAGER_UPDATES; ?>" data-toggle="button"> 
                                                                <span class="text"><i class="fa fa-circle-o text-dark"></i> OFF</span> 
                                                                <span class="text-active"><i class="fa fa-circle text-info"></i> ON </span> 
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="col-sm-12 b-a p-t-xs p-b-xs p-l-sm p-r-sm r inline m-b-sm">
                                                        <div class=" col-md-6 col-sm-6 no-padder">
                                                            <div class="lead-14">Billing &amp; Payments</div>
                                                            <!-- <small class="text-muted">You will receive an order confirmation as soon as you place an order.</small> -->
                                                        </div>
                                                        <div class="col-md-4 col-sm-4  no-padder ar-text-right">
                                                            <span class="msg">

                                                            </span>
                                                        </div>
                                                        <div class="col-md-2 col-sm-2 no-padder ar-text-right">
                                                            <button class="btn btn-xs btn-default  emailNotification active disabled<?php //echo isset($settings[NOTIFY_BILLING_PAYMENT]) ? $settings[NOTIFY_BILLING_PAYMENT] == '1' ? '' : 'active' : 'active'  ?>" data-title="<?php echo NOTIFY_BILLING_PAYMENT; ?>" href="#btn-1" data-toggle="button"> 
                                                                <span class="text"><i class="fa fa-circle-o text-dark"></i> OFF</span> 
                                                                <span class="text-active"><i class="fa fa-circle text-info"></i> ON </span> 
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="col-sm-12 b-a p-t-xs p-b-xs p-l-sm p-r-sm r inline m-b-sm">
                                                        <div class="col-md-6 col-sm-6  no-padder">
                                                            <div class="lead-14">Monthly Newsletter</div>
                                                            <!-- <small class="text-muted">You will receive an order confirmation as soon as you place an order.</small> -->
                                                        </div>
                                                        <div class="col-md-4 col-sm-4  no-padder ar-text-right">
                                                            <span class="msg">

                                                            </span>
                                                        </div>
                                                        <div class="col-md-2 col-sm-2  no-padder ar-text-right">
                                                            <button class="btn btn-xs btn-default  emailNotification disabled <?php echo isset($settings[NEWSLETTER]) ? $settings[NEWSLETTER] == '1' ? '' : 'active' : 'active' ?>" href="#btn-1" data-title="<?php echo NEWSLETTER; ?>" data-toggle="button" data-status=""> 
                                                                <span class="text"><i class="fa fa-circle-o text-dark"></i> OFF</span> 
                                                                <span class="text-active"><i class="fa fa-circle text-info"></i> ON </span> 
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane" id="managers">
                                                <div class="manager-box">
                                                    <div class="col-sm-8 no-padder"><p class="text-black lead-18 m-t-none p-t-none m-b-none p-b-none">Managers List</p>
                                                        <small>You can add managers who will be able to manage your account / place an order on behalf of you.</small></div>
                                                    <div class="col-sm-4 no-padder ar-text-right"><a href="<?php echo site_url('/ajax/invite_user/'); ?>" data-toggle="ajaxModal" class="btn btn-md btn-dark m-t-xs"> <i class="fa fa-plus"></i> Add New Manager</a></div>
                                                    <div class="clearfix"></div>
                                                    <hr class="m-t-sm" />

                                                    <?php if (count($company_members) > 0 && !empty($company_members)) { ?>
                                                        <div class="col-lg-12 ar-text-left no-padder">
                                                            <?php foreach ($company_members as $members_value) { ?>
                                                                <div class="col-lg-4 user_<?php echo $members_value->id; ?>">
                                                                    <section class="panel panel-default"> 
                                                                        <header class="panel-heading bg-light dk no-border"> 
                                                                            <div class="clearfix"> 
                                                                                <a href="#" class="pull-left thumb avatar b-2x b b-white m-r">
                                                                                    <?php if (!empty($members_value->avatar)): ?>
                                                                                        <img src="/assets/avatar/<?php echo $members_value->avatar; ?>" class="">
                                                                                    <?php else: ?>
                                                                                        <?php $gravatar_url = 'http://www.gravatar.com/avatar/' . md5($members_value->email); ?>
                                                                                        <img src="<?php echo $gravatar_url; ?>" alt="">
                                                                                    <?php endif ?></a> 
                                                                                <div class="clear"> 
                                                                                    <div class="lead-14 font-bold m-t-xs m-b-n-xs"><?php echo (!empty($members_value->fullname)) ? $members_value->fullname : ''; ?> 
                                                                                    </div> 
                                                                                    <small class="text-muted"><?php echo (!empty($members_value->email)) ? $members_value->email : ''; ?></small> 
                                                                                </div> 
                                                                                <div class="action">Pause</div>
                                                                            </div> 
                                                                        </header> 
                                                                        <div class="list-group no-radius"> 
                                                                            <a class="list-group-item" href="<?php echo site_url('/ajax/permission_user/'); ?>/<?php echo $members_value->id; ?>" data-toggle="ajaxModal"><span class="pull-right text-info"><i class="fa fa-cog lead-14"></i></span>Set Permission </a>
                                                                            <a class="list-group-item" href="<?php echo site_url('/ajax/message_send/'); ?>/<?php echo $members_value->id ?>" data-toggle="ajaxModal"><span class="pull-right text-dark"><i class="fa fa-envelope-o"></i></span>Send Message </a> 
                                                                            <a class="list-group-item" href="<?php echo site_url('/ajax/user_remove/'); ?>/<?php echo $members_value->id ?>" data-toggle="ajaxModal"><span class="pull-right text-danger"><i class="fa fa-trash-o lead-16"></i></span>Delete Manager </a> 
                                                                        </div> 
                                                                    </section>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    <?php } ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </section>
            </section>
        </section>
    </section>
</section>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        // Portal.PageInit.Profile();

        Dropzone.options.fileUpload = {
            init: function () {
                this.on("addedfile", function (file) {
                    $(".dropzone").css('opacity', '1');
                });

                this.on("success", function (file, response) {
                    // window.location = document.URL;
                    $(".my_avatar").attr("src", base_url + 'assets/timthumb.php?src=avatar/' + response.filename + '&h=140&w=140');
                    $(".dker").attr("src", base_url + 'assets/timthumb.php?src=avatar/' + response.filename + '&h=140&w=140');
                    $(".dz-error-message").css('opacity', '0');
                });

                this.on("removedfile", function (file) {
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
    $(document).ready(function () {
        $('.emailNotification').on('click', function () {
            $('.msg').show().html('');
            var settings_name = $(this).data('title'),
                    settings_value = $(this).hasClass('active') ? '1' : '0',
                    btnEvents = $(this);
            $.ajax({
                url: '/ajax/set_email_notification',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    name: settings_name,
                    value: settings_value,
                },
                beforeSend: function (xhr) {
                    $('.btn').addClass('disabled');
                    setTimeout(function () {
                        $('.btn').removeClass('disabled');
                    }, 4000);
                    btnEvents.parent().prev().find('.msg').removeClass('text-danger').addClass('text-success').show().html('<i class="fa fa-spinner fa-spin"></i> Processing. Please wait...');
                },
                complete: function (jqXHR, textStatus) {

                },
                success: function (data, textStatus, jqXHR) {
                    setTimeout(function () {
                        if (data.status === 'OK') {

                            if (data.value === '1') {
//                            btnEvents.removeClass('active');
                                btnEvents.parent().prev().find('.msg').removeClass('text-danger').addClass('text-success').show().html('<i class="fa fa-check-square"></i> Success! ' + data.msg);
                            } else {

                                btnEvents.parent().prev().find('.msg').removeClass('text-danger').addClass('text-success').show().html('<i class="fa fa-check-square"></i> Success! ' + data.msg);
                            }
                        } else {
                            btnEvents.parent().prev().find('.msg').removeClass('text-success').addClass('text-danger').show().html('<i class="fa fa-check-square"></i> Success! ' + data.msg);
                        }
                    }, 3000);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    btnEvents.parent().prev().find('.msg').addClass('text-danger').removeClass('text-success').html('<i class="fa fa-warning"></i> Network error! Please try again.');
                }
            });

        });
    });

</script>
