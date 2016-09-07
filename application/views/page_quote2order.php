<section class="vbox">
    <section class="">
        <section class="hbox stretch">
            <aside class="col-lg-4 m-r-n m-l-n no-padder bg-light lter b-r drop_files">
                <section class="vbox">
                    <section class="scrollable">
                        <div class="wrapper">
                            <section class="panel no-border m-n bg-light dker">
                                <div class="col-lg-12 no-padder m-b-sm">
                                    <div id="dropzone">
                                        <form action="<?php echo site_url('ajax/uploader'); ?>" class="dropzone dz-clickable" id="file-upload" enctype="multipart/form-data">
                                            <div class="dz-default dz-message"><span>Click or drop your files here!</span></div>
                                        </form>
                                    </div>
                                </div>
                            </section>  
                        </div>
                    </section>
                </section>
            </aside>

            <aside class="col-lg-8 b-l no-padder job_details">
                <section class="vbox">
                    <section class="scrollable">
                        <form id="quote2order_form" action="" method="post" name="quote2order_form">
                            <!-- Hidden Params -->
                            <input type="hidden" name="order_id" value="<?php echo (isset($order_id)) ? $order_id : ''; ?>">
                            <input type="hidden" name="quote_id" value="<?php echo (isset($quote_data_data)) ? $quote_data_data->quote_id : ''; ?>">
                            <input type="hidden" name="service_id" value="<?php echo (isset($quote_data_data)) ? $quote_data_data->service_id : ''; ?>">
                            <!-- End: Hidden Params -->

                            <div class="col-lg-8 no-padder m-n">
                                <div class="wrapper">
                                    <!-- .breadcrumb -->
                                    <ul class="breadcrumb">
                                        <li><i class="i i-pencil2 m-r-xs"></i> Instructions / Job Details</li>
                                    </ul>
                                    <!-- / .breadcrumb -->
                                    <!-- left tab -->
                                    <section class="panel panel-default">
                                        <div class="panel-body">

                                            <div class="h6 text-left font-bold m-b-n m-t-xs"><span class="text-success">Job Title &amp; Message</span></div>
                                            <hr>
                                            <div class="form-group">
                                                <input type="text" name="job_title" class="form-control parsley-validated block" data-required="true" placeholder="Job Title">
                                            </div>
                                            <div class="form-group">
                                                <textarea name="job_desc" class="form-control input-sm block" rows="6" data-minwords="6" placeholder="Message (Further instructions if any...)"></textarea>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>

                            <div class="col-lg-4 no-padder m-n clearfix">
                                <div class="wrapper" id="sidebar">
                                    <!-- .breadcrumb -->
                                    <ul class="breadcrumb">
                                        <li><i class="fa fa-dollar m-r-xm"></i> Summary &amp; Payment</li>
                                    </ul>
                                    <!-- / .breadcrumb -->
                                    <section class="panel panel-default">
                                        <div class="wrapper">
                                            <div class="form-horizontal">
                                                <div class="form-group m-b-none">
                                                    <div class="col-sm-12 m-b-none">
                                                        <div class="h6 text-left font-bold m-t-md m-b-n"><span class="text-info">Cost Calculation</span></div>
                                                        <hr>
                                                        <div id="costing_box" class="m-t-n">
                                                            <div class="hbox b-b b-light m-b-xs">
                                                                <span class="pull-left">Image Quantity</span><span class="pull-right text-success" id="total_images">0</span>
                                                            </div> 
                                                            <div id="cp_pricing" class="hbox b-b b-light m-b-xs">
                                                                <span class="pull-left">Flat Rate:</span><span class="pull-right text-success" id="flat_rate" data-flatrate="<?php echo (isset($quote_data_data)) ? $quote_data_data->unit_price : 0; ?>">$<?php echo (isset($quote_data_data)) ? $quote_data_data->unit_price : 0; ?></span>
                                                            </div>
                                                            <div class="hbox font-bold m-b-xs">
                                                                <span class="pull-left">Total Price:</span><span class="pull-right text-success" id="total_price">$0.00</span>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix both"></div>
                                                        <div class="h6 text-left font-bold m-b-n m-t"><span class="text-info">Payment Form</span></div>
                                                        <hr>
                                                        <div class="m-t-n">
                                                            <label class="radio i-checks">
                                                                <input id="pay_now" checked="" name="payment_option" value="Pay Now" type="radio"><i></i>I will pay now
                                                            </label>
                                                            <label class="radio i-checks">
                                                                <input id="pay_later" name="payment_option" value="Pay Later" type="radio"><i></i>I will pay later - <span class="text-success" data-toggle="tooltip" data-placement="top" data-title="Please select if you want to pay us monthly basis.">Monthly</span>
                                                            </label>
                                                        </div>
                                                        <div class="clearfix noheight"></div>
                                                        <div id="payment_method">
                                                            <div class="h6 text-left font-bold m-b-n m-t-md"><span class="text-info">Payment Method</span></div>
                                                            <hr class="m-b-none">
                                                            <div class="row">
                                                                <div class="col-xs-6 m-l-n p-r-none">
                                                                    <label class="radio i-checks">
                                                                        <input id="paypal" name="payment_method" value="PayPal" checked="" type="radio">
                                                                        <i></i>
                                                                        <img src="<?php echo base_url(); ?>assets/images/paypal.png" alt="PayPal" />
                                                                    </label>
                                                                </div>
                                                                <div class="col-xs-6 m-r p-r-none">
                                                                    <label class="radio i-checks">
                                                                        <input id="payza" name="payment_method" value="Payza" type="radio">
                                                                        <i></i>
                                                                        <img src="<?php echo base_url(); ?>assets/images/payza.png" alt="Payza" />
                                                                    </label>
                                                                </div>
                                                            </div>    
                                                        </div>
                                                        <div class="m-t">
                                                            <button type="submit" id="btn_order_submit" class="btn btn-primary btn-block">Pay Now</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </form>
                        <div class="col-lg-8 no-padder m-n clearfix">
                            <div class="wrapper">
                                <!-- .breadcrumb -->
                                <ul class="breadcrumb">
                                    <li><i class="i i-pencil2 m-r-xs"></i> Quote Details</li>
                                </ul>
                                <!-- / .breadcrumb -->
                                <!-- left tab -->
                                <section class="panel panel-default">
                                    <div class="panel-body">

                                        <table id="quote_details" class="table table-striped">
                                            <tbody>
                                                <tr>
                                                    <td>Quote Title</td>
                                                    <td><?php echo $quote_data->quote_title; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Quote Description</td>
                                                    <td><?php
                                                        echo (!empty($quote_data->quote_desc)) ? $quote_data->quote_desc . '<br>' : '';
                                                        echo job_options($quote_data, $flag = NULL);
                                                        ?></td>
                                                </tr> 
                                                <tr>
                                                    <td>Service Type</td>
                                                    <td><?php echo ucfirst($quote_data->service_type); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Image Quantity</td>
                                                    <td><?php echo $quote_data->quantity; ?></td>
                                                </tr>
                                                <?php if (!empty($quote_data->unit_price)): ?>
                                                    <tr>
                                                        <td>Unit Price</td>
                                                        <td>$<?php echo $quote_data->unit_price; ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                                <tr>
                                                    <td>Total Price</td>
                                                    <td>$<?php echo $quote_data->total_value; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>File Format</td>
                                                    <td><?php echo $quote_data->return_file_format; ?></td>
                                                </tr>
