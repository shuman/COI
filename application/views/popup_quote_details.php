<div class="modal-dialog">
    <div class="modal-content">
        <form action="" method="post" role="form">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-success">Quote Details</h4>
            </div>
            <div class="modal-body">
                <?php
                if ($success) {
                    // var_dump($quote);
                    ?>
                    <table class="table table-striped m-b-none">
                        <thead>
                            <tr>
                                <th colspan="4">Quote Title :&nbsp; <?php echo $quote->quote_title; ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Quote ID</strong></td>
                                <td class="b-r"><?php echo get_key($quote->quote_id); ?></td>
                                <?php if (!empty($quote->quote_date)): ?>
                                    <td><strong>Quote Date</strong></td>
                                    <td><?php echo date("F d, Y", strtotime($quote->quote_date)); ?></td>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <td><strong>Complete Date</strong></td>
                                <td class="b-r">
                                    <?php if (!empty($quote->complete_date)): ?>
                                        <?php echo date("F d, Y", strtotime($quote->complete_date)); ?>
                                    <?php endif; ?>
                                </td>
                                <td><strong>Quote Status</strong></td>
                                <td><?php echo quote_status2text($quote->quote_status); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Job Type</strong></td>
                                <td class="b-r"><?php echo ucfirst($quote->service_type); ?></td>
                                <td><strong>Image Quantity</strong></td>
                                <td><?php echo $quote->quantity; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Unit Price</strong></td>
                                <td class="b-r">$<?php echo $quote->unit_price; ?></td>
                                <td><strong>Total Price</strong></td>
                                <td>$<?php echo $quote->total_value; ?></td>
                            </tr>
                            <tr>
                                <td nowrap=""><strong>Return File Format</strong></td>
                                <td class="b-r"><?php echo $quote->return_file_format; ?></td>
                                <td><strong>Turnaround Time</strong></td>
                                <td><?php echo ($quote->turnaround_time == 0) ? 'Flexible' : $quote->turnaround_time . ' Hours'; ?></td>
                            </tr>
                            <tr>
                                <td colspan="2"><strong>Service Type</strong></td>
                                <td colspan="2"><?php
                                    echo job_options($quote, $flag = NULL);
                                    ?></td>
                            </tr>
                            <tr>
                                <td colspan="2"><strong>Job Description</strong></td>
                                <td colspan="2"><?php echo (!empty($quote->quote_desc)) ? $quote->quote_desc . "<br/>" : ''; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <?php
                }
                else {
                    echo 'Invalid quote ID';
                }
                ?>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-danger" data-dismiss="modal" value="Close" />
            </div>
        </form>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->