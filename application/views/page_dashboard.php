<section class="hbox stretch">
    <section>
        <section class="vbox">
            <section class="scrollable padder m-b-xl">              
                <section class="row m-b-md">
                    <div class="col-sm-6">
                        <h3 class="m-b-xs text-black">Dashboard</h3>
                        <small>Welcome back <a href="<?php echo site_url('/profile/'); ?>" class="text-info"><?php echo (isset($this->user_profile->fullname)) ? $this->user_profile->fullname : ''; ?></a>!</small>
                    </div>

                </section>

                <div class="row">

                    <div class="visible-xs m m-b-lg">
                        <a href="<?php echo site_url('/place_order'); ?>" class="btn btn-info btn-block b-dark b-dashed text-u-c font-bold"><i class="fa fa-mail-forward pull-left"></i> <?php echo lang('create_new_order'); ?></a>
                    </div>


                    <div class="col-md-3 col-sm-6">
                        <div class="panel b-a">
                            <div class="panel-heading no-border bg-info text-center hover">
                                <a href="<?php echo site_url('/orders'); ?>">
                                    <i class="i i-stack i i-2x m-t m-b text-white hover-rotate"></i>
                                    <span class="h3 font-bold m-l-sm text-white">Orders</span>
                                </a>
                            </div>
                            <div class="padder-v text-center clearfix">                            
                                <div class="col-xs-6 b-r">
                                    <a href="<?php echo site_url('/orders#pending'); ?>"><div class="h4 font-bold text-warning"><?php echo $this->notifications->count_pending_orders; ?></div></a>
                                    <small class="text-muted">Pending</small>
                                </div>
                                <div class="col-xs-6">
                                    <a href="<?php echo site_url('/orders#completed'); ?>"><div class="h4 font-bold text-success"><?php echo $this->notifications->count_completed_orders; ?></div></a>
                                    <small class="text-muted">Completed</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="panel b-a">
                            <div class="panel-heading no-border bg-warning dker text-center hover">
                                <a href="<?php echo site_url('/quotations'); ?>">
                                    <i class="i i-docs i i-2x m-t m-b text-white hover-rotate"></i>
                                    <span class="h3 font-bold m-l-sm text-white">Quotes</span>
                                </a>
                            </div>
                            <div class="padder-v text-center clearfix">                            
                                <div class="col-xs-6 b-r">
                                    <a href="<?php echo site_url('/quotations#waiting'); ?>"><div class="h4 font-bold text-warning"><?php echo $this->notifications->count_waiting_review; ?></div></a>
                                    <small class="text-muted">Awaiting</small>
                                </div>
                                <div class="col-xs-6">
                                    <a href="<?php echo site_url('/quotations#accepted'); ?>"><div class="h4 font-bold text-success"><?php echo $this->notifications->count_accepted_quotes; ?></div></a>
                                    <small class="text-muted">Accepted</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="panel b-a">
                            <div class="panel-heading no-border bg-primary dker text-center hover">
                                <a href="<?php echo site_url('/message'); ?>">
                                    <i class="fa fa-envelope-o fa fa-2x m-t m-b text-white hover-rotate"></i>
                                    <span class="h3 font-bold m-l-sm text-white">Messages</span>
                                </a>
                            </div>
                            <div class="padder-v text-center clearfix">                            
                                <div class="col-xs-6 b-r">
                                    <a href="<?php echo site_url('/message'); ?>"><div class="h4 font-bold text-warning"><?php echo $this->notifications->unread_messages; ?></div></a>
                                    <small class="text-muted">Unread</small>
                                </div>
                                <div class="col-xs-6">
                                    <div class="h4 font-bold text-success"><?php echo $this->notifications->count_messages; ?></div>
                                    <small class="text-muted">Total</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="panel b-a">
                            <div class="panel-heading no-border bg-danger dker text-center hover">
                                <a href="<?php echo site_url('/invoices'); ?>">
                                    <i class="fa fa-dollar fa fa-2x m-t m-b text-white hover-rotate"></i>
                                    <span class="h3 font-bold m-l-sm text-white">Invoices</span>
                                </a>
                            </div>
                            <div class="padder-v text-center clearfix">                            
                                <div class="col-xs-6 b-r">
                                    <a href="<?php echo site_url('/invoices#unpaid'); ?>"><div class="h4 font-bold text-warning"><?php echo $this->notifications->count_unpaid_invoices; ?></div></a>
                                    <small class="text-muted">Unpaid</small>
                                </div>
                                <div class="col-xs-6">
                                    <div class="h4 font-bold text-danger"><?php echo $this->notifications->total_due; ?>$</div>
                                    <small class="text-muted">You Owe</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-3 col-sm-6">
                            <div class="panel b-a">
                                    <div class="panel-heading no-border bg-primary text-center hover">
                                            <a href="#">
                                                    <i class="fa fa-clock-o fa fa-2x m-t m-b text-white hover-rotate"></i>
                                                    <span class="h3 font-bold m-l-sm text-white">Clock</span>
                                            </a>
                                    </div>
                                    <div class="padder-v text-center clearfix">                            
                                            <div class="col-xs-6 b-r">
                                                    <div id="mytime" class="h4 text-danger font-bold"><span id="l_hours">00</span><span id="point">:</span><span id="l_min">00</span></div>
                                                    <small class="text-muted">Yours</small>
                                            </div>
                                            <div class="col-xs-6">
                                                    <div id="remote_time" data-time="<?php echo (time() * 1000); ?>" class="h4 text-success font-bold"><span id="r_hours">00</span><span id="point">:</span><span id="r_min">00</span></div>
                                                    <small class="text-muted">Ours</small>
                                            </div>
                                    </div>
                            </div>
                    </div> -->
                </div>           
                <div class="row">
                    <div class="col-lg-6">
                        <form action="" method="get" id="order_filter_form">
                            <section class="panel panel-default" style="display:none;">
                                <div class="col-md-6 m-t-sm">
                                    <div class="m-t-xs m-b-n-sm">
                                        <div class="checkbox-inline i-checks">
                                            <label><input class="order_filter" type="checkbox" name="order_status[]" checked value="<?php echo ORDER_PENDING; ?>"> <i></i> <span class="text-left"> Pending</span> </label>
                                        </div>
                                        <div class="checkbox-inline i-checks">
                                            <label><input class="order_filter" type="checkbox" name="order_status[]" checked value="<?php echo ORDER_COMPLETED; ?>"> <i></i> <span class="text-left"> Completed</span> </label>
                                        </div>
                                        <div class="checkbox-inline i-checks">
                                            <label><input class="order_filter" type="checkbox" name="due" checked value=""> <i></i> <span class="text-left"> Due</span> </label>
                                        </div>
                                        <div class="checkbox-inline i-checks">
                                            <label><input class="order_filter" type="checkbox" name="over_due" checked value=""> <i></i> <span class="text-left"> Over Due</span> </label>
                                        </div>
                                        <div class="checkbox-inline i-checks">
                                            <label><input class="order_filter" type="checkbox" name="order_status[]" checked value="<?php echo ORDER_CANCELLED; ?>"> <i></i> <span class="text-left"> Cancelled</span> </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 m-b-sm m-t-sm">
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-sm btn-default active">
                                            <input class="order_filter" type="radio" name="period" id="period_all" value="all"> All
                                        </label>
                                        <label class="btn btn-sm btn-default">
                                            <input class="order_filter" type="radio" name="period" id="period_today" value="today"> Today
                                        </label>
                                        <label class="btn btn-sm btn-default">
                                            <input class="order_filter" type="radio" name="period" id="period_week" value="week"> Last Week
                                        </label>
                                        <label class="btn btn-sm btn-default">
                                            <input class="order_filter" type="radio" name="period" id="period_month" value="month"> Last Month
                                        </label>
                                    </div>
                                </div>
                            </section>
                        </form>
                        <section class="panel panel-default">
                            <header class="panel-heading">
                                <span class="h5 font-bold">Order List</span><span class="h5 pull-right"><a class="text-info" href="<?php echo site_url('/orders#all'); ?>"><i class="fa fa-angle-double-right text-black"></i> All Orders</a></span> 
                                <!--span class="label bg-danger dker pull-right m-t-xs">1 Over Due</span>
                                <span class="label bg-danger lter pull-right m-t-xs m-r-xs">1 Due</span>
                                <span class="label bg-warning dker pull-right m-t-xs m-r-xs">2 Pending</span-->
                            </header>
                            <table class="table table-striped m-b-none">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <!-- <th class="hidden-xs">Title</th> -->
                                        <th class="hidden-xs">Title</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-right">Download</th>
                                    </tr>
                                </thead>
                                <tbody id="orderslist_box">

                                </tbody>
                            </table>
                        </section>
                    </div>
                    <div class="col-lg-6">
                        <!-- .comment-list -->
                        <section class="panel panel-default">
                            <header class="panel-heading">                    
                                <span class="h5 font-bold">Support Request Form</span> <span class="h5 pull-right"><a class="text-info" href="<?php echo site_url('/message'); ?>"><i class="fa fa-angle-double-right text-black"></i> All Messages</a></span> 
                            </header>
                            <section class="panel-body comment-list slim-scroll" data-height="346px">
                                <!-- comment form -->
                                <article id="comment-form" class="comment-item media m-b-md">
                                    <a class="pull-left thumb-custom avatar m-t-sm"><img src="<?php echo $this->avatar; ?>"></a>
                                    <section class="media-body">
                                        <form id="message_form" onsubmit="return Portal.Message.send();" action="" method="post" class="m-t-sm" action="">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <p> <input type="text" id="subject" name="subject" placeholder="Subject" class="form-control" style="height: 30px;"> </p>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div style="padding-right: 2px">
                                                        <select name="message_type" class="chosen-select form-control">
                                                            <?php
                                                            if (isset($messageTopics)) {
                                                                foreach ($messageTopics as $key => $value) {
                                                                    if (is_array($value)) {
                                                                        echo '<optgroup label="' . $key . '">';
                                                                        foreach ($value as $order) {
                                                                            echo '<option value="' . $order['order_id'] . '">' . $order['key_id'] . ' - (' . $order['order_status'] . ')</option>';
                                                                        }
                                                                        echo '</optgroup>';
                                                                    } else {
                                                                        echo '<option value="' . $value . '">' . $value . '</option>';
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <p><textarea id="message" name="message" placeholder="Messages here!" class="form-control" rows="7"></textarea></p>
                                                    <button type="submit" class="btn btn-info pull-right m-t-sm">SEND MESSAGE</button>
                                                    <span class="ajax_msg pull-left m-t-sm" style="display:none;" data-wait="Sending message..." data-done="Success!"></span>
                                                </div>
                                            </div>
                                        </form>
                                    </section>
                                </article>
                            </section>
                        </section>
                    </div>
                </div>
            </section>
            <footer class="footer bg-light dker"> 
                <p>Copyright &copy; 2016, <a href="https://www.cutoutimage.com" target="_blank" class="text-light font-bold">Cut Out Image</a>.</p> <div class="pull-right p-t-sm"><a href="https://www.cutoutimage.com/privacy-policy" target="_blank" class="p-l-sm p-r-sm"> Privacy </a> | <a href="https://www.cutoutimage.com/terms-of-service" target="_blank" class="p-l-sm p-r-sm"> Terms </a> | <a href="https://www.cutoutimage.com/how-it-works" target="_blank" class="p-l-sm p-r-sm"> How It Works? </a> | <a data-toggle="ajaxModal" href="<?php echo site_url('ajax/portal_help'); ?>" class="p-l-sm p-r-sm"> Help? </a></div> 
            </footer>
        </section>
    </section>
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        Portal.PageInit.Dashboard();
        Portal.Order.LoadOrderTable(8);

        tinymce.init({
            plugins: "paste",
            paste_as_text: true,
            paste_auto_cleanup_on_paste: true,
            paste_remove_styles: true,
            paste_remove_styles_if_webkit: true,
            paste_strip_class_attributes: true,
            selector: "textarea",
            theme: "modern",
            skin: 'light',
            menubar: false,
            statusbar: false,
            toolbar: "bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat",
            setup: function (editor) {
                editor.on('change', function () {
                    tinymce.triggerSave();
                });
            }
        });
    });
</script>

<script id="tpl_messages" type="text/html">
    {{#messages}}
    <article class="comment-item" id="comment-id-{{msg_hashid}}">
        <a class="pull-left thumb-sm avatar"><img src="<?php echo $this->avatar; ?>"></a>
        <span class="arrow left"></span>
        <section class="comment-body panel panel-default">
            <header class="panel-heading">                      
                <a href="#">{{sender_name}}</a>
                <label class="label bg-info m-l-xs">{{sender_designation}}</label> 
                <span class="text-muted m-l-sm pull-right"> <i class="fa fa-clock-o"></i> <span class="timeago" title="{{msg_time}}">{{msg_time}}</span>
            </header>
            <div class="panel-body">
                <div>{{{msg_content}}}</div>
            </div>
        </section>
    </article>
    {{/messages}}
</script>
<script id="orders" type="text/html">
    {{#data}}
    <tr> 
        <td><a data-toggle="ajaxModal" class="title_limit_80px text-ellipsis" href="<?php echo site_url('/ajax/popup_order_details'); ?>/?order_id={{order_id}}">{{key_id}}</a></td>                   
        <td class="hidden-xs"><div class="title_limit_120px text-ellipsis"><a data-toggle="ajaxModal" href="<?php echo site_url('/ajax/popup_order_details'); ?>/?order_id={{order_id}}">{{title}}</a></div></td>
        {{#if timer}}
        <td class="text-center sts"><span class="label bg-warning m-t-xs">{{order_status}}</span></td>
        {{else}}
        <td class="text-center sts"><span class="label {{#if success}}bg-info {{/if}} {{#if cancelled}}bg-light dker {{/if}} m-t-xs">{{order_status}}</span></td>
        {{/if}}

        <td class="text-right nowrap">
            {{#if success}}
            {{#if flagstatus}}
            <a href="{{download_url}}" target="_blank" class="btn btn-xs btn-icon btn-info" data-toggle="tooltip" data-placement="left" title="{{complete_date}}">
                <i class="fa fa-download"></i>
            </a>
            {{else}}
             <a href="javascript:void(0)"  class="btn btn-xs btn-icon btn-danger" data-toggle="tooltip" data-placement="left" title="{{complete_date}}">
                <i class="fa fa-download"></i>
            </a>
            {{/if}}
            {{else}}
            <a href="javascript:void(0)" class="btn btn-xs btn-icon btn-default" data-toggle="tooltip" data-placement="left" title="Download Not Ready">
                <i class="fa fa-download"></i>
            </a>
            {{/if}}
            <span class="btn btn-xs btn-default disabled"><?php $d_quantity = sprintf("%02d", '{{downloaded}}');
                                                            echo (!empty($d_quantity) ? $d_quantity : '0');
                                                            ?></span>

        </td>
    </tr>
    {{/data}}
</script>