<div class="modal-dialog">
    <div class="modal-content">
        <?php
        if ($success) {
            // var_dump($order);
            // echo '<pre>';
            // print_r($order);
            // echo '</pre>';
            ?>
            <form action="" method="post" role="form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-success"><?php echo lang('order_details'); ?>&nbsp;&nbsp;#<?php echo get_key($order->order_id); ?></h4>
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
                                        <span class="label bg-success "><?php echo order_status2text($order->order_status); ?></span>
                                        <a title="Download" data-placement="top" data-toggle="tooltip" class="label bg-info inline" target="_blank" href="<?php echo site_url('/download'); ?>?key=<?php echo base64_encode($order->order_id); ?>">
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
                                <td class="b-r"><span class=" label bg-info m-t-xs"><?php echo $order->order_quantity; ?></span></td>
                                <td><strong>Total Price</strong></td>
                                <td>$<?php echo $order->total_value; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Unit Price</strong></td>
                                <td class="b-r"><strong>$<?php echo $order->unit_price; ?></strong></td>
                                <td><strong>Flat Rate</strong></td>
                                <td><?php echo $order->is_flat_rate; ?></td>

                            </tr>
                            <tr>
                                <td><strong>Format Value</strong></td>
                                <td class="b-r"><?php echo $order->return_file_format_value; ?></td>
                                <td><strong>Return File Format</strong></td>
                                <td><?php echo $order->return_file_format; ?></td>
                            </tr>

                            <tr >
                                <td colspan="4" style="width: 100% !important;">
                                    <?php
                                    // echo (!empty($order->order_desc)) ? $order->order_desc.'<br>' : '';
                                    echo job_options($order, $order_details_flag = NULL);
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
                            <!--        
                                                        <tr>
                            <?php if (!empty($order->fix_imperfection_note)): ?>
                                                                        <td><strong>Fix Imperfection</strong></td>
                                                                        <td colspan="3"><?php echo $order->fix_imperfection_note; ?></td>
                            <?php endif ?>
                                                        </tr>
                                                        <tr>
                            <?php if (!empty($order->cropping_resizing)): ?>
                                                                        <td><strong>Cropping & Resizing</strong></td>
                                                                        <td colspan="3"><?php echo $order->cropping_resizing; ?></td>
                            <?php endif ?>
                                                        </tr>
                                                        <tr>
                            <?php if (!empty($order->cropping_resizing_note)): ?>
                                                                        <td><strong>Cropping Description</strong></td>
                                                                        <td colspan="3"><?php echo $order->cropping_resizing_note; ?></td>
                            <?php endif ?>
                                                        </tr>
                                                        <tr>
                            <?php if (!empty($order->complete_date)): ?>
                                                                        <td colspan="2"><strong>Complete Date</strong></td>
                                                                        <td colspan="2"><?php echo date("M d, Y", strtotime($order->complete_date)); ?></td>
                            <?php endif; ?>
                                                        </tr>-->
                        </tbody>
                    </table>
                    <?php
                }
                else {
                    echo 'Invalid order ID';
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