<!--                                                <tr>
                                                    <td>Return File Format</td>
                                                    <td><?php echo ($quote_data->turnaround_time == 0) ? 'Flexible' : $quote_data->turnaround_time . ' Hours'; ?></td>
                                                </tr>-->
                                            </tbody>
                                        </table>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </section>
                </section>
            </aside>
        </section>
    </section>
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>

<script type="text/javascript">
    $(document).ready(function () {


        $("input[name=payment_option]").on("change", function () {
            if ($(this).val() == 'Pay Later') {
                $("#payment_method").hide();
            } else {
                $("#payment_method").show();
            }
        });

        Dropzone.options.fileUpload = {
            init: function () {
                this.on("addedfile", function (file) {
                });

                this.on("success", function (file, response) {
                    file.serverId = response;
                    if (response.status == "OK") {
                        var preview = response.preview[0];
                        file.previewElement.querySelector("img").src = preview;
                    }

                    if (response.status == "KO" && response.code == "318") {
                        console.log(response.msg);
                    }
                    total_images += 1;

                    $("#total_images").text(total_images);
                    var flat_rate = $("#flat_rate").data('flatrate');
                    var total = (total_images * flat_rate).toFixed(2);

                    $("#total_price").html('$' + total);
                });

                this.on("removedfile", function (file) {
                    total_images -= 1;

                    var flat_rate = $("#flat_rate").data('flatrate');
                    var total = (total_images * flat_rate).toFixed(2);

                    $("#total_images").text(total_images);
                    $("#total_price").html('$' + total);


                    $.ajax({
                        url: ajax_url + "/remove_tmp_file",
                        data: file.serverId,
                        type: 'POST',
                        dataType: 'JSON',
                        success: function (data) {

                        },
                        error: function (data) {
                        }
                    });
                });
            },
            url: "<?php echo site_url('ajax/uploader/') . '?order_id=' . $order_id; ?>",
            paramName: "file",
            maxFilesize: 256, // MB
            addRemoveLinks: true,
            maxFiles: 5000,
            maxThumbnailFilesize: 0.1, //MB
            //acceptedFiles: "image/*,.psd,.ai,.eps,.tif,.tiff,.pdf,.PSD,.AI,.EPS,.TIF,.TIFF,.PDF",
            acceptedFiles: "image/*",
        };
    });


</script>

