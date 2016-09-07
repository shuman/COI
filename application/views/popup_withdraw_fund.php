<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-danger m-l-xs">Withdraw Funds</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-12">
                    <p class="ar-text-justify">You can withdraw funds available on your account as <strong>Credit</strong>. You can request partial withdrawal of your remaining credit or in full.</p>

                    <p class="ar-text-justify"><strong>Note:</strong> Please remember that transfer will only be processed through PayPal. You may not receive the exact amount you request due to foreign exchange conversion and gateway charges which may be deducted by merchant service providers.</p>
                    

                    <div class="line line-dashed b-b line-lg"></div>
                    <div class="form-group row"> 
                        <div class="col-sm-2">
                            <label class="p-t-xs">Amount</label>
                        </div>
                        <div class="col-sm-3 b-r b-light"> 
                            <div class="input-group"> 
                                <!-- <span class="input-group-addon">US $</span>  -->
                                <input type="number" step="any" name="add_fund" class="form-control block" required> 
                                <span class="input-group-addon">$</span> 
                            </div>
                        </div> 
                        <div class="col-sm-4 ar-text-right">
                            <label class="p-t-xs">You can withdraw upto</label>
                        </div>
                        <div class="col-sm-3"> 
                            <div class="input-group"> 
                                <!-- <span class="input-group-addon">US $</span>  -->
                                <input type="text" step="any" name="remaining_add" class="form-control block" placeholder="124.50" disabled> 
                                <span class="input-group-addon">$</span> 
                            </div>
                        </div> 
                    </div>

                    <div class="line line-dashed b-b line-md"></div>
                    
                    
                    <div class="well m-t-lg">
                        <div class="row">
                            <div class="col-xs-12 ar-text-center">
                                <div class="input-group"> 
                                    <span class="input-group-addon text-black">PayPal Email ID:</span> 
                                    <input type="email" class="form-control" placeholder="e.g. accounts@cutoutimage.com"> 
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr/>
                    <button class="btn btn-sm btn-danger" data-dismiss="modal" >Close</button>
                    <button class="btn btn-sm btn-info pull-right" data-dismiss="modal" >Submit Withdrawal Request</button>
                </div>
            </div>
        </div>
    </div>
</div>