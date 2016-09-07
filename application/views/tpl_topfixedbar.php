<header class="bg-white header header-md navbar navbar-fixed-top-xs box-shadow">
    <div class="navbar-header bg-light aside-md">
        <a data-target="#nav" data-toggle="class:nav-off-screen" class="btn btn-link visible-xs">
            <i class="fa fa-bars"></i>
        </a>
        <a class="navbar-brand" href="<?php echo site_url();?>">
            <img alt="Cut Out Image" class="m-r-sm" src="<?php echo base_url();?>assets/images/logo.svg">
            <!-- <span class="hidden-nav-xs">Cut Out Image</span> -->
            <span class="version">Beta</span>
        </a>
        <a data-target=".user" data-toggle="dropdown" class="btn btn-link visible-xs">
            <i class="fa fa-cog"></i>
        </a>
    </div>
    <ul class="nav navbar-nav hidden-xs">
        <!-- <li class="dropdown <?php echo ($this->uri->segment(1) == 'support')? 'ar-bg-gray':'';?>" data-toggle="tooltip" data-placement="right" title="" data-original-title="Support">
            <a class="dropdown-toggle" href="<?php echo site_url('/support');?>">
                <i class="i i-support text-primary-lt" style="font-size:16px;"></i>
            </a>
        </li> -->


        <li class="hidden-xs hide"> 
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
            <i class="fa fa-bell text-dark" style="font-size: 16px;"></i> 
            <span class="badge badge-sm up bg-warning count" style="display: inline-block;">3</span> </a> 
                <section class="dropdown-menu aside-xl animated flipInY"> 
                    <section class="panel bg-white"> 
                        <div class="panel-heading b-light bg-light"><strong>You have <span class="count" style="display: inline;">0</span> notifications</strong> </div> 
                        
                        <div class="list-group list-group-alt">
                            <a href="#" class="media list-group-item" style="display: block;"><span class="pull-left thumb-sm text-center"><i class="fa fa-envelope-o fa-2x text-success"></i></span><span class="media-body block m-b-none">Order #000148-48 is ready to download<br><small class="text-muted">1 minutes ago</small></span></a> 
                            <a href="#" class="media list-group-item"> <span class="pull-left thumb-sm"> <img src="https://www.cutoutimage.com/img/logo-opacity-dark.png" alt="..." class="img-circle"> </span> <span class="media-body block m-b-none"> You have paid due invoices<br> <small class="text-muted">10 minutes ago</small> </span> </a> 
                            <a href="#" class="media list-group-item"> <span class="media-body block m-b-none"> New Features: 2CO payment method added..<br> <small class="text-muted">2 days ago</small> </span> </a> 
                        </div> 
                        <div class="panel-footer text-sm"> 
                            <a href="#" class="pull-right"><i class="fa fa-cog"></i></a> 
                            <a href="#notes" data-toggle="class:show animated fadeInRight">See All Notifications</a> 
                        </div> 
                    </section> 
                </section> 
        </li>
        <li class="dropdown <?php echo ($this->uri->segment(1) == 'report_bug')? 'ar-bg-gray':'';?>" data-toggle="tooltip" data-placement="right" title="" data-original-title="Report Bug">
            <a class="dropdown-toggle" href="<?php echo site_url('/report_bug');?>">
                <i class="fa fa-bug text-danger-lt" style="font-size: 18px;"></i>
            </a>
        </li>
        <li class="dropdown" data-toggle="tooltip" data-placement="right" title="" data-original-title="Start Chatting">
            <a class="dropdown-toggle" href="javascript:void(0)" onclick="Intercom('show');">
                <i class="fa fa-comments text-primary font-bold" style="font-size: 18px;"></i>
            </a>
        </li>
        <li class="dropdown" data-toggle="tooltip" data-placement="right" title="" data-original-title="Click To Call">
            <a class="dropdown-toggle ac-c2c-event" href="#">
                <i class="fa fa-phone text-success-lt font-bold" style="font-size: 18px;"></i>
            </a>
        </li> 
    </ul>

    <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user user">
        <?php
        /*
        <li class="hidden-xs hide">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <i class="fa fa-bell"></i>
                <span class="badge badge-sm up bg-danger count" style="display: inline-block;">3</span>
            </a>
            <section class="dropdown-menu aside-xl animated flipInY">
                <section class="panel bg-white">
                    <div class="panel-heading b-light bg-light">
                        <strong>You have <span class="count" style="display: inline;">3</span> notifications</strong>
                    </div>
                    <div class="list-group list-group-alt"><a class="media list-group-item" href="#" style="display: block;"><span class="pull-left thumb-sm text-center"><i class="fa fa-envelope-o fa-2x text-success"></i></span><span class="media-body block m-b-none">Sophi sent you a email<br><small class="text-muted">1 minutes ago</small></span></a>
                        <a class="media list-group-item" href="#">
                            <span class="pull-left thumb-sm">
                                <img class="img-circle" alt="..." src="<?php echo base_url();?>assets/images/avatar.png">
                            </span>
                            <span class="media-body block m-b-none">
                                Use awesome animate.css<br>
                                <small class="text-muted">10 minutes ago</small>
                            </span>
                        </a>
                        <a class="media list-group-item" href="#">
                            <span class="media-body block m-b-none">
                                1.0 initial released<br>
                                <small class="text-muted">1 hour ago</small>
                            </span>
                        </a>
                    </div>
                    <div class="panel-footer text-sm">
                        <a title="" data-placement="left" data-toggle="tooltip" class="pull-right" href="<?php echo site_url('profile_settings');?>" data-original-title="Notification Setting"><i class="fa fa-cog"></i></a>
                        <a data-toggle="class:show animated fadeInRight" href="<?php echo site_url('notifications');?>">See all the notifications</a>
                    </div>
                </section>
            </section>
        </li>
        */
        ?>

        <li class="dropdown hide">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <strong class="font-bold text-lt">Credit: </strong> <b class="caret"></b>
            </a>
            <ul class="dropdown-menu animated fadeInRight">
                <li>
                    <a href="<?php echo site_url('/profile');?>">Add Fund</a>
                </li>
                <li>
                    <a href="<?php echo site_url('/profile');?>">Withdraw Fund</a>
                </li>
            </ul>
        </li>

        <li class="b-r b-light dropdown hide">
            <a class="p-t-sm p-b-sm p-l-md lead-16 dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-dollar"></i> Credit <i class="fa fa-chevron-right text-dark lead-14"></i> <span class="text-info">US $124.50</span> 
            </a>
            <ul class="dropdown-menu animated fadeInRight">
                <li>
                    <span class="arrow top"></span>
                    <a data-toggle="ajaxModal" href="<?php echo site_url('ajax/add_fund'); ?>"> Add Funds</a>
                </li>
                <li>
                    <a data-toggle="ajaxModal" href="<?php echo site_url('ajax/withdraw_fund'); ?>"> Withdraw Funds</a>
                </li> 
                <li>
                    <a data-toggle="ajaxModal" href="<?php echo site_url('ajax/why_credit'); ?>"> What's This?</a>
                </li>
            </ul>
        </li>
        <li class="ar-text-center p-t-sm p-b-sm p-l-md p-r-md" style="border-right: 1px dashed #21dee1;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Your Local Time">
                <div id="mytime" class="h4 text-black font-bold"><span id="l_hours">00</span><span id="point">:</span><span id="l_min">00</span></div>
                <small class="text-muted">Your Time</small> 
        </li>
        <li class="ar-text-center p-t-sm p-b-sm p-l-md p-r-md" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Our Local Time">
                <div id="remote_time" data-time="<?php echo (time() * 1000);?>" class="h4 text-danger font-bold"><span id="r_hours">00</span><span id="point">:</span><span id="r_min">00</span></div>
                <small class="text-muted">Our Time</small>
        </li>

        <!-- 
        <li class="dropdown <?php echo ($this->uri->segment(1) == 'account_manager')? 'ar-bg-gray':'bg-light';?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Manage Team">
            <a class="dropdown-toggle" href="<?php echo site_url('/account_manager');?>">
                <i class="fa fa-users text-info-dk" style="font-size: 18px;"></i>
            </a>
        </li>
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <strong class="font-bold text-lt">Joint Accounts</strong> <b class="caret"></b>
            </a>
            <ul class="dropdown-menu animated fadeInRight">            
                <?php if(count($this->companies) > 0) : foreach ($this->companies as $company) : ?>
                    <li class="<?php echo ($company->id == $this->company->id) ? 'active' : '';?>">
                        <span class="arrow top"></span>
                        <a href="javascript:void(0)" onclick="Portal.User.Company.setActive(this, <?php echo $company->id;?>);"><?php echo $company->name;?><?php echo ($company->user_id == $this->user_id) ? ' <small>(Owner)</small>' : '';?></a>
                    </li>
                <?php endforeach; else: ?>
                    <li class="<?php echo ($company->id == $this->company->id) ? 'active' : '';?>">
                        <span class="arrow top"></span>
                        <a href="javascript:void(0)" onclick="Portal.User.Company.setActive(this, <?php echo $company->id;?>);"><?php echo $company->name;?></a>
                    </li>
                <?php endif; ?>

            </ul>
        </li> 
        -->

        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle bg-light" style="padding:19px 10px;" href="#">
                <i class="fa fa-building-o text-black" style="font-size:20px;"></i>
                <b class="caret text-muted"></b>
            </a>
            <ul class="dropdown-menu animated fadeInRight">
                <li class="p-l p-b-n-sm font-bold text-dark">
                    <span class="arrow top"></span>
                    Switch Company
                </li>
                <li class="divider"></li>

                <?php if(count($this->companies) > 0) : foreach ($this->companies as $company) : ?>
                    <li class="<?php echo ($company->id == $this->company->id) ? 'bg-info' : ' ';?>">
                        <a href="javascript:void(0)" onclick="Portal.User.Company.setActive(this, <?php echo $company->id;?>);"><i class="fa <?php echo ($company->id == $this->company->id) ? 'fa-dot-circle-o' : 'fa-circle-o';?>"></i> <?php echo $company->name;?><?php echo ($company->user_id == $this->user_id) ? ' <small>(You)</small>' : ' (Manager)';?></a>
                    </li>
                <?php endforeach; else: ?>
                    <li class="<?php echo ($company->id == $this->company->id) ? 'bg-info' : ' ';?>">
                        <span class="arrow top"></span>
                        <a href="javascript:void(0)" onclick="Portal.User.Company.setActive(this, <?php echo $company->id;?>);"><i class="fa fa-circle-o"></i> <?php echo $company->name;?></a>
                    </li>
                <?php endif; ?>
                <li class="divider"></li>

            </ul>
        </li> 
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <span class="thumb avatar pull-left">
                    <?php $gravatar_url = 'https://www.gravatar.com/avatar/'.md5($profile->email).'?s=40'; ?>
                    <?php if (!empty($profile->avatar)): ?>
                        <img src="<?php echo $this->avatar;?>" class="dker">
                    <?php else: ?>
                        <img src="<?php echo $gravatar_url;?>" class="dker">
                    <?php endif ?>
                    <!-- <img class="my_avatar" alt="..." src="<?php echo $this->avatar;?>"> -->
                </span>
                <strong class="font-bold text-lt"><?php echo (isset($profile->fullname)) ? $profile->fullname : '';?></strong> <b class="caret"></b>
            </a>
            <ul class="dropdown-menu animated fadeInRight">
                <li>
                    <span class="arrow top"></span>
                    <a href="<?php echo site_url('/profile');?>">My Account</a>
                </li>   
                <li>
                    <span class="arrow top"></span>
                    <a href="<?php echo site_url('/profile#managers');?>">Manage Team</a>
                </li> 

                <li class="divider"></li> 
                <li>
                    <a href="<?php echo site_url('/message');?>">
                        <?php echo ($this->notifications->unread_messages > 1) ? "Messages" : "Support Messages";?>
                        <span class="badge bg-danger pull-right <?php echo ($this->notifications->unread_messages < 1) ? 'hide':'';?>"><?php echo $this->notifications->unread_messages;?></span> 
                    </a>
                </li>
                <li class="divider"></li>
                <!--  
                <li class="p-l p-t p-b-n-sm font-bold text-success">
                    Switch Account
                </li>
                <li class="divider"></li>

                <?php if(count($this->companies) > 0) : foreach ($this->companies as $company) : ?>
                    <li class="<?php echo ($company->id == $this->company->id) ? 'bg-info media-xl-ar' : ' ';?>">
                        <a href="javascript:void(0)" onclick="Portal.User.Company.setActive(this, <?php echo $company->id;?>);"><?php echo $company->name;?><?php echo ($company->user_id == $this->user_id) ? ' <small>(Owner)</small>' : '';?></a>
                    </li>
                <?php endforeach; else: ?>
                    <li class="<?php echo ($company->id == $this->company->id) ? 'bg-info' : ' ';?>">
                        <span class="arrow top"></span>
                        <a href="javascript:void(0)" onclick="Portal.User.Company.setActive(this, <?php echo $company->id;?>);"><?php echo $company->name;?></a>
                    </li>
                <?php endif; ?>

                <li class="divider"></li> 
                -->
                <li>
                   <a href="<?php echo site_url('/auth/change_password');?>"><i class="fa fa-key"></i> Change Password</a>
                </li>
                <li>
                    <a data-toggle="ajaxModal" href="<?php echo site_url('/auth/lock');?>" class="logout"><i class="i i-logout"></i> Logout</a>
                </li>
            </ul>
        </li>
    </ul>      
</header>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        // Portal.PageInit.Dashboard();
        // Portal.Order.LoadOrderTable(8);
    });
</script>