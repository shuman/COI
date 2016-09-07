
<aside class="bg-black aside-md hidden-print" id="nav">          
    <section class="vbox">
        <section class="w-f scrollable">
            <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px" data-railOpacity="0.2">
                <!-- nav -->                 
                <nav class="nav-primary hidden-xs" id="l-c-s-nav">
                    <div class="wrapper hidden-nav-xs m-t-md m-b-md">
                        <div class="btn-group m-b-sm ">
                            <a href="<?php echo site_url('/');?>" class="btn btn-info btn-c-lg"><i class="i i-statistics icon pull-left"></i><?php echo lang('dashboard');?></a>
                            <div class="btn-group">
                                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                                New
                                &nbsp;<span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu animated fadeInRight">
                                <span class="arrow top hidden-nav-xs"></span>
                                <li><a href="<?php echo site_url('admin/admin_create_order'); ?>"><i class="fa fa-plus"></i>Order</a></li>
                                <li><a href="<?php echo site_url('admin/admin_quote_order'); ?>"><i class="fa fa-file"></i>Quote</a></li>
                                <li><a href="<?php echo site_url('admin/admin_create_invoices'); ?>"><i class="fa fa-dollar"></i>Invoice</a></li>
                                <li><a href="<?php echo site_url('admin/admin_send_message'); ?>"><i class="fa fa-comment"></i>Message</a></li>
                              </ul>
                            </div>
                        </div>
                    </div>
                    <div class="line dk hidden-nav-xs"></div>
                    <ul class="nav nav-main" data-ride="collapse">
                        <li class="<?php echo ($this->uri->segment(2) == 'orders')? 'active':'';?>">
                            <a href="javascript:void(0)" class="auto">
                                <span class="pull-right text-muted"> <i class="fa fa-angle-double-down text"></i><i class="fa fa-angle-up text-active"></i></span>
                                <i class="i i-stack icon"></i></i><span class="font-bold">All Orders</span>
                            </a>
                            <ul class="nav dk">
                                <li><a href="<?php echo site_url('/admin/orders');?>" class="auto"><i class="i i-dot"></i><span>All Orders</span></a></li>
                                <li><a href="<?php echo site_url('/admin/orders/#pending');?>" class="auto"><i class="i i-dot"></i><span>Pending Orders</span></a></li>
                                <li><a href="<?php echo site_url('/admin/orders/#completed');?>" class="auto"><i class="i i-dot"></i><span>Completed Orders</span></a></li>
                                <li><a href="<?php echo site_url('/admin/orders/#due');?>" class="auto"><i class="i i-dot"></i><span>Overdue Orders</span></a></li>
                                <li><a href="<?php echo site_url('/admin/orders/#hold');?>" class="auto"><i class="i i-dot"></i><span>Hold Orders</span></a></li>
                                <li><a href="<?php echo site_url('/admin/orders/#cancel');?>" class="auto"><i class="i i-dot"></i><span>Cancelled Orders</span></a></li>
                                <li><a href="<?php echo site_url('admin/admin_quote_order'); ?>" class="auto"><i class="i i-dot"></i><span>Create New Order</span></a></li>
                                <!-- <li><a href="<?php echo site_url('/admin/adminCreateOrder');?>" class="auto"><i class="i i-dot"></i><span>Create New Order</span></a></li> -->
                            </ul>
                        </li>
                        <li class="<?php echo ($this->uri->segment(2) == 'quotes')? 'active':'';?>">
                            <a href="javascript:void(0)" class="auto">
                                <span class="pull-right text-muted"> <i class="fa fa-angle-double-down text"></i><i class="fa fa-angle-up text-active"></i></span>
                                <i class="i i-docs icon"></i><span class="font-bold">All Quotes</span>
                            </a>
                            <ul class="nav dk">
                                <li><a href="<?php echo site_url('/admin/quotes');?>" class="auto"><i class="i i-dot"></i><span>All Quotes</span></a></li>
                                <li><a href="<?php echo site_url();?>" class="auto"><i class="i i-dot"></i><span>Pending Review</span></a></li>
                                <li><a href="<?php echo site_url();?>" class="auto"><i class="i i-dot"></i><span>Accepted Quotes</span></a></li>
                                <li><a href="<?php echo site_url();?>" class="auto"><i class="i i-dot"></i><span>Rejected Quotes</span></a></li>
                                <li><a href="<?php echo site_url('admin/admin_quote_order'); ?>" class="auto"><i class="i i-dot"></i><span>Create New Quote</span></a></li>
                                <!-- <li><a href="<?php echo site_url();?>" class="auto"><i class="i i-dot"></i><span>Create New Quote</span></a></li> -->
                            </ul>
                        </li>
                       
                        <li class="<?php echo ($this->uri->segment(2) == 'invoices')? 'active':'';?>">
                            <a href="javascript:void(0)" class="auto">
                                <span class="pull-right text-muted"> <i class="fa fa-angle-double-down text"></i><i class="fa fa-angle-up text-active"></i></span>
                                <i class="fa fa-dollar icon"></i><span class="font-bold">All Invoices</span>
                            </a>
                            <ul class="nav dk">
                                <li><a href="<?php echo site_url('/admin/invoices');?>" class="auto"><i class="i i-dot"></i><span>All Invoices</span></a></li>
                                <li><a href="<?php echo site_url();?>" class="auto"><i class="i i-dot"></i><span>Unpaid Invoices</span></a></li>
                                <li><a href="<?php echo site_url();?>" class="auto"><i class="i i-dot"></i><span>Paid Invoices</span></a></li>
                                <li><a href="<?php echo site_url();?>" class="auto"><i class="i i-dot"></i><span>Reminder</span></a></li>
                                <li><a href="<?php echo site_url('admin/admin_create_invoices'); ?>" class="auto"><i class="i i-dot"></i><span>Create New Invoice</span></a></li>
                            </ul>
                        </li>
                        <li class="<?php echo ($this->uri->segment(2) == 'messages')? 'active':'';?>">
                            <a href="javascript:void(0)" class="auto">
                                <span class="pull-right text-muted"> <i class="fa fa-angle-double-down text"></i><i class="fa fa-angle-up text-active"></i></span>
                                <i class="fa fa-envelope-o icon"></i><span class="font-bold">Message Board</span>
                            </a>
                            <ul class="nav dk">
                                <li><a href="<?php echo site_url('/admin/messages');?>" class="auto"><i class="i i-dot"></i><span>All Messages</span></a></li>
                                <li><a href="<?php echo site_url();?>" class="auto"><i class="i i-dot"></i><span>Pending Reply</span></a></li>
                                <li><a href="<?php echo site_url();?>" class="auto"><i class="i i-dot"></i><span>Answered Message</span></a></li>
                                <li><a href="<?php echo site_url('admin/admin_send_message'); ?>" class="auto"><i class="i i-dot"></i><span>Send New Message</span></a></li>
                            </ul>
                        </li>
                    </ul>
                    <div class="text-muted text-xs hidden-nav-xs padder m-t-sm m-b-sm">Users &amp; Admins</div>
                    <div class="line dk hidden-nav-xs"></div>
                    <ul class="nav nav-main" data-ride="collapse">
                        <li>
                            <a href="javascript:void(0)" class="auto">
                                <span class="pull-right text-muted"> <i class="fa fa-angle-double-down text"></i><i class="fa fa-angle-up text-active"></i></span>
                                <i class="i i-user2 icon text-info"></i><span class="font-bold">User List</span>
                            </a>
                            <ul class="nav dk">
                                <!-- <li><a href="<?php echo site_url('admin/reports/all_Users');?>" class="auto"><i class="i i-dot"></i><span>All Users</span></a></li> -->
                                
                                <li><a href="<?php echo site_url('admin/user_list'); ?>" class="auto"><i class="i i-dot"></i><span>All Users</span></a></li>
                                <li><a href="<?php echo site_url('admin/add_new_user'); ?>" class="auto"><i class="i i-dot"></i><span>Blocked Users</span></a></li>
                                <li><a href="<?php echo site_url('admin/add_new_user'); ?>" class="auto"><i class="i i-dot"></i><span>Add New User</span></a></li>
                                <li><a href="<?php echo site_url('admin/white_listed_user');?>" class="auto"><i class="i i-dot"></i><span>White Listed</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="auto">
                                <span class="pull-right text-muted"> <i class="fa fa-angle-double-down text"></i><i class="fa fa-angle-up text-active"></i></span>
                                <i class="i i-users2 icon text-warning"></i><span class="font-bold">Supplier List</span>
                            </a>
                            <ul class="nav dk">
                                <!-- <li><a href="<?php echo site_url('admin/reports/all_Users');?>" class="auto"><i class="i i-dot"></i><span>All Users</span></a></li> -->
                                
                                <li><a href="<?php echo site_url('admin/user_list'); ?>" class="auto"><i class="i i-dot"></i><span>All Suppliers</span></a></li>
                                <li><a href="<?php echo site_url('admin/add_new_user'); ?>" class="auto"><i class="i i-dot"></i><span>Blocked Suppliers</span></a></li>
                                <li><a href="<?php echo site_url('admin/add_new_user'); ?>" class="auto"><i class="i i-dot"></i><span>Add New Suppliers</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="auto">
                                <span class="pull-right text-muted"> <i class="fa fa-angle-double-down text"></i><i class="fa fa-angle-up text-active"></i></span>
                                <i class="fa fa-user text-success"></i><span class="font-bold">Support Team</span>
                            </a>
                            <ul class="nav dk">
                                <!-- <li><a href="<?php echo site_url('admin/reports/all_Users');?>" class="auto"><i class="i i-dot"></i><span>All Users</span></a></li> -->
                                
                                <li><a href="<?php echo site_url('admin/user_list'); ?>" class="auto"><i class="i i-dot"></i><span>All Members</span></a></li>
                                <li><a href="<?php echo site_url('admin/add_new_user'); ?>" class="auto"><i class="i i-dot"></i><span>Blocked Members</span></a></li>
                                <li><a href="<?php echo site_url('admin/add_new_user'); ?>" class="auto"><i class="i i-dot"></i><span>Add New Member</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="auto">
                                <span class="pull-right text-muted"> <i class="fa fa-angle-double-down text"></i><i class="fa fa-angle-up text-active"></i></span>
                                <i class="fa fa-users text-danger"></i></i><span class="font-bold">COI Admins</span>
                            </a>
                            <ul class="nav dk">
                                <!-- <li><a href="<?php echo site_url('admin/reports/all_Users');?>" class="auto"><i class="i i-dot"></i><span>All Users</span></a></li> -->
                                
                                <li><a href="<?php echo site_url('admin/user_list'); ?>" class="auto"><i class="i i-dot"></i><span>All Admins</span></a></li>
                                <li><a href="<?php echo site_url('admin/add_new_user'); ?>" class="auto"><i class="i i-dot"></i><span>Blocked Admins</span></a></li>
                                <li><a href="<?php echo site_url('admin/add_new_user'); ?>" class="auto"><i class="i i-dot"></i><span>Add New Admin</span></a></li>
                            </ul>
                        </li>
                        </ul>
                    <div class="text-muted text-xs hidden-nav-xs padder m-t-sm m-b-sm">Report Section</div>
                    <div class="line dk hidden-nav-xs"></div>
                    <ul class="nav nav-main" data-ride="collapse">
                        <li>
                            <a href="javascript:void(0)" class="auto">
                                <span class="pull-right text-muted"> <i class="fa fa-angle-double-down text"></i><i class="fa fa-angle-up text-active"></i></span>
                                <i class="i i-stats"></i><span class="font-bold">Reports</span>
                            </a>
                            <ul class="nav dk">
                                <li><a href="<?php echo site_url('/admin/reports');?>" class="auto"><i class="i i-dot"></i><span>Orders</span></a></li>
                                <li><a href="<?php echo site_url('/quotations#all');?>" class="auto"><i class="i i-dot"></i><span>Income</span></a></li>
                                <li><a href="<?php echo site_url('/quotations#all');?>" class="auto"><i class="i i-dot"></i><span>Fractions</span></a></li>
                            </ul>
                        </li>
                        <li class="<?php echo ($this->uri->segment(2) == 'audit_log')? 'active':'';?>">
                            <a href="<?php echo site_url('/admin/audit_log');?>" class="auto">
                                <i class="fa fa-exchange icon"></i><span class="font-bold">Audit Logs</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- / nav -->
            </div>
        </section>
        <footer class="footer hidden-xs no-padder text-center-nav-xs">

                <a href="<?php echo site_url('auth/lock');?>" data-toggle="ajaxModal" class="btn btn-icon icon-muted btn-inactive pull-right m-l-xs m-r-xs hidden-nav-xs logout">
                    <i class="i i-logout text-danger"></i>
                </a>
                <a href="https://www.cutoutimage.com" target="_blank" class="btn btn-icon icon-muted btn-inactive pull-right m-l-xs m-r-xs hidden-nav-xs">
                    <i class="i i-home" data-toggle="tooltip" data-placement="top" data-original-title="Site"></i>
                </a> 
                <a href="http://cutoutimage.com:2082" target="_blank" class="btn btn-icon icon-muted btn-inactive pull-right m-l-xs m-r-xs hidden-nav-xs">
                    <i class="i i-newtab" data-toggle="tooltip" data-placement="top" data-original-title="cPanel"></i>
                </a>
                <a href="#nav" data-toggle="class:nav-xs" class="btn btn-icon icon-muted btn-inactive m-l-xs m-r-xs">
                    <i class="i i-circleleft text"></i>
                    <i class="i i-circleright text-active"></i>
                </a>
        </footer>
    </section>
</aside>
<!-- /.aside