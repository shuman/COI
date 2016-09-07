<!-- .aside -->
<aside class="bg-black aside-md hidden-print" id="nav" ng-controller="mainNav">          
    <section class="vbox">
        <section class="w-f scrollable">
            <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px" data-railOpacity="0.2">
                <!-- nav -->                 
                <nav class="nav-primary hidden-xs">
                    <div class="wrapper hidden-nav-xs m-t-md m-b-md">
                        <!-- <a href="<?php echo site_url('/place_order');?>" class="btn btn-info dker btn-block"><i class="fa fa-mail-forward pull-left"></i> <?php echo lang('create_new_order');?></a> -->
                        <a href="<?php echo site_url('/create#order');?>" onclick="showOrderQuote('o')" class="btn btn-info btn-block"><i class="fa fa-plus-circle pull-left"></i> <?php echo lang('btn_new_order');?></a>
                        <a href="<?php echo site_url('/create#quote');?>" onclick="showOrderQuote('q')" class="btn btn-warning btn-block"><i class="fa fa-question-circle pull-left"></i> <?php echo lang('btn_new_quote');?></a>
                    </div>
                   <!--  <div class="wrapper hidden-nav-xs m-t-md m-b-md">
                        <a href="<?php echo site_url('/new_place_order');?>" class="btn btn-info dker btn-block"><i class="fa fa-mail-forward pull-left"></i> <?php echo lang('create_new_order');?></a>
                    </div> -->
                    <ul class="nav nav-main" data-ride="collapse">
                        <li class="<?php echo ($this->uri->segment(1) == '')? 'active':'';?>">
                            <a href="<?php echo site_url('/');?>" class="auto">
                                <i class="i i-statistics icon"></i><span class="font-bold"><?php echo lang('dashboard');?></span>
                            </a>
                        </li>
                        <li class="<?php echo ($this->uri->segment(1) == 'orders')? 'active':'';?>">
                            <a href="javascript:void(0)" class="auto">
                                <span class="pull-right text-muted">
                                    <i class="fa fa-angle-double-down text"></i>
                                    <i class="fa fa-angle-up text-active"></i>
                                </span>
                                <i class="i i-stack icon"></i>
                                <span class="font-bold"><?php echo lang('my_orders');?></span>
                            </a>
                            <ul class="nav dk nav_orders">
                                <li class="nav_all">
                                    <a href="<?php echo site_url('/orders#all');?>" class="auto" onclick="Portal.PageInit.Orders('all')"> 
                                        <i class="i i-dot"></i> <span><?php echo lang('all_orders');?></span>
                                    </a>
                                </li>
                                <li class="nav_pending">
                                    <a href="<?php echo site_url('/orders#pending');?>" class="auto" onclick="Portal.PageInit.Orders('pending')"> 
                                        <b class="badge bg-danger lter pull-right"><?php echo $this->notifications->count_pending_orders;?></b>                                                       
                                        <i class="i i-dot"></i> <span><?php echo lang('pending_orders');?></span>
                                    </a>
                                </li>
                                <li class="nav_completed">
                                    <a href="<?php echo site_url('/orders#completed');?>" class="auto" onclick="Portal.PageInit.Orders('completed')">  
                                        <b class="badge bg-info pull-right"><?php echo $this->notifications->count_completed_orders;?></b>                                                      
                                        <i class="i i-dot"></i> <span><?php echo lang('completed_orders');?></span>
                                    </a>
                                </li>
                                <li class="nav_cancelled">
                                    <a href="<?php echo site_url('/orders#cancelled');?>" class="auto" onclick="Portal.PageInit.Orders('cancelled')">  
                                        <b class="badge bg-danger dker pull-right"><?php echo $this->notifications->count_cancelled_orders;?></b>                                                      
                                        <i class="i i-dot"></i> <span><?php echo lang('cancelled_orders');?></span>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="<?php echo ($this->uri->segment(1) == 'quotations')? 'active':'';?>">
                            <a href="javascript:void(0)" class="auto">
                                <span class="pull-right text-muted">
                                    <i class="fa fa-angle-double-down text"></i>
                                    <i class="fa fa-angle-up text-active"></i>
                                </span>
                                <i class="fa fa-file-text-o icon">
                                </i>
                                <span class="font-bold"><?php echo lang('my_quotation');?></span>
                            </a>
                            <ul class="nav dk">
                                <li >
                                    <a href="<?php echo site_url('/quotations#all');?>" class="auto" onclick="Portal.PageInit.Quotations('all')">                                                        
                                        <i class="i i-dot"></i>
                                        <span>All Quotes</span>
                                    </a>
                                </li>
                                <li >
                                    <a href="<?php echo site_url('/quotations#reviewed');?>" class="auto" onclick="Portal.PageInit.Quotations('reviewed')">                                                        
                                        <b class="badge bg-success dker pull-right"><?php echo $this->notifications->count_reviewed_quote;?></b>
                                        <i class="i i-dot"></i>
                                        <span>Reviewed</span>
                                    </a>
                                </li>
                                <li >
                                    <a href="<?php echo site_url('/quotations#waiting');?>" class="auto" onclick="Portal.PageInit.Quotations('waiting')">                                                        
                                        <b class="badge bg-warning dker pull-right"><?php echo $this->notifications->count_waiting_review;?></b>
                                        <i class="i i-dot"></i>
                                        <span>Awaiting Review</span>
                                    </a>
                                </li>
                                <li >
                                    <a href="<?php echo site_url('/quotations#accepted');?>" class="auto" onclick="Portal.PageInit.Quotations('accepted')">                                                        
                                        <b class="badge bg-info dker pull-right"><?php echo $this->notifications->count_accepted_quotes;?></b>
                                        <i class="i i-dot"></i>
                                        <span>Accepted Quotes</span>
                                    </a>
                                </li>
                                <li >
                                    <a href="<?php echo site_url('/quotations#rejected');?>" class="auto" onclick="Portal.PageInit.Quotations('rejected')">                            
                                        <b class="badge bg-danger dker pull-right"><?php echo $this->notifications->count_rejected_quotes;?></b>                                                        
                                        <i class="i i-dot"></i>
                                        <span>Rejected Quotes</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="<?php echo ($this->uri->segment(1) == 'invoices')? 'active':'';?>">
                            <a href="javascript:void(0)" class="auto">
                                <span class="pull-right text-muted">
                                    <i class="fa fa-angle-double-down text"></i>
                                    <i class="fa fa-angle-up text-active"></i>
                                </span>
                                <i class="fa fa-dollar icon">
                                </i>
                                <span class="font-bold"><?php echo lang('my_invoices');?></span>
                            </a>
                            <ul class="nav dk">
                                <li >
                                    <a href="<?php echo site_url('/invoices#all');?>" class="auto" onclick="Portal.PageInit.Invoice('all')">  
                                        <i class="i i-dot"></i>
                                        <span>All Invoices</span>
                                    </a>
                                </li>
                                <li >
                                    <a href="<?php echo site_url('/invoices#paid');?>" class="auto" onclick="Portal.PageInit.Invoice('paid')">  
                                        <b class="badge bg-success dker pull-right"><?php echo $this->notifications->count_paid_invoices;?></b>                                                      
                                        <i class="i i-dot"></i>
                                        <span>Paid Invoices</span>
                                    </a>
                                </li>
                                <li >
                                    <a href="<?php echo site_url('/invoices#unpaid');?>" class="auto" onclick="Portal.PageInit.Invoice('unpaid')">
                                        <b class="badge bg-danger dker pull-right"><?php echo $this->notifications->count_unpaid_invoices;?></b>
                                        <i class="i i-dot"></i>
                                        <span>Unpaid Invoices</span>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    </ul>
                    <ul class="nav nav_profile">
                        <div class="line line-dashed lt hidden-nav-xs"></div>
                        <li class="<?php echo ($this->uri->segment(1) == 'message')? 'active':'';?>">
                            <a href="<?php echo site_url('/message');?>">
                                <b class="badge bg-danger lter pull-right <?php echo ($this->notifications->unread_messages < 1) ? 'hide' : '';?>"><?php echo $this->notifications->unread_messages;?></b>
                                <i class="i i-support icon text-primary"></i>
                                <span>Support Messages</span>
                            </a>
                        </li>
                        <div class="line line-dashed lt hidden-nav-xs"></div>
                        <li class="nav_profile <?php echo ($this->uri->segment(1) == 'profile')? 'active':'';?>">
                            <a href="<?php echo site_url('/profile#profile');?>" onclick="Portal.PageInit.Profile('profile')">
                                <i class="i i-user3 icon text-info"></i>
                                <span>My Account</span>
                            </a>
                        </li>
                        <li class="<?php echo ($this->uri->segment(1) == 'account_manager')? 'active':'';?>">
                            <!-- <a href="<?php echo site_url('/account_manager');?>">
                                <i class="i i-users2 icon text-success"></i>
                                <span>Manage Team</span>
                            </a> -->
                            <a href="<?php echo site_url('/profile#managers');?>">
                                <i class="i i-users2 icon text-success"></i>
                                <span>Manage Team</span>
                            </a>
                        </li>
                    </ul>
                    <!--div class="text-muted text-xs hidden-nav-xs padder m-t-sm m-b-sm">Others</div>
                    <ul class="nav">
                        <li class="<?php echo ($this->uri->segment(1) == 'support')? 'active':'';?>">
                            <a href="<?php echo site_url('/support');?>">
                                <i class="i i-support"></i>
                                <span>Support</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('auth/lock');?>" class="logout" data-toggle="ajaxModal" >
                                <i class="i i-logout"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul-->
                </nav>
                <!-- / nav -->
            </div>
        </section>

        <footer class="footer hidden-xs no-padder text-center-nav-xs">

                <a href="<?php echo site_url('auth/lock');?>" data-toggle="ajaxModal" class="btn btn-icon icon-muted btn-inactive pull-right m-l-xs m-r-xs hidden-nav-xs logout">
                    <i class="i i-logout text-danger" data-toggle="tooltip" data-placement="left" data-original-title="Logout"></i>
                </a>
                <a href="<?php echo site_url('/support');?>" class="btn btn-icon icon-muted btn-inactive pull-right m-l-xs m-r-xs hidden-nav-xs">
                    <i class="i i-support" data-toggle="tooltip" data-placement="left" data-original-title="Support"></i>
                </a>
                <a href="#nav" data-toggle="class:nav-xs" class="btn btn-icon icon-muted btn-inactive m-l-xs m-r-xs">
                    <i class="i i-circleleft text"></i>
                    <i class="i i-circleright text-active"></i>
                </a>
        </footer>
    </section>
</aside>
<!-- /.aside -->