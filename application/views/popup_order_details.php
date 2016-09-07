<div class="modal-dialog">
    <div class="modal-content">
        <?php
        if ($success) {
            // var_dump($order);
            //    echo '<pre>';
            //    print_r($order);
            //    echo '</pre>';
            ?>
            <form action="" method="post" role="form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-info m-l-xs"><?php echo lang('order_id_text'); ?>&nbsp;#<?php echo get_key($order->order_id); ?></h4>
                </div>
                <div class="modal-body p-b-none">

                    <table class="table table-striped m-b-none">
                        <thead>
                            <tr>
                                <th colspan="4" class="text-u-c"><?php echo lang('order_details'); ?> :&nbsp;&nbsp; <?php echo $order->order_title; ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php if (!empty($order->order_date)): ?>
                                    <td><strong>Order Date</strong></td>
                                    <td class="b-r"><?php echo date("M d, Y", strtotime($order->order_date)); ?></td>
                                <?php endif; ?>

                                <td><strong>Order Status</strong></td>
                                <td><?php
                                    if ($order->order_status == ORDER_COMPLETED) {
                                        ?>
                                        <span class="label bg-info"><?php echo order_status2text($order->order_status); ?></span>
                                        <a title="Download" data-placement="top" data-toggle="tooltip" class="label bg-dark" target="_blank" href="<?php echo site_url('/download'); ?>?key=<?php echo base64_encode($order->order_id); ?>">
                                            <i class="fa fa-download"></i> Download
                                        </a>
                                        <?php
                                    } else if ($order->order_status == ORDER_CANCELLED) {
                                        ?><span class="label bg-grey"><?php echo order_status2text($order->order_status); ?></span><?php
                                    } else {
                                        ?><span class="label bg-warning"><?php echo order_status2text($order->order_status); ?></span><?php
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Image Quantity</strong></td>
                                <td class="b-r"><span class="m-t-xs"><?php echo $order->order_quantity; ?></span></td>
                                <td><strong>Unit Price</strong></td>
                                <td>$<?php echo $order->unit_price; ?></td>
                            </tr>

                            <tr>
                                <td><strong>Return File Format</strong></td>
                                <td class="b-r"><?php echo $order->return_file_format; ?></td>
                                <td><strong>Total Price</strong></td>
                                <td><strong>$<?php echo $order->total_value; ?></strong></td>

                            </tr>
                            <tr>
                                <td><strong>Turnaround Time</strong></td>
                                <td class="b-r"><?php echo ($order->turnaround_time == 0) ? 'Flexible' : $order->turnaround_time . ' Hours'; ?></td>
                                <td><strong>Delivered Date</strong></td>
                                <td>
                                    <?php
                                    if (!empty($order->complete_date))
                                        echo date("M d, Y", strtotime($order->complete_date));
                                    else {
                                        echo 'Not Delivered Yet';
                                    }
                                    ?>
                                </td>
                            </tr>
                                                       
                            <tr>
                                <td colspan="4" style="width: 100% !important;">
                                    <?php
                                    // echo (!empty($order->order_desc)) ? $order->order_desc.'<br>' : '';
                                    echo job_options($order,$history='history');
                                    ?>
                                </td>

                            </tr>
                            <tr>
                                <td colspan="4" class="text-justify">
                                    <br />
                                    <strong>Order Note:</strong>
                                    <?php
                                    echo (!empty($order->order_desc)) ? $order->order_desc . '<br>' : '';
                                    ?>
                                    <br />
                                </td>

                            </tr>
                            <tr>
                                <td colspan="2"><strong>Payment Status</strong></td>
                                <td colspan="2">
                                    <span class="pstat unpaid pull-left"><?php echo (!empty($order->payment_status) == 0) ? "Unpaid" : "Paid"; ?></span>
                                    <div class="btn-group pull-right">
                                        <button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle" type="button">Pay Now <span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li><a onclick="Portal.wait();" href="<?php echo site_url('paypal_payment'); ?>/<?php echo $order->order_id; ?>"><img src="<?php echo base_url(); ?>assets/images/pay-with-pp.png"/></a></li>
                                            <li class="hide"><a onclick="Portal.wait();" href="<?php echo site_url('paypal_payment'); ?>/<?php echo $order->order_id; ?>"><img src="<?php echo base_url(); ?>assets/images/pay-with-2co.png"/></a></li>
                                        </ul>
                                    </div>

                                </td>

                            </tr>
    
                        </tbody>
                    </table>
                    <?php
                }
                else {
                    echo 'Invalid Order ID';
                }
                ?>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-danger" data-dismiss="modal" value="Close" />
            </div>
        </form>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<script type="text/javascript">
    $(document).ready(function () {
        $('.noteDesc').hide();
        $('.seeNote').on('click', function () {
            $(this).next().slideToggle('.noteDesc');
        });
    });
</script>