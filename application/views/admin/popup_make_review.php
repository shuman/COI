<div class="modal-dialog">
    <div class="modal-content">
        <form id="submit_flatrate" action="" method="post" role="form">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo lang('msg_5'); ?></h4>
            </div>
            <div class="modal-body">
                <?php
                if (isset($quote) && !empty($quote)) {
                    //var_dump($quote);
                    ?>
                    <input type="hidden" name="service_id" value="<?php echo $quote->service_id; ?>" />
                    <input type="hidden" name="quote_id" value="<?php echo $quote->quote_id; ?>" />
                    <table class="table table-striped" >
                        <thead>
                            <tr>
                                <th class="v-top n-b"><label>Title</label></th>
                                <th class="v-top n-b">
                                    <input type="text" name="title" value="<?php echo $quote->quote_title; ?>" class="form-control">
                                </th>
                            </tr>
                            <tr>
                                <th class="v-top n-b"><label>Set Flat Rate</label></th>
                                <th class="v-top n-b">	
                                        <!-- <input type="text" name="title" class="form-control pull-left" required> -->
                                    <input type="number" step="any" name="flat_rate" class="form-control block m-b-md flat-rate-value" required />
                                    <span class="err-message"></span>
                                </th>
                            </tr>
                            <tr>  
                                <th class="v-top n-b"></th><th class="v-top n-b"> 
                                    <input type="button" class="btn btn-primary pull-left flatRate" value="Submit"/>
                                </th>
                            </tr>
                            <tr>  
                                <th class="v-top n-b"></th>
                                <th class="v-top n-b"> 
                                    <span class="msg"></span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <a id="show_details" class="label bg-success pull-right" href="javascript:void(0)">Show Details</a>
                    <table id="quote_details" class="table table-striped" style="display:none;">
                        <tbody>
                            <tr>
                                <td>Order ID</td>
                                <td><?php echo $quote->quote_id; ?></td>
                            </tr>
                            <tr>
                                <td>Quote Title</td>
                                <td><?php echo $quote->quote_title; ?></td>
                            </tr>
                            <tr>
                                <td>Quote Description</td>
                                <td><?php
                                    echo (!empty($quote->quote_desc)) ? $quote->quote_desc . '<br>' : '';
                                    echo job_options($quote, $flag = NULL);
                                    ?></td>
                            </tr>
                            <?php if (!empty($quote->quote_date)): ?>
                                <tr>
                                    <td>Order Date</td>
                                    <td><?php echo date("F d, Y", strtotime($quote->quote_date)); ?></td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <td>Quote Status</td>
                                <td><?php echo quote_status2text($quote->quote_status); ?></td>
                            </tr>
                            <tr>
                                <td>Service Type</td>
                                <td><?php echo ucfirst($quote->service_type); ?></td>
                            </tr>
                            <tr>
                                <td>Image Quantity</td>
                                <td><?php echo $quote->quantity; ?></td>
                            </tr>
                            <?php if (!empty($quote->unit_price)): ?>
                                <tr>
                                    <td>Unit Price</td>
                                    <td>$<?php echo $quote->unit_price; ?></td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <td>Total Price</td>
                                <td>$<?php echo $quote->total_value; ?></td>
                            </tr>
                            <tr>
                                <td>Return File Format</td>
                                <td><?php echo $quote->return_file_format; ?></td>
                            </tr>
                            <tr>
                                <td>Return File Format</td>
                                <td><?php echo ($quote->turnaround_time == 0) ? 'Flexible' : $quote->turnaround_time . ' Hours'; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <?php
                }
                else {
                    echo 'Quote not found!';
                }
                ?>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-default" data-dismiss="modal" value="Close" />
            </div>
        </form>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $(document).on("click", "#show_details", function () {
            $(this).addClass('hide');
            $('#quote_details').slideDown();
        });
        $('.flat-rate-value').on('change', function () {
            if ($(this).val().length > 0) {
                $('.flat-rate-value').css('border', '1px solid #ccc');
                $('.err-message').removeClass('text-danger').show().html('');
                return true;
            }
        });
        $('.flatRate').on('click', function () {
            var flat_rate = $('.flat-rate-value').val(),
                    service_id = $('input[name="service_id"]').val(),
                    quote_id = $('input[name="quote_id"]').val();
            if (flat_rate === '' || flat_rate === 0) {
                $('.flat-rate-value').css('border', '1px solid #e33244');
                $('.err-message').addClass('text-danger').show().html('<i class="fa fa-exclamation-triangle"></i> Fillup Flat Rate field.');
                return false;
            }
            $.ajax({
                url: '/admin_ajax/set_flat_rate',
                type: 'post',
                dataType: 'json',
                data: {
                    flat_rate: flat_rate,
                    quote_id: quote_id,
                    service_id: service_id
                },
                beforeSend: function (xhr) {
                    $('#ajaxModal .btn').addClass('disabled');
                    setTimeout(function () {
                        $('#ajaxModal .btn').removeClass('disabled');
                    }, 4000);
                    $('.msg').removeClass('text-danger').addClass('text-success').show().html('<i class="fa fa-spinner fa-spin"></i> Processing. Please wait...');
                },
                success: function (data, textStatus, jqXHR) {
                    if (data.status === 'OK') {
                        setTimeout(function () {
                            $('.msg').html('<i class="fa fa-check-square"></i> Success! Please wait for page refresh...');
                            window.location.reload();
                        }, 5000);
                    }
                }
            });
        });
    });
</script>