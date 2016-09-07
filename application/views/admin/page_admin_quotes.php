<section class="hbox stretch">
    <section>
        <section class="vbox">
            <section class="scrollable padder">              
                <section class="row m-b-md">
                    <div class="col-sm-6">
                        <h3 class="m-b-xs text-black">Quotation List</h3>
                        <small>List of Quotes - Awaiting Review, Accepted, Rejected!</small>
                    </div>
                </section>
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel panel-default">
                            <header class="panel-heading">
                                <!--span class="label bg-danger pull-right m-t-xs">3 Rejected</span>
                                <span class="label bg-success pull-right m-t-xs m-r-xs">10 Accepted</span>
                                <span class="label bg-warning pull-right m-t-xs m-r-xs">16 Awaiting Review</span-->
                                <div class="row">
                                    <div class="col-sm-12">
                                        <span class="h5 font-bold">Quotation List</span>
                                    </div>
                                </div>
                            </header>
                            <div class="col-md-4 m-t-sm">
                                <div class="m-t-xs m-b-n-sm">
                                    <div class="checkbox-inline i-checks">
                                        <label><input class="order_filter" id="f_pending" type="checkbox" name="order_status[]" value="<?php echo ORDER_PENDING; ?>"> <i></i> <span class="text-left">Reviewed</span> </label>
                                    </div>
                                    <div class="checkbox-inline i-checks">
                                        <label><input class="order_filter" id="f_due" type="checkbox" name="due" value="1"> <i></i> <span class="text-left">Accepted</span> </label>
                                    </div>
                                    <div class="checkbox-inline i-checks">
                                        <label><input class="order_filter" id="f_completed" type="checkbox" name="order_status[]" value="<?php echo ORDER_COMPLETED; ?>"> <i></i> <span class="text-left">Rejected</span> </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-5 m-b-sm m-t-sm">
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
                            <div class="col-sm-3 m-b-sm m-t-sm">
                                <div class="input-group">
                                    <input type="search" class="input-sm form-control" name="keyword" placeholder="Search">
                                    <span class="input-group-btn">
                                        <input class="btn btn-sm btn-default" name="search" type="submit" value="Go!">
                                    </span>
                                </div>
                            </div>
                            <table class="table table-striped m-b-none">
                                <thead>
                                    <tr>
                                            <!-- <th class="hidden-xs" width="20"><label class="checkbox m-n i-checks"><input type="checkbox"><i></i></label></th> -->
                                        <th>Quote ID</th>
                                        <th class="hidden-xs">Date</th>
                                        <th class="hidden-xs">Name</th>
                                        <th class="hidden-xs">Title</th>
                                        <th class="text-center hidden-xs">Quantity</th>
                                        <th class="text-center">Unit Price</th>
                                        <th class="text-center">Total Price</th>
                                        <th class="text-center hidden-xs">TAT</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>

                                </thead>
                                <tbody id="quoteslist_box">
                                    <?php
                                    if ($quotes):
                                        foreach ($quotes as $quote) {
                                            ?>
                                            <tr>
                                                    <!-- <td class="hidden-xs">
                                                            <label class="checkbox m-n i-checks"><input type="checkbox" name="ids[]"><i></i></label>
                                                    </td> -->
                                                <td><a class="orderid_ellipse" data-toggle="ajaxModal" href="<?php echo site_url('/admin_ajax/popup_quote_details'); ?>/?quote_id=<?php echo $quote['quote_id']; ?>">
                                                        <span class="normal qut"><?php echo $quote['quote_id']; ?></span>
                                                        <span class="fullid text-success"><?php echo $quote['quote_id']; ?></span>
                                                    </a></td>
                                                <td class="hidden-xs"><?php echo $quote['quote_date']; ?></td>
                                                <td class="hidden-xs"><?php echo $quote['user_profile']->fullname; ?></td>
                                                <td class="hidden-xs"><?php echo truncate($quote['title'], 100, 30); ?></td>
                                                <td class="text-center hidden-xs"><?php echo $quote['quantity']; ?></td>
                                                <td class="text-center"><?php echo ($quote['is_flat_rate'] == 0) ? "N/A" : "$" . $quote['unit_price']; ?></td>
                                                <td class="text-center">$<?php echo $quote['total_price']; ?></td>
                                                <td class="text-center hidden-xs"><?php echo ($quote['tat'] == 0) ? 'FX' : $quote['tat'] . 'H'; ?> </td>
                                                <?php if (isset($quote['accepted'])): ?>
                                                    <td class="text-center"><span class="label bg-success m-t-xs">Accepted</span></td>
                                                    <td class="text-right">&nbsp;</td>
                                                <?php endif; ?>
                                                <?php if (isset($quote['rejected'])): ?>
                                                    <td class="text-center"><span class="label bg-danger m-t-xs">Rejected</span></td>
                                                    <td class="text-right">&nbsp;</td>
                                                <?php endif; ?>
                                                <?php if (isset($quote['reviewed'])): ?>
                                                    <td class="text-center"><span class="label bg-warning m-t-xs">Reviewed</span></td>
                                                    <td class="text-right">
                                                        <!-- <a href="javascript:void(0)" onclick="" class="btn btn-xs btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="Undo Review">
                                                                <i class="i i-cross2"></i>
                                                        </a> -->
                                                        <a href="javascript:void(0)" onclick="" class="btn btn-xs btn-default disabled" data-toggle="tooltip" data-placement="top" title="Undo Review">
                                                            <i class="fa fa-pencil"></i>&nbsp;Edit
                                                        </a>
                                                    </td>
                                                <?php endif; ?>
                                                <?php if (isset($quote['waiting'])): ?>
                                                    <td class="text-center"><span class="label bg-light dker m-t-xs">Pending</span></td>
                                                    <td class="text-right">
                                                        <a data-toggle="ajaxModal" href="<?php echo site_url('/admin_ajax/make_review'); ?>/?quote_id=<?php echo strtolower($quote['quote_id']); ?>" class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" title="Review Quotes">Review</a>
                                                    </td>
                                                <?php endif; ?>
                                            </tr>
                                            <?php
                                        }
                                    endif;
                                    ?>
                                </tbody>
                            </table>
                            <footer class="panel-footer">
                                <div class="row">
                                    <div class="col-sm-4 hidden-xs">

                                    </div>
                                    <div class="col-sm-4 text-center">
                                        <small class="text-muted inline m-t-sm m-b-sm"><?php echo (isset($showing)) ? $showing : ''; ?></small>
                                    </div>
                                    <div class="col-sm-4 text-right text-center-xs">                
                                        <ul class="pagination pagination-sm m-t-none m-b-none">
                                            <?php echo (isset($pagination)) ? $pagination : ''; ?>
                                        </ul>
                                    </div>
                                </div>
                            </footer>
                        </section>
                    </div>
                </div>
            </section>
        </section>
    </section>

</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>


<script type="text/javascript">
    $(document).ready(function () {
        //Portal.PageInit.Quotations();
    });
</script>
