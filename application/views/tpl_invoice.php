<!DOCTYPE html>
<html>
    <head>
        <title>Invoice PDF</title>
        <meta charset="utf-8">
        <link type="text/css" href="<?php echo base_url(); ?>/assets/css/bootstrap.css" rel="stylesheet">
        <link type="text/css" href="<?php echo base_url(); ?>/assets/css/animate.css" rel="stylesheet">
        <link type="text/css" href="<?php echo base_url(); ?>/assets/css/font-awesome.min.css" rel="stylesheet">
        <link type="text/css" href="<?php echo base_url(); ?>/assets/css/icon.css" rel="stylesheet">
        <link type="text/css" href="<?php echo base_url(); ?>/assets/css/font.css" rel="stylesheet">
        <link type="text/css" href="<?php echo base_url(); ?>/assets/css/app.css" rel="stylesheet">  
        <link type="text/css" href="<?php echo base_url(); ?>/assets/css/custom.css" rel="stylesheet">  

        <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
        <!--[if lt IE 9]>
    <script src="<?php echo base_url(); ?>js/ie/html5shiv.js"></script>
    <script src="<?php echo base_url(); ?>js/ie/respond.min.js"></script>
    <script src="<?php echo base_url(); ?>js/ie/excanvas.js"></script>
    <![endif]-->
    </head>
    <body>
        <div style="width:612px; margin:50px auto; box-shadow: 0 0 50px #CCC;">
            <section id="invoice" class="vbox bg-white">
                <header class="header b-b b-light p-hide">
                    <button onclick="window.print();" class="btn btn-sm btn-info" href="#">Print</button>

                    <?php
                    if ($invoice_info->payment_status == 0) {
                        ?>
                        <div class="btn-group pull-right p-hide">
                            <button data-toggle="dropdown" class="btn btn-danger btn-sm dropdown-toggle pull-right" type="button">Pay Now <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a onclick="Portal.wait();" href="<?php echo site_url('/paypal_payment/' . $invoice_info->order_id); ?>"><img src="<?php echo base_url(); ?>assets/images/pay-with-pp.png"/></a></li>
                                <li class="hide"><a onclick="Portal.wait();" href="<?php echo site_url('/payza_payment/' . $invoice_info->order_id); ?>"><img src="<?php echo base_url(); ?>assets/images/pay-with-2co.png"/></a></li>
                            </ul>
                            <span class="pstat unpaid pull-left">Unpaid</span>
                        </div>
                        <?php
                    } else {
                        echo '<div class="btn-group pull-right"><span class="pstat paid">Paid</span></div>';
                    }
                    ?>
                </header>
                <section class="scrollable wrapper">
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
                                <?php echo (!empty($company->vat_id)) ? "VAT ID: {$company->vat_id}" : ''; ?>
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
                    <p class="m-t m-b">
                        Order Date: <strong><?php echo date("F d, Y", strtotime($invoice_info->order_date)); ?></strong><br>
                        Order Status: <?php
                        if ($invoice_info->order_status == ORDER_COMPLETED) {
                            ?>
                            <span class="btn btn-success btn-xs m-r-xs">Completed</span>
                            <a title="Download" class="btn btn-xs btn-icon btn-info" href="<?php echo site_url('/'); ?>download?key=<?php echo base64_encode($invoice_info->order_id); ?>">
                                <i class="fa fa-download"></i>
                            </a>
                            <?php
                        } else {
                            echo '<span class="label bg-warning">Pending</span>';
                        }
                        ?>
                        <br>
                        Order ID: <strong><?php echo get_key($invoice_info->order_id); ?></strong>
                        <br>
                        <?php if ($invoice_info->payment_status == 1) { ?>
                            Payment status: <span class="label bg-success m-t-xs">Paid</span>
                        <?php } else { ?> 
                            Payment Status: <span class="label bg-danger m-t-xs">Unpaid</span>
                        <?php } ?>
                    </p>
                    <div class="line"></div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="40">#</th>
                                <th>DESCRIPTION</th>
                                <th width="100" class="text-right">UNIT PRICE</th>
                                <th width="90" class="text-right">IMAGE QTY</th>
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
                </section>
            </section>
        </div>
    </body>
</html>
<script type="text/javascript">
    $(document).ready(function () {
        $('.noteDesc').hide();
        $('.seeNote').on('click', function () {
            $(this).next().slideToggle('.noteDesc');
        });
    });
</script>