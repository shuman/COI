<div class="modal-dialog">
  <div class="modal-content">
  	<form class="bs-example">
	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal">&times;</button>
	      <h4 class="modal-title text-success">Edit Order</h4>
	    </div>
	    <div class="modal-body">
        	<div class="row">
        		<div class="col-sm-12">
        			<div class="h6 text-left font-bold m-b-n-sm"><span class="text-info dker">Job Title</span></div>
	                <hr>
        			<div class="form-group">
	                    <input type="text" name="job_title" class="form-control parsley-validated block" placeholder="Job Title" 
	                    required value="<?php echo $order->order_title; ?>" />
	                </div>
	                
	                <div class="h6 text-left font-bold m-b-n-sm"><span class="text-info dker">Quantity</span></div>
	                <hr>
	                <div class="form-group">
        				<input type="number" name="o_quantity" class="form-control input-sm block" value="<?php echo (!empty($order->order_quantity)) ? $order->order_quantity : ''; ?>">
        			</div>
        		</div>
        	</div>
	        	
            <div class="row">
            	<div class="col-sm-6">
            		<div class="h6 text-left font-bold m-b-n-sm"><span class="text-info dker">File Format</span></div>
	                <hr>
	                <div class="form-horizontal"></div>
	                <div class="form-group m-t-n m-l-n">
	                    <div class="col-sm-12 m-b-md rf_format">
                    	<?php $f_array = explode('|', $order->return_file_format); ?>
	                        <label class="checkbox-inline i-checks">
	                            <input type="checkbox" class="o_rft" name="return_file_type[]" <?php echo (in_array('JPG', $f_array)) ? 'checked=""' : ''; ?> value="JPG" /><i></i>JPG
	                        </label>
	                        <label class="checkbox-inline i-checks">
	                            <input type="checkbox" class="o_rft" name="return_file_type[]" <?php echo (in_array('PNG', $f_array)) ? 'checked=""' : ''; ?> value="PNG" /><i></i>PNG
	                        </label>
	                        <label class="checkbox-inline i-checks">
	                            <input type="checkbox" class="o_rft" name="return_file_type[]" <?php echo (in_array('PSD', $f_array)) ? 'checked=""' : ''; ?> value="PSD" /><i></i> <span class="text-danger" data-toggle="tooltip" data-placement="top" title="Requesting PSD File will cost: ${{servicePrice.fileFormat.psd}} / Image in addition.">PSD!</span>
	                        </label>
	                        <label class="checkbox-inline i-checks">
	                            <input type="checkbox" class="o_rft" name="return_file_type[]" <?php echo (in_array('TIFF', $f_array)) ? 'checked=""' : ''; ?> value="TIFF" /><i></i> <span class="text-danger" data-toggle="tooltip" data-placement="top" title="Requesting TIFF File will cost: ${{servicePrice.fileFormat.tiff}} / Image in addition.">TIFF!</span>
	                        </label>
	                    </div>
	                </div>
            	</div>
            	<div class="col-sm-6">
            	 	<div class="h6 text-left font-bold m-b-n-sm text-info dker">Invisible Mannequin / Ghost 3D:</div>
            		<hr>
	                <div class="form-horizontal"></div>
	                <div class="form-group m-t-n m-l-n">
	                	 
	                	<div class="col-sm-12 m-b-md rf_format">
		                    <label class="radio-inline i-checks"><input type="radio" name="mannequin_option" <?php echo ($order->mannequin_option == '3D - Invisible ($0.80)') ? 'checked=""' : ''; ?> value="3D - Invisible ($0.80)"><i></i>3D - Invisible ($0.80)</label>
		                    <label class="radio-inline i-checks"><input type="radio" name="mannequin_option" <?php echo ($order->mannequin_option == 'none') ? 'checked=""' : ''; ?>  value="none" ><i></i>None</label>
	                	</div>
	                </div>
            		
            	</div>
            </div>
            <div class="row">
            	<div class="col-sm-6">
	                <div class="h6 text-left font-bold m-b-n-sm text-info dker">Shadow Adding :</div>
            		<hr>
            		<div class="form-horizontal"></div>
	                <div class="form-group m-t-n m-l-n">
		                <div class="col-sm-12 m-b-md rf_format">
		                    <div class="radio m-t-none i-checks"><label><input type="radio" name="shadow_option" <?php echo ($order->shadow_option == 'Drop Shadow ($2.5)') ? 'checked=""' : ''; ?> value="Drop Shadow ($2.5)"><i></i>Drop Shadow: <span class="text-info">$0.25</span></label></div>
		                    <div class="radio i-checks"><label><input type="radio" name="shadow_option" <?php echo ($order->shadow_option == 'Natural Shadow ($0.50)') ? 'checked=""' : ''; ?> value="Natural Shadow ($0.50)"><i></i>Natural Shadow: <span class="text-info">$0.50</span></label></div>
		                    <div class="radio i-checks"><label><input type="radio" name="shadow_option" <?php echo ($order->shadow_option == 'Reflection Shadow ($0.50)') ? 'checked=""' : ''; ?> value="Reflection Shadow ($0.50)"><i></i>Reflection Shadow: <span class="text-info">$0.50</span></label></div>
		                    <div class="radio i-checks"><label><input type="radio" name="shadow_option" <?php echo ($order->shadow_option == 'Mirror Effect ($0.50)') ? 'checked=""' : ''; ?> value="Mirror Effect ($0.50)"><i></i>Mirror Effect: <span class="text-info">$0.50</span></label></div>
		                    <div class="radio i-checks"><label><input type="radio" name="shadow_option" <?php echo ($order->shadow_option == '') ? 'checked=""' : ''; ?> value=""><i></i>None</label></div>
		                </div>
		            </div>
            	</div>
            	<div class="col-sm-6">
	               	<div class="h6 text-left font-bold m-b-n-sm text-info dker">Background Options:</div>
	                <hr>
	                <div class="form-horizontal"></div>
	                <div class="form-group m-t-n m-l-n">
	                    <div class="col-sm-12 m-b-md rf_format" style="min-height: 25px;">
	                        <label class="radio m-t-none i-checks">
	                            <input type="radio" name="cutout_bg_option" <?php echo ($order->bg_option == 'White BG') ? 'checked=""' : ''; ?> value="White BG" checked=""><i></i>White
	                        </label>
	                        <label class="radio i-checks">
	                            <input type="radio" name="cutout_bg_option" <?php echo ($order->bg_option == 'Transparent BG') ? 'checked=""' : ''; ?> value="Transparent BG"><i></i>Transparent
	                        </label>
	                        <label class="radio i-checks">
	                            <input type="radio" name="cutout_bg_option" <?php echo ($order->bg_option == 'Original') ? 'checked=""' : ''; ?> value="Original"><i></i>Original
	                        </label>
	                    </div>
	                </div>
            	</div>
            </div>
            <div class="row">
            	<div class="col-sm-6">
	                <div class="h6 text-left font-bold m-b-n-sm m-t text-info dker">Fix Imperfection :</div>
            		<hr>
            		<div class="form-horizontal"></div>
	                <div class="form-group m-t-n">
	                	<label class="checkbox i-checks">
	                        <input type="checkbox" name="brightness_value" <?php echo ($order->fix_imperfection == 0.50) ? 'checked=""' : ''; ?>  value="0.50"><i></i>Fix Imperfection (Basic) - <span class="text-info">$0.50</span>
	                    </label>
	                    <label class="checkbox i-checks">
	                        <input type="checkbox" name="staight_value" <?php echo ($order->straight_n_symmetric == 0.25) ? 'checked=""' : ''; ?> value="0.25" data-title="Straighten & Symmetric"><i></i>Straighten &amp; Symmetric - <span class="text-info">$0.25</span>
	                    </label>
	                    <div class="m-l-n m-r-n wrapper">
	                        <textarea name="fix_imperfection_desc" class="form-control input-sm block" rows="3" data-minwords="6" placeholder="Please write down your instructions and mention the imperfection that needs to be fixed."><?php echo (!empty($order->fix_imperfection_note)) ? $order->fix_imperfection_note : ''; ?></textarea>
	                    </div>
	                </div>
            	</div>
            	<div class="col-sm-6">
	                <div class="h6 text-left font-bold m-b-n-sm m-t text-info dker">Cropping & Resizing :</div>
            		<hr>
            		<div class="form-horizontal"></div>
	                <div class="form-group m-t-n">
	                	<label class="radio i-checks">
	                        <input type="radio" name="crop_resize" <?php echo ($order->cropping_resizing == 'Variation (Upto 1)') ? 'checked=""' : ''; ?> value="Variation (Upto 1)" ng-checked="resizingOn"><i></i>Variation (Upto 1): <span class="text-info">Free</span>
	                    </label>
	                    <label class="radio i-checks">
	                        <input type="radio" name="crop_resize" <?php echo ($order->cropping_resizing == 'Variation (Upto 3)') ? 'checked=""' : ''; ?> value="Variation (Upto 3)"><i></i>Variation (Upto 3): <span class="text-info">$0.25</span>
	                    </label>
	                    <label class="radio i-checks">
	                        <input type="radio" name="crop_resize" <?php echo ($order->cropping_resizing == '') ? 'checked=""' : ''; ?> value="" ><i></i> None
	                    </label>
	                    <div class="m-l-n m-r-n wrapper">
	                        <textarea name="crop_resize_desc" class="form-control input-sm block" rows="3" data-minwords="6" placeholder="Please write down your cropping &amp; resizing details here..."><?php echo (!empty($order->cropping_resizing_note)) ? $order->cropping_resizing_note : ''; ?></textarea>
	                    </div>
	                </div>
            	</div>
            </div>
            <div class="row">
            	<div class="col-sm-6">
	                <div class="h6 text-left font-bold m-b-n-sm text-info dker">Color Corrections :</div>
            		<hr>
            		<div class="form-horizontal"></div>
	                <div class="form-group m-t-n">
	                	<div class="col-sm-12 text-left no-padder">
	                        <label class="radio m-t-none i-checks">
	                            <input type="radio" name="color_fix" value="Basic Adjustment"><i></i>Basic Adjustment: <span class="text-info">$0.50</span>
	                        </label>
	                        <label class="radio i-checks">
	                            <input type="radio" name="color_fix" value="None"><i></i> None
	                        </label>
	                    </div>
	                </div>
            	</div>
            	<div class="col-xs-6">
            		<div class="h6 text-left font-bold m-b-n-sm text-info dker">Turnaround Times :</div>
            		<hr>
            		<div class="row m-t-n">
            			<div class="col-sm-6 ">
            				<label class="radio m-t-none i-checks inline m-t-n-sm">
	                            <input id="tat_24" name="tat" value="24" <?php echo ($order->turnaround_time == 24) ? 'checked=""' : ''; ?> type="radio"/><i></i>24H <span class="text-xs text-danger" data-toggle="tooltip" data-placement="top" title="Additional 20% charge will be added on top of total value.">(+20%)</span>
	                        </label>
	                        <label class="radio i-checks inline" >
	                            <input id="tat_48" name="tat" value="48" <?php echo ($order->turnaround_time == 48) ? 'checked=""' : ''; ?> type="radio"/><i></i>48H (i)
	                        </label>
            			</div>
            			<div class="col-sm-6">
            				<label class="radio m-t-none i-checks inline m-t-n-sm">
	                            <input id="tat_72" name="tat" value="72" <?php echo ($order->turnaround_time == 72) ? 'checked=""' : ''; ?> type="radio"/><i></i>72H <span class="text-xs text-danger" data-toggle="tooltip" data-placement="top" title="20% discount will be applied from total value.">(-20%)</span>
	                        </label>
	                        <label class="radio i-checks inline" >
	                            <input id="tat_0" name="tat" value="0" <?php echo ($order->turnaround_time == 0) ? 'checked=""' : ''; ?> type="radio"/><i></i>Flexible (i)
	                        </label>
            			</div>
            		</div>
                </div>
                <div class="col-sm-12">
                	<div class="h6 text-left font-bold m-b-n-sm"><span class="text-info dker">Message</span></div>
	                <hr>
	                <!-- Instruction Message -->
	                <div class="form-group">
	                    <textarea name="job_desc" class="form-control input-sm block" rows="3" placeholder="Message (Further instructions if any...)"
	                    required
	                    ><?php echo $order->order_desc; ?></textarea>
	                </div>
                </div>
            </div>
	    </div>
	    <div class="modal-footer">
		    <div class="pull-left">
				<input type="submit" name="submit" class="form-control btn btn-s-md btn-info" value="Submit">
			</div>
	      	<input type="button" class="btn btn-danger" data-dismiss="modal" value="Close" />
	    </div>
    </form>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->