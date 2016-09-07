<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-info m-l-xs">Add Funds</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-12">
                    <p class="ar-text-justify">You can add funds on your account which you can use while submitting an order. It is useful when you want your manager to submit an order on behalf of you and pay from your account's Credit. Adding funds is not mandatory but it helps. </p>

                    <p class="ar-text-justify"><strong>Note:</strong> Please select one of the following Sources / Methods of fund. Please remember that you can add funds upto $1000 and minimum amount you can add is 10$.</p>
                    

                    <div class="line line-dashed b-b line-lg"></div>
                    <div class="form-group row"> 
                        <div class="col-sm-2">
                            <label class="p-t-xs">Amount</label>
                        </div>
                        <div class="col-sm-5 b-r b-light"> 
                            <div class="input-group"> 
                                <!-- <span class="input-group-addon">US $</span>  -->
                                <input type="number" step="any" name="add_fund" class="form-control block" required> 
                                <span class="input-group-addon">$</span> 
                            </div>
                        </div> 
                        <div class="col-sm-2 ar-text-right">
                            <label class="p-t-xs">Add Upto</label>
                        </div>
                        <div class="col-sm-3"> 
                            <div class="input-group"> 
                                <!-- <span class="input-group-addon">US $</span>  -->
                                <input type="text" step="any" name="remaining_add" class="form-control block" placeholder="875.50" disabled> 
                                <span class="input-group-addon">$</span> 
                            </div>
                        </div> 
                    </div>

                    <div class="line line-dashed b-b line-md"></div>
                    
                    <br />
                    
                    <div class="well m-t">
                        <div class="row">
                            <div class="col-xs-6 ar-text-center">
                                <a href="#"><img src="<?php echo base_url();?>assets/images/pay-with-pp-big.png" width="220"></a>
                            </div>
                            <div class="col-xs-6 ar-text-center">
                                <a href="#"><img src="<?php echo base_url();?>assets/images/pay-with-2co-big.png" width="220"></a>
                            </div>
                        </div>
                    </div>

                    <hr/>
                    <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal" >Close</button>
                </div>
            </div>
        </div>
    </div>
</div>