<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title text-info m-l-md"><?php echo lang('invoice'); ?></h4>
        </div>
        <div class="modal-body">
            <div id="invoice" class="vbox bg-white">
                <div class="scrollable wrapper">
                    <div class="row">
                        <div class="col-xs-6">
                            <img src="<?php echo base_url(); ?>assets/images/logo-print.png">
                        </div>
                        <div class="col-xs-6 text-right">
                            <p class="h4">ID # <?php echo get_key($inv_id); ?></p>
                            <h5><?php echo date("F d, Y", strtotime($invoice_info->order_date)); ?></h5>           
                        </div>
                    </div>          
                    <div class="well m-t">
                        <div class="row">
                            <div class="col-xs-6">
                                <strong>INVOICE TO:</strong>
                                <?php echo company_address($company); ?>

                            </div>
                            <div class="col-xs-6">
                                <strong>PAY TO:</strong>
                                <h4 class="text-info"><strong>Cut Out Image</strong></h4>
                                <p>Plot # 05, Suite # A5, Road # 06 <br />
                                    Sector # 10, Uttara, Dhaka <br />
                                    <strong>Bangladesh</strong><br>
                                    Phone: +880 1977 288.688<br> 
                                    Email: <a href="mailto:hello@cutoutimage.com">hello@cutoutimage.com</a></p>
                            </div>
                        </div>
                    </div>
                    <p class="m-t m-b">Order Date: <strong><?php echo date("F d, Y", strtotime($invoice_info->order_date)); ?></strong><br>
                        Order ID: <strong><?php echo get_key($invoice_info->order_id); ?></strong><br>
                        Order Status: <?php
                        if ($invoice_info->order_status == ORDER_COMPLETED) {
                            ?>
                            <span class="label bg-success"><?php echo order_status2text($invoice_info->order_status); ?></span>
                            <a title="Download" data-placement="top" data-toggle="tooltip" class="label bg-info" target="_blank" href="<?php echo site_url('/download'); ?>?key=<?php echo base64_encode($invoice_info->order_id); ?>"><i class="fa fa-download text-white"></i></a>
                            <?php
                        } else if ($invoice_info->order_status == ORDER_CANCELLED) {
                            ?><span class="label bg-grey"><?php echo order_status2text($invoice_info->order_status); ?></span><?php
                            } else {
                                ?><span class="label bg-warning"><?php echo order_status2text($invoice_info->order_status); ?></span><?php
                        }
                        ?>
                    </p>
                    <div class="line"></div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="40">#</th>
                                <th>DESCRIPTION</th>
                                <th width="100" class="text-right">UNIT PRICE</th>
                                <th width="60" class="text-right">QTY</th>
                                <th width="90" class="text-right">TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 0;
                            $total = 0;
                            if ($services) : foreach ($services as $service) :
                                    $count++;
                                    $total += $service->total_value;
                                    ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td>
                                            <strong><?php echo $service->job_title; ?></strong>
                                            <div class="well breakdown"><?php echo job_options($services[0], $flag = 'email'); ?></div>
                                        </td>
                                        <td class="text-right">$<?php echo $service->unit_price; ?></td>
                                        <td class="text-right"><?php echo $service->quantity; ?></td>
                                        <td class="text-right">$<?php echo number_format($service->total_value, 2, '.', ''); ?></td>
                                    </tr>
                                    <?php
                                endforeach;
                            endif;
                            ?>
                            <tr>
                                <td class="text-right no-border" colspan="4"><strong>Gross Total</strong></td>
                                <td class="text-right"><strong>$<?php echo number_format($total, 2, '.', ''); ?></strong></td>
                            </tr>
                        </tbody>
                    </table>              
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('.noteDesc').hide();
        $('.seeNote').on('click', function () {
            $(this).next().slideToggle('.noteDesc');
        });
    });
</script>