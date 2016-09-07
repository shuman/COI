<section class="hbox stretch">
    <section>
        <section class="vbox">
            <section class="scrollable padder">              
                <section class="row m-b-md">
                    <div class="col-sm-6">
                        <h3 class="m-b-xs text-black"><?php echo lang('order_1'); ?></h3>
                        <small><?php echo lang('order_2'); ?></small>
                    </div>
                </section>
                <div class="row">
                    <div class="col-lg-12">
                        <form action="" method="get" id="order_filter_form">
                            <section class="panel panel-default">
                                <header class="panel-heading">
                                    <span class="label bg-info dker pull-right m-t-xs"><?php echo $this->notifications->count_completed_orders; ?> Completed</span>
                                    <!-- <span class="label bg-danger lter pull-right m-t-xs m-r-xs">1 Due</span> -->
                                    <span class="label bg-warning dker pull-right m-t-xs m-r-xs"><?php echo $this->notifications->count_pending_orders; ?> Pending</span>
                                    <span class="h5 font-bold"><?php echo lang('order_3'); ?></span>
                                </header>
                                <div class="col-lg-5 m-t-sm">
                                    <div class="m-t-xs m-b-n-sm">
                                        <div class="checkbox-inline i-checks">
                                            <label><input class="order_filter" id="f_pending" type="checkbox" name="order_status[]" value="<?php echo ORDER_PENDING; ?>"> <i></i> <span class="text-left"> Pending</span> </label>
                                        </div>
                                        <div class="checkbox-inline i-checks">
                                            <label><input class="order_filter" id="f_due" type="checkbox" name="due" value="1"> <i></i> <span class="text-left"> Due</span> </label>
                                        </div>
                                        <div class="checkbox-inline i-checks">
                                            <label><input class="order_filter" id="f_completed" type="checkbox" name="order_status[]" value="<?php echo ORDER_COMPLETED; ?>"> <i></i> <span class="text-left"> Completed</span> </label>
                                        </div>
                                        <div class="checkbox-inline i-checks">
                                            <label><input class="order_filter" id="f_cancelled" type="checkbox" name="order_status[]" value="<?php echo ORDER_CANCELLED; ?>"> <i></i> <span class="text-left"> Cancelled</span> </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 m-b-sm m-t-sm">
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
                                <div class="col-lg-3 m-b-sm m-t-sm">
                                    <div class="input-group">
                                        <input type="search" class="input-sm form-control" name="keyword" placeholder="Search">
                                        <span class="input-group-btn">
                                            <input class="btn btn-sm btn-default" name="search" type="submit" value="Go!">
                                        </span>
                                    </div>
                                </div>
                                <table id="orders_list" class="table table-striped m-b-none">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th class="hidden-xs">Title</th>
                                            <th class="hidden-xs">Order Date</th>
                                            <th class="text-center hidden-xs">Quantity</th>
                                            <th class="text-center hidden-xs">TAT</th>
                                            <th class="text-center hidden-xs">Time Left</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-right">Download</th>
                                        </tr>
                                    </thead>
                                    <tbody id="orderslist_box">
                                        <!-- ajax loading -->
                                    </tbody>
                                </table>
                                <footer class="panel-footer">
                                    <div class="row">
                                        <div class="col-sm-4 hidden-xs">
                                            <a href="<?php echo site_url('/create#order'); ?>" class="btn btn-sm btn-info"><i class="i i-arrow"></i> Create New Order</a>    
                                        </div>
                                        <!--div class="col-sm-4 text-center">
                                                <small class="text-muted inline m-t-sm m-b-sm">Showing 01-10 of 57 items</small>
                                        </div>
                                        <div class="col-sm-4 text-right text-center-xs">                
                                                <ul class="pagination pagination-sm m-t-none m-b-none">
                                                        <li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
                                                        <li><a href="#">1</a></li>
                                                        <li><a href="#">2</a></li>
                                                        <li><a href="#">3</a></li>
                                                        <li><a href="#">4</a></li>
                                                        <li><a href="#">5</a></li>
                                                        <li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
                                                </ul>
                                        </div-->
                                    </div>
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

<script type="text/javascript">
    $(document).ready(function () {
        Portal.PageInit.Orders();
    });
</script>

<script id="orders" type="text/html">
    {{#data}}
    <tr>                    
        <td class="nowrap"><a data-toggle="ajaxModal" href="<?php echo site_url('/ajax/popup_order_details'); ?>/?order_id={{order_id}}">{{key_id}}</a></td>
        <td class="hidden-xs"><div class="title_limit_300px text-ellipsis"><a data-toggle="ajaxModal" href="<?php echo site_url('/ajax/popup_order_details'); ?>/?order_id={{order_id}}">{{title}}</a></div></td>
        <td class="hidden-xs nowrap">{{order_date}}</td>
        <td class="text-center hidden-xs">{{quantity}}</td>

        {{#if countup}}
        <td class="text-center hidden-xs">Flexible</td>
        {{else}}

        <td class="text-center hidden-xs nowrap"><?php
            $tat = '{{tat}}';
            echo ($tat != 0) ? "Flexible" : $tat . " Hours";
            ?></td>
        {{/if}}

        {{#if timer}}
        {{#if countup}}
        <td class="text-center hidden-xs text-warning lter">N/A</td>
        {{else}}
        <td class="text-center hidden-xs text-warning lter"><span data-countdown="{{timer}}">00:00:00</span></td>
        {{/if}}
        <td class="text-center sts"><span class="label bg-warning m-t-xs">{{order_status}}</span></td>
        {{else}}
        {{#if expired}}
        <td class="text-center hidden-xs {{#if success}}text-danger {{/if}} {{#if cancelled}}text-muted {{/if}} lter">-{{done_before}}</td>
        {{else}}
        <td class="text-center hidden-xs {{#if success}}text-info {{/if}} {{#if cancelled}}text-muted {{/if}} lter">{{done_before}}</td>
        {{/if}}
        <td class="text-center sts"><span class="label {{#if success}}bg-info {{/if}} {{#if cancelled}}bg-light dker {{/if}} m-t-xs">{{order_status}}</span></td>
        {{/if}}

        <td class="text-right nowrap">
            {{#if success}}
            {{#if flagstatus}}
                <a href="<?php echo site_url('/download'); ?>?key={{download_key}}" target="_blank" data-toggle="tooltip" data-placement="left" title="{{complete_date}}" class="btn btn-xs btn-icon btn-info">
                    <i class="fa fa-download"></i>
                </a>
            {{else}}
             <a href="javascript:void(0)" data-toggle="tooltip" data-placement="left" title="{{complete_date}}" class="btn btn-xs btn-icon btn-danger ">
                   <i class="fa fa-download"></i>
                </a>
            {{/if}}
            {{else}}
                <a href="javascript:void(0)" class="btn btn-xs btn-icon btn-default" data-toggle="tooltip" data-placement="left" title="Download Not Ready">
                    <i class="fa fa-download"></i>
                </a>
            {{/if}}

            <span class="btn btn-xs btn-default disabled hidden-xs">{{downloaded}}</span>
        </td>
    </tr>
    {{/data}}
</script>

