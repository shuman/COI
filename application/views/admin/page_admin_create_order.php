
<section class="hbox stretch">
	<section>
		<section class="vbox" id="admin_create_order">
			<section class="scrollable padder">
				<section class="row m-b-md">
					<div class="col-sm-6">
						<h3 class="m-b-xs text-black">Create Order</h3>
						<small>Admin Create Order</small>
						<!-- <pre><?php print_r($orders); ?><pre/> -->
					</div>
					<div class="col-sm-6">
						<ul class="breadcrumb m-t-md pull-right-lg" style="background: transparent; border: 0;">
		                    <li><a href="<?php echo site_url('/admin/');?>"><i class="fa fa-home"></i> Home</a></li>
		                    <li class="active">Create Order</li>
	                  	</ul>
					</div>
				</section>
				<div class="row">
				    <div class="col-sm-12">
				        <form class="bs-example" style="max-width: 850px; width: 100%;">
				        	<section class="par block p-md bg-white b-a" >
					        	<div class="row">
					        		<div class="col-sm-6">
					        			<div class="h6 text-left font-bold m-b-n-sm"><span class="text-info dker">Job Title</span></div>
						                <hr>
					        			<div class="form-group">
						                    <input type="text" name="job_title" class="form-control parsley-validated block" placeholder="Job Title" 
						                    required value="" />
						                </div>
						            </div>
						            <div class="col-sm-6">
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
				                        	
						                        <label class="checkbox-inline i-checks">
						                            <input type="checkbox" class="o_rft" name="return_file_type[]"  value="JPG" /><i></i>JPG
						                        </label>
						                        <label class="checkbox-inline i-checks">
						                            <input type="checkbox" class="o_rft" name="return_file_type[]"  value="PNG" /><i></i>PNG
						                        </label>
						                        <label class="checkbox-inline i-checks">
						                            <input type="checkbox" class="o_rft" name="return_file_type[]"  value="PSD" /><i></i> <span class="text-danger" data-toggle="tooltip" data-placement="top" title="Requesting PSD File will cost: ${{servicePrice.fileFormat.psd}} / Image in addition.">PSD!</span>
						                        </label>
						                        <label class="checkbox-inline i-checks">
						                            <input type="checkbox" class="o_rft" name="return_file_type[]" value="TIFF" /><i></i> <span class="text-danger" data-toggle="tooltip" data-placement="top" title="Requesting TIFF File will cost: ${{servicePrice.fileFormat.tiff}} / Image in addition.">TIFF!</span>
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
							                    <label class="radio-inline i-checks "><input type="radio" name="mannequin_option"  value="3D - Invisible ($0.80)"><i></i>3D - Invisible ($0.80)</label>
							                    <label class="radio-inline i-checks"><input type="radio" name="mannequin_option"   value="none" ><i></i>None</label>
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
							                <div class="col-sm-12 rf_format ">
							                    <div class="radio m-t-none i-checks"><label><input type="radio" name="shadow_option"  value="Drop Shadow ($2.5)"><i></i>Drop Shadow: <span class="text-info">$0.25</span></label></div>
							                    <div class="radio i-checks"><label><input type="radio" name="shadow_option"  value="Natural Shadow ($0.50)"><i></i>Natural Shadow: <span class="text-info">$0.50</span></label></div>
							                    <div class="radio i-checks"><label><input type="radio" name="shadow_option"  value="Reflection Shadow ($0.50)"><i></i>Reflection Shadow: <span class="text-info">$0.50</span></label></div>
							                    <div class="radio i-checks"><label><input type="radio" name="shadow_option"  value="Mirror Effect ($0.50)"><i></i>Mirror Effect: <span class="text-info">$0.50</span></label></div>
							                    <div class="radio i-checks"><label><input type="radio" name="shadow_option"  value=""><i></i>None</label></div>
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
						                            <input type="radio" name="cutout_bg_option"  value="White BG" checked=""><i></i>White
						                        </label>
						                        <label class="radio i-checks">
						                            <input type="radio" name="cutout_bg_option"  value="Transparent BG"><i></i>Transparent
						                        </label>
						                        <label class="radio i-checks">
						                            <input type="radio" name="cutout_bg_option"  value="Original"><i></i>Original
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
						                        <input type="checkbox" name="brightness_value"   value="0.50"><i></i>Fix Imperfection (Basic) - <span class="text-info">$0.50</span>
						                    </label>
						                    <label class="checkbox i-checks">
						                        <input type="checkbox" name="staight_value"  value="0.25" data-title="Straighten & Symmetric"><i></i>Straighten &amp; Symmetric - <span class="text-info">$0.25</span>
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
						                	<label class="radio-inline i-checks">
						                        <input type="radio" name="crop_resize"  value="Variation (Upto 1)" ng-checked="resizingOn"><i></i>Variation (Upto 1): <span class="text-info">Free</span>
						                    </label>
						                    <label class="radio-inline i-checks">
						                        <input type="radio" name="crop_resize"  value="Variation (Upto 3)"><i></i>Variation (Upto 3): <span class="text-info">$0.25</span>
						                    </label>
						                    <label class="radio i-checks">
						                        <input type="radio" name="crop_resize"  value="" ><i></i> None
						                    </label>
						                    <div class="m-l-n m-r-n wrapper" style="padding-top: 8px !important;">
						                        <textarea name="crop_resize_desc" class="form-control input-sm block" rows="3" data-minwords="6" placeholder="Please write down your cropping &amp; resizing details here..."></textarea>
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
						                        <label class="radio-inline i-checks">
						                            <input type="radio" name="color_fix" value="Basic Adjustment"><i></i>Basic Adjustment: <span class="text-info">$0.50</span>
						                        </label>
						                        <label class="radio-inline i-checks">
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
				                				<label class="radio i-checks inline m-t-n-sm">
						                            <input id="tat_24" name="tat" value="24"  type="radio"/><i></i>24H <span class="text-xs text-danger" data-toggle="tooltip" data-placement="top" title="Additional 20% charge will be added on top of total value.">(+20%)</span>
						                        </label>
						                        <label class="radio m-l-sm i-checks inline" >
						                            <input id="tat_48" name="tat" value="48"  type="radio"/><i></i>48H (i)
						                        </label>
				                			</div>
				                			<div class="col-sm-6">
				                				<label class="radio i-checks inline m-t-n-sm">
						                            <input id="tat_72" name="tat" value="72"  type="radio"/><i></i>72H <span class="text-xs text-danger" data-toggle="tooltip" data-placement="top" title="20% discount will be applied from total value.">(-20%)</span>
						                        </label>
						                        <label class="radio m-l-sm i-checks inline" >
						                            <input id="tat_0" name="tat" value="0"  type="radio"/><i></i>Flexible (i)
						                        </label>
				                			</div>
				                		</div>
				                    </div>
				                    <div class="col-sm-12">
				                    	<div class="h6 text-left font-bold m-t m-b-n-sm"><span class="text-info dker">Message</span></div>
						                <hr>
						                <!-- Instruction Message -->
						                <div class="form-group">
						                    <textarea name="job_desc" class="form-control input-sm block" rows="3" placeholder="Message (Further instructions if any...)"
						                    required
						                    ></textarea>
						                </div>
				                    </div>
				                </div>
			                </section>
			                <div class="row">
			                	<div class="col-sm-12">
				        			<div class="form-group">
				        				<input type="submit" name="submit" class="form-control block btn btn-info m-t-md" value="Submit">
				        			</div>
			                    </div>
			                </div>
			            </form>
				    </div>
			    </div>
			</section>
		</section>
	</section>
</section>
  