<section class="hbox stretch">
	<section>
		<section class="vbox" id="dashboard-custom-style">
			<section class="scrollable padder">
				<div class="wrapper">
					<section class="row m-b-md">
						<div class="col-sm-6">
							<h3 class="m-b-xs text-black"><?php echo lang('order_custom_1');?></h3>
							<small><?php echo lang('order_custom_2');?></small>
							
						</div>
						<div class="col-sm-6">
							<ul class="breadcrumb">
			                    <li><a href="<?php echo site_url('/admin/');?>"><i class="fa fa-home"></i>Cutoutimage</a></li>
			                    <li class="active">All Order</li>
			                    <li class="active">Create New</li>
		                  	</ul>
						</div>
					</section>         
                    <!-- / .breadcrumb -->
                    <div class="panel-body" id="order-manual-style">
                        <!-- Tab 2 Quote -->
                        <div class="clearfix" ng-show="quoteView">
                        	<form id="quoteForm" action="" method="post" name="quoteForm" novalidate>
                        		<div class="row">
	                        		<div class="col-sm-7">
	                             		<div class="form-group">
	                                        <input type="text" name="job_title" class="form-control parsley-validated block" placeholder="Quotation Title"/>
	                                    </div>
	                                    <div class="h6 text-left font-bold m-b-n m-t-l"><span class="text-info dker">Service Type / Required Services</span></div>
	                                    <hr>
                                        <div class="col-sm-12 text-left no-padder smo_mro">
                                        	<select multiple="" class="form-control m_select_style">
					                            <option value="Photo Cut Out">Photo Cut Out</option>
					                            <option value="Clipping Path">Clipping Path</option>
					                            <option value="Background Removal">Background Removal</option>
					                            <option value="Deep Shadow">Deep Shadow</option>
					                            <option value="Natural Shadow">Natural Shadow</option>
					                            <option value="Reflection Shadow">Reflection Shadow</option>
					                            <option value="Mirror Effect">Mirror Effect</option>
					                            <option value="Photo Retouching">Photo Retouching</option>
					                            <option value="Mannequin Removal">Mannequin Removal</option>
					                            <option value="Crop-Resizing">Crop-Resizing</option>
					                            <option value="E-Commerce Optimization">E-Commerce Optimization</option>
					                            <option value="I'm Not Certain">I'm Not Certain</option>
				                          	</select>
                                        </div>

	                                    <div class="h6 text-left font-bold m-b-n m-t-l"><span class="text-info dker">File Format</span></div>
	                                    <hr>
	                                    <div class="form-horizontal"></div>
                                    	<div class="col-sm-12 text-left no-padder smo_mro">
                                        	<select multiple="" class="form-control m_select_style">
					                            <option value="JPG">JPG</option>
					                            <option value="PNG">PNG</option>
					                            <option value="PSD">PSD</option>
					                            <option value="TIFF">TIFF!</option>
				                          	</select>
                                        </div>
	                                    
	                                    <div class="h6 text-left font-bold m-b-n text-info dker">Detailed Requirements:</div>
	                                    <hr>
	                                    <div class="form-horizontal"></div>
	                                    <div class="form-group ">
	                                        <div class="col-sm-12 no-padder smo_mro">
	                                            <textarea name="job_desc" class="form-control input-sm block" rows="3" placeholder="" required ></textarea>
	                                        </div>
	                                    </div>
	                            	</div>
	                        		<div class="col-sm-5">
	                        			<div class="o-style-right">
	                        				<div class="h6 text-left font-bold m-b-n m-t-l">
	                        					<span class="text-info dker">Choose Client</span>
	                        				</div>
		                                    <hr>
		                                    <div class="chosen-box">
		                                    	<div class="form-group">
							                        <select style="width:260px" class="chosen-select">
							                            <optgroup label="Alaskan/Hawaiian Time Zone">
							                                <option value="AK">Alaska</option>
							                                <option value="HI">Hawaii</option>
							                            </optgroup>
							                            <optgroup label="Pacific Time Zone">
							                                <option value="CA">California</option>
							                                <option value="NV">Nevada</option>
							                                <option value="OR">Oregon</option>
							                                <option value="WA">Washington</option>
							                            </optgroup>
							                            <optgroup label="Mountain Time Zone">
							                                <option value="AZ">Arizona</option>
							                                <option value="CO">Colorado</option>
							                                <option value="ID">Idaho</option>
							                                <option value="MT">Montana</option><option value="NE">Nebraska</option>
							                                <option value="NM">New Mexico</option>
							                                <option value="ND">North Dakota</option>
							                                <option value="UT">Utah</option>
							                                <option value="WY">Wyoming</option>
							                            </optgroup>
							                            <optgroup label="Central Time Zone">
							                                <option value="AL">Alabama</option>
							                                <option value="AR">Arkansas</option>
							                                <option value="IL">Illinois</option>
							                                <option value="IA">Iowa</option>
							                                <option value="KS">Kansas</option>
							                                <option value="KY">Kentucky</option>
							                                <option value="LA">Louisiana</option>
							                                <option value="MN">Minnesota</option>
							                                <option value="MS">Mississippi</option>
							                                <option value="MO">Missouri</option>
							                                <option value="OK">Oklahoma</option>
							                                <option value="SD">South Dakota</option>
							                                <option value="TX">Texas</option>
							                                <option value="TN">Tennessee</option>
							                                <option value="WI">Wisconsin</option>
							                            </optgroup>
							                            <optgroup label="Eastern Time Zone">
							                                <option value="CT">Connecticut</option>
							                                <option value="DE">Delaware</option>
							                                <option value="FL">Florida</option>
							                                <option value="GA">Georgia</option>
							                                <option value="IN">Indiana</option>
							                                <option value="ME">Maine</option>
							                                <option value="MD">Maryland</option>
							                                <option value="MA">Massachusetts</option>
							                                <option value="MI">Michigan</option>
							                                <option value="NH">New Hampshire</option><option value="NJ">New Jersey</option>
							                                <option value="NY">New York</option>
							                                <option value="NC">North Carolina</option>
							                                <option value="OH">Ohio</option>
							                                <option value="PA">Pennsylvania</option><option value="RI">Rhode Island</option><option value="SC">South Carolina</option>
							                                <option value="VT">Vermont</option><option value="VA">Virginia</option>
							                                <option value="WV">West Virginia</option>
							                            </optgroup>
							                        </select>
							                    </div>
					                        </div>
					                        <div class="image-qty">
					                        	<div class="h6 text-left font-bold m-b-n m-t-l">
		                    						<span class="text-info dker">Image Qty</span>
		                        				</div>
			                                    <hr>
			                                    <div class="form-group">
			                                    	<input class="form-control m-b" type="number" placeholder="Quantity">
			                                    </div>
					                        </div>
					                        <div class="image-qty">
					                        	<div class="h6 text-left font-bold m-b-n m-t-l">
		                    						<span class="text-info dker">Price</span>
		                        				</div>
			                                    <hr>
			                                    <div class="form-group">
			                                    	<input class="form-control m-b" type="number" placeholder="Price">
			                                    </div>
					                        </div>
					                        <div class="h6 text-left font-bold m-b-n m-t-l"><span class="text-info dker">Retouching Photos</span></div>
		                                    <hr>
		                                    <div class="form-horizontal"></div>
		                                    <div class="form-group m-t-n m-l-n">
		                                        <div class="col-sm-12 m-b-lg rf_format">
		                                            <label class="radio-inline i-checks">
		                                                <input type="radio" name="retouching_opt[]" value="" checked="" ng-click="qRetouching = false"><i></i>None
		                                            </label>
		                                            <label class="radio-inline i-checks">
		                                                <input type="radio" name="retouching_opt[]" value="PNG" ng-click="qRetouching = 'Basic Retouching'"><i></i>Basic Retouching
		                                            </label>
		                                            <label class="radio-inline i-checks">
		                                                <input type="radio" name="retouching_opt[]" value="PNG" ng-click="qRetouching = 'Highend Retouching'"><i></i>Highend Retouching
		                                            </label>
		                                        </div>
		                                    </div>

		                                    <div class="h6 text-left font-bold m-b-n m-t-l"><span class="text-info dker">Image Masking</span></div>
		                                    <hr>
		                                    <div class="form-horizontal"></div>
		                                    <div class="form-group m-t-n m-l-n">
		                                        <div class="col-sm-12 m-b-lg rf_format">
		                                            <label class="radio-inline i-checks">
		                                                <input type="radio" name="masking_opt[]" value="" ng-click="qMasking = false" checked=""><i></i>None
		                                            </label>
		                                            <label class="radio-inline i-checks">
		                                                <input type="radio" name="masking_opt[]" value="Layer" ng-click="qMasking = 'Layer'"><i></i>Layer
		                                            </label>
		                                            <label class="radio-inline i-checks">
		                                                <input type="radio" name="masking_opt[]" value="Alpha" ng-click="qMasking = 'Alpha'"><i></i>Alpha
		                                            </label>
		                                            <label class="radio-inline i-checks">
		                                                <input type="radio" name="masking_opt[]" value="Translucent" ng-click="qMasking = 'Translucent'"><i></i>Translucent
		                                            </label>
		                                        </div>
		                                    </div>

		                                    <div class="h6 text-left font-bold m-b-n text-info dker">Background Options:</div>
		                                    <hr>
		                                    <div class="form-horizontal"></div>
		                                    <div class="form-group m-t-n m-l-n">
		                                        <div class="col-sm-12 m-b-lg rf_format">
		                                            <label class="radio-inline i-checks">
		                                                <input type="radio" id="rt_jpg" name="cutout_bg_option[]" value="White BG" ng-click="bgOpt = 'White BG'" ng-init="bgOpt = 'White BG'" checked=""><i></i>White
		                                            </label>
		                                            <label class="radio-inline i-checks">
		                                                <input type="radio" id="rt_png" name="cutout_bg_option[]" value="Transparent" ng-click="bgOpt = 'Transparent BG'"><i></i>Transparent
		                                            </label>
		                                            <label class="radio-inline i-checks">
		                                                <input type="radio" id="rt_png" name="cutout_bg_option[]" value="Original" ng-click="bgOpt = 'Original'"><i></i>Original
		                                            </label>
		                                            <label class="radio-inline i-checks">
		                                                <input type="radio" id="rt_png" name="cutout_bg_option[]" value="Custom" ng-click="bgOpt = 'Custom'"><i></i>Custom
		                                            </label>
		                                        </div>
		                                    </div>
	                        			</div>
	                        		</div>
	                        		<div class="col-sm-12">
	                        			<input type="submit" name="submit" value="Submit" class="btn btn-s-md btn-success">
	                        		</div>
	                        	</div>
                        	</form>
                        </div>
                        <!-- End quote panel -->
                    </div>
                </div>
			</section>
		</section>
	</section>
</section>