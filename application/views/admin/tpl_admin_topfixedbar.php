<header class="bg-white header header-md navbar navbar-fixed-top-xs box-shadow">
    <div class="navbar-header bg-light aside-md">
        <a data-target="#nav" data-toggle="class:nav-off-screen" class="btn btn-link visible-xs">
            <i class="fa fa-bars"></i>
        </a>
        <a class="navbar-brand" href="<?php echo site_url('/admin/');?>">
            <img alt="Cut Out Image" class="m-r-sm" src="<?php echo base_url();?>assets/images/logo.svg">
            <!-- <span class="hidden-nav-xs">Cut Out Image</span> -->
        </a>
        <a data-target=".user" data-toggle="dropdown" class="btn btn-link visible-xs">
            <i class="fa fa-cog"></i>
        </a>
    </div>

    <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user user">
        <li class="hidden-xs">
            <a data-toggle="dropdown" class="dropdown-toggle bg-light" href="#">
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
        <li class="dropdown r-c-s-nav">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <span class="thumb avatar pull-left">
                    <!-- <img alt="..." src="<?php echo avatar();?>"> -->
                    <img src="<?php echo base_url(); ?>assets/images/atik-rahman.jpg">
                </span>
                <strong class="font-bold text-lt"><?php echo (isset($profile->fullname)) ? $profile->fullname : 'Atik Rahman';?></strong> <b class="caret"></b>
            </a>
            <ul class="dropdown-menu animated fadeInRight">
                <li>
                    <span class="arrow top hidden-nav-xs"></span>
                    <a href="<?php echo site_url('admin/profile');?>"><i class="i i-user3"></i> My Profile</a>
                </li>
                <li>
                    <a href="<?php echo site_url('admin/settings');?>"><i class="i i-cog2"></i> System Settings</a>
                </li>
                <li class="divider"></li>
                <li>
                   <a href="<?php echo site_url('/auth/change_password');?>"><i class="fa fa-key"></i> Change Password</a>
                </li>
                <li>
                    <a href="<?php echo site_url('auth/logout');?>"><i class="i i-logout"></i> Logout</a>
                </li>
            </ul>
        </li>
    </ul>      
</header>