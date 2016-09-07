<section class="vbox">
    <section class="">
        <section class="hbox stretch">
            <aside class="col-lg-4 m-r-n m-l-n no-padder bg-light lter b-r drop_files">
                <section class="vbox">
                    <!-- For Mobile Only -->
                    <section class="scrollable bg-ar-c">
                        <div id="progress_bar" class="animated ar-mb-progress" style="display:none; margin:15px 15px -15px;">
                            <div class="text-info text-center">Upload Completed: <strong> <span>0</span>%</strong></div>
                            <div class="progress progress-sm progress-striped active">
                                <div class="progress-bar bg-info lter noTransition" style="width:0%"></div>
                            </div>
                        </div>
                        <div class="wrapper m-b-n-md visible-xs">
                            <section class="padder">
                                <div class="col-lg-12 no-padder m-b-sm">
                                    <div id="dropzone">
                                        <form action="<?php echo site_url('ajax/uploader');?>" class="dropzone dz-clickable" id="file-upload" enctype="multipart/form-data">
                                            <div class="dz-default dz-message"><span>Click or drop your files here!</span></div>
                                        </form>
                                    </div>
                                </div>
                            </section>  
                        </div>
                   
                        <div class="wrapper hidden-xs">
                            <section class="panel no-border m-n">
                                <div class="col-lg-12 no-padder m-b-sm">
                                    <div id="dropzone">
                                        <form action="<?php echo site_url('ajax/uploader');?>" class="dropzone dz-clickable" id="file-upload" enctype="multipart/form-data">
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
                        <form id="place_order_form" action="" method="post" name="place_order">
                            <input type="hidden" id="order_id" name="order_id" value="<?php echo $order_id;?>"/>
                            <input type="hidden" id="o_service" name="o_service" value="cutout">
                            <div class="col-lg-8 no-padder m-n">
                                <div class="wrapper">
                                    <!-- .breadcrumb -->
                                    <ul class="breadcrumb">
                                        <li><i class="i i-pencil2 m-r-xs"></i> Instructions / Job Details</li>
                                    </ul>
                                    <!-- / .breadcrumb -->
                                    <!-- left tab -->
                                    <section id="service_tab" class="panel panel-default">
                                        <section class="row m-l-none m-r-none m-b text-center box-shadow">
                                            <div class="col-xs-4 bg-info r-tl">
                                                <div class="wrapper">
                                                    <a href="#clipping-path" role="tab" data-toggle="tab">
                                                        <div class="service_cp active"><img src="<?php echo base_url();?>assets/images/dot.png" /></div>
                                                    </a>
                                                    <small class="m-t-xs">CutOut</small>
                                                </div>
                                            </div>

                                            <div class="col-xs-4 bg-info dk">
                                                <div class="wrapper">
                                                    <a href="#image-masking" role="tab" data-toggle="tab">
                                                        <div class="service_mask"><img src="<?php echo base_url();?>assets/images/dot.png" /></div>
                                                    </a>
                                                    <small class="m-t-xs">Masking</small>
                                                </div>
                                            </div>

                                            <div class="col-xs-4 bg-info r-tr">
                                                <div class="wrapper">
                                                    <a href="#image-retouching" role="tab" data-toggle="tab">
                                                        <div class="service_retouch"><img src="<?php echo base_url();?>assets/images/dot.png" /></div>
                                                    </a>
                                                    <small class="m-t-xs">Retouch</small>
                                                </div>
                                            </div>
                                        </section>

                                        <div class="panel-body">
                                            <div class="tab-content">
                                                <!-- Tab 1 CUTOUT -->
                                                <div class="tab-pane clearfix active" id="clipping-path">
                                                    <div class="h5 text-left font-bold m-b-n">Service Options: <span class="text-info dker">Cut Out / Clipping Path</span></div>
                                                    <hr>
                                                    <div class="form-group">
                                                        <div class="no-padder col-sm-8 m-b cocp">
                                                            <label class="radio i-checks"><input id="soco_cp" name="service_option_cutout" value="Clipping Path Only" type="radio" checked=""><i></i>Clipping Path Only</label>
                                                           	<label class="radio i-checks"><input id="soco_cpf" name="service_option_cutout" value="CP with Flatness" type="radio"><i></i>Clipping Path with Flatness</label>
                                                            <!--label class="radio i-checks"><input id="soco_cpbg" name="service_option_cutout" value="CP with White BG" type="radio"><i></i>Clipping Path w/ White BG</label>
                                                            <label class="radio i-checks"><input id="soco_cptbg" name="service_option_cutout" value="CP with Transparent BG" type="radio"><i></i>Clipping Path w/ Transparent BG</label>
                                                            <label class="radio i-checks"><input id="soco_cpos" name="service_option_cutout" value="CP with Original Shadow" type="radio"><i></i>Clipping Path w/ Shadow</label-->
                                                        </div>
                                                        <div class="col-sm-4 b-l cocp">
                                                        	<label>Flatness:</label>
                                                            <div class="input-group">
                                                                <input type="text" id="flatness" name="cutout_flatness" class="form-control input-sm" value="0.5" disabled="" />
                                                                <span class="input-group-addon">px</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix noheight"></div>
                                                    <div class="h6 text-left font-bold m-b-n text-info dker">Background Options:</div>
                                                    <hr class="m-b-none">
                                                    <div class="form-group">
                                                        <div class="no-padder col-sm-12 m-b cocp">
                                                            <label class="radio i-checks inline m-r-sm"><input id="soco_cpbg" name="cutout_bg_option" value="White BG" checked="" type="radio"><i></i>White</label>
                                                            <label class="radio i-checks inline m-r-sm"><input id="soco_cptbg" name="cutout_bg_option" value="Transparent BG" type="radio"><i></i>Transparent</label>
                                                            <label class="radio i-checks inline m-r-sm"><input id="soco_cpos" name="cutout_bg_option" value="Original Shadow" type="radio"><i></i>Original</label>
                                                            <label class="radio i-checks inline m-r-sm"><input id="soco_cpois" name="cutout_bg_option" value="Original Including Shadow" type="radio"><i></i>Include Shadow</label>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix noheight"></div>
                                                    <div class="h6 text-left font-bold m-b-n m-t-md">Choose Image Complexity: <span class="text-info dker">Price Per Image</span></div>
                                                    <hr>
                                                    <div class="padder m-b-n m-t-n">
                                                        <div class="form-horizontal">
                                                            <div id="img_complexity" class="form-group">
                                                                <label class="complexity_item" for="ic_option_1">
                                                                    <span id="ar-pop1" data-html="true" data-container="body" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url();?>assets/images/pricing/d/1.png' /></div>" rel="popover" data-placement="top" data-original-title="CP - Basic: US $0.50 / Image"> <img src="<?php echo base_url();?>assets/images/pricing/1.jpg" /></span>
                                                                    <label class="radio i-checks text"><input id="ic_option_1" name="image_complexity" data-title="CP Basic" value="0.5" type="radio"><i></i> 0.5$</label>
                                                                </label>
                                                                <label class="complexity_item" for="ic_option_2">
                                                                    <span id="ar-pop2" data-html="true" data-container="body" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url();?>assets/images/pricing/d/2.png' /></div>" rel="popover" data-placement="top" data-original-title="CP - Regular: US $1.00 / Image"> <img src="<?php echo base_url();?>assets/images/pricing/2.jpg" />
                                                                    </span>
                                                                    <label class="radio i-checks"><input id="ic_option_2" name="image_complexity" data-title="CP Regular" value="1.0" type="radio"><i></i>1.0$</label>
                                                                </label>
                                                                <label class="complexity_item" for="ic_option_3">
                                                                    <span id="ar-pop3" data-html="true" data-container="body" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url();?>assets/images/pricing/d/3.png' /></div>" rel="popover" data-placement="top" data-original-title="CP - Medium: US $2.00 / Image"> <img src="<?php echo base_url();?>assets/images/pricing/3.jpg" />
                                                                    </span>
                                                                    <label class="radio i-checks"><input id="ic_option_3" name="image_complexity" data-title="CP Medium" value="2.0" type="radio" checked=""><i></i>2.0$</label>
                                                                </label>
                                                                <label class="complexity_item" for="ic_option_4">
                                                                    <span id="ar-pop4" data-html="true" data-container="body" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url();?>assets/images/pricing/d/4.png' /></div>" rel="popover" data-placement="top" data-original-title="CP - Advance: US $3.50 / Image"> <img src="<?php echo base_url();?>assets/images/pricing/4.jpg" />
                                                                    </span>
                                                                    <label class="radio i-checks"><input id="ic_option_4" name="image_complexity" data-title="CP Advanced" value="3.5" type="radio"><i></i>3.5$</label>
                                                                </label>
                                                                <label class="complexity_item" for="ic_option_5">
                                                                    <span id="ar-pop5" data-html="true" data-container="body" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url();?>assets/images/pricing/d/5.png' /></div>" rel="popover" data-placement="top" data-original-title="CP - Complex: US $7.00 / Image"> <img src="<?php echo base_url();?>assets/images/pricing/5.jpg" />
                                                                    </span>
                                                                    <label class="radio i-checks"><input id="ic_option_5" name="image_complexity" data-title="CP Complex" value="7.0" type="radio"><i></i>7.0$</label>
                                                                </label>
                                                                <!--div class="complexity_item" for="ic_option_6">
                                                                    <span id="ar-pop6" data-html="true" data-container="body" data-content="<div class='text-justify text-black bg-info .text-lg wrapper' style='border:1px solid #20c198; border-radius:3px;'>If you don't really understand the images complexity or images are super complex, please <strong>'REQUEST FOR QUOTE'</strong>. <br /><br />Our CSR will get back to you with a price update shortly.</div>" rel="popover" data-placement="top" data-original-title="CP - Super Complex: Request Quote"> <img src="<?php echo base_url();?>assets/images/pricing/6.jpg" />
                                                                    </span>
                                                                    <label class="radio i-checks"><input id="ic_option_6" name="image_complexity" value="0" type="radio"><i></i><span data-toggle="tooltip" data-placement="top" title="Request for Quotation">RFQ</span></label>
                                                                </div-->
                                                                <div class="complexity_option_mask hide"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="padder m-b-n m-t-n">
                                                        <div class="or_devider"><span class="text-info dker">OR</span></div>
                                                        <div class="btn-group btn-block" data-toggle="buttons">
                                                            <label class="btn btn-md btn-default btn-block font-bold text-black" id="ar-pop6" data-html="true" data-container="body" data-content="<div class='text-justify text-black bg-info .text-lg wrapper' style='border:1px solid #20c198; border-radius:3px;'>If you don't really understand the images complexity or images are super complex, please <strong>'REQUEST FOR QUOTE'</strong>. <br /><br />Our CSR will get back to you with a price update shortly.</div>" rel="popover" data-placement="top" data-original-title="CP - Super Complex: Request Quote">
                                                                <i class="fa fa-check text-active"></i>
                                                                <input type="checkbox" name="rfq" id="rfq"> ASK FOR QUOTATION HERE
                                                            </label>
                                                        </div><br><br>
                                                    </div>
                                                </div>

                                                <!-- Tab 2 MASKING -->
                                                <div class="tab-pane clearfix" id="image-masking">
                                                    <div class="h5 text-left font-bold m-b-n">Service Options: <span class="text-info dker">Image Masking / Knockout</span></div>
                                                    <hr>
                                                    <div class="form-group">
                                                        <div class="no-padder col-sm-12 m-b">
                                                            <label class="radio i-checks inline m-r-sm"><input id="somask_cp" name="service_option_mask" value="Layer" checked="" type="radio"><i></i>Layer</label>
                                                            <label class="radio i-checks inline m-r-sm"><input id="somask_cpbg" name="service_option_mask" value="Alpha Channel" type="radio"><i></i>Alpha Channel</label>
                                                            <label class="radio i-checks inline m-r-sm"><input id="somask_cptbg" name="service_option_mask" value="Translucent" type="radio"><i></i>Translucent</label>
                                                        </div>
                                                        <!--col-sm-8-->
                                                        <!--div class="col-sm-4 b-l">
                                                            <div class="input-group"><input type="text" name="masking_flatness" class="form-control input-sm" placeholder="Flatness (if any)"><span class="input-group-addon">px</span></div>
                                                        </div-->
                                                    </div>
                                                    <!--form-group-->
                                                    <div class="clearfix noheight"></div>
	                                                <div class="h6 text-left font-bold m-b-n text-info dker">Background Options:</div>
	                                                <hr class="m-b-none">
	                                                <div class="form-group">
	                                                    <div class="no-padder col-sm-12">
	                                                        <label class="radio i-checks inline m-r-sm"><input id="somsk_wbg" name="masking_bg_option" value="White" checked="" type="radio"><i></i>White</label>
	                                                        <label class="radio i-checks inline m-r-sm"><input id="somsk_tbg" name="masking_bg_option" value="Transparent" type="radio"><i></i>Transparent</label>
	                                                        <label class="radio i-checks inline m-r-sm"><input id="somsk_obg" name="masking_bg_option" value="Custom" type="radio"><i></i>Custom BG</label><input type="text" class="masking_bg_input" name="masking_bg_color" value="#EA0064" readonly="">
	                                                    </div>
	                                                </div>
                                                </div>

                                                <!-- Tab 3 RETOUCING -->
                                                <div class="tab-pane clearfix" id="image-retouching">
                                                    <div class="h5 text-left font-bold m-b-n">Service Options: <span class="text-info dker">Image Retouching / Touch-Up</span></div>
                                                    <hr>
                                                    <div class="form-group">
                                                        <div class="no-padder col-sm-8">
                                                            <label class="radio i-checks inline m-r-sm"><input id="soretouch_cptbg" name="service_option_retouch" value="Product" checked="" type="radio"><i></i>Product</label>
                                                            <label class="radio i-checks inline m-r-sm"><input id="soretouch_cpbg" name="service_option_retouch" value="Jewelry" type="radio"><i></i>Jewelry</label>
                                                            <label class="radio i-checks inline m-r-sm"><input id="soretouch_cp" name="service_option_retouch" value="Model" type="radio"><i></i>Model</label>
                                                        </div>
                                                        <!--col-sm-8-->
                                                        <div class="col-sm-4 b-l p-r-none">
                                                        	<label class="m-b-none">Retouching Level:</label>
                                                            <label class="radio i-checks inline m-r-sm"><input id="soretouch_cpwbg" name="retouch_quality" value="Basic" type="radio"><i></i>Basic</label>
                                                            <label class="radio i-checks inline m-r-none"><input id="soretouch_cptbg" name="retouch_quality" value="High" type="radio"><i></i>High</label>
                                                        </div>
                                                    </div>
                                                    <!--form-group-->
	                                                <div class="clearfix noheight"></div>
	                                                <div class="h6 text-left font-bold m-b-n text-info dker">Background Options:</div>
	                                                <hr class="m-b-none">
	                                                <div class="form-group">
	                                                    <div class="no-padder col-sm-12 m-b cocp">
	                                                        <label class="radio i-checks inline m-r-sm"><input id="sort_wbg" name="retouch_bg_option" value="White" checked="" type="radio"><i></i>White</label>
	                                                        <label class="radio i-checks inline m-r-sm"><input id="sort_obg" name="retouch_bg_option" value="Original" type="radio"><i></i>Original</label>
	                                                        <label class="radio i-checks inline m-r-sm"><input id="sort_tbg" name="retouch_bg_option" value="Transparent" type="radio"><i></i>Transparent</label>
	                                                    </div>
	                                                </div>
                                                </div>
                                            </div>

                                            <div class="h6 text-left font-bold m-b-n m-t-xl"><span class="text-info dker">Shadow &amp; Manipulation</span></div>
                                            <hr>
                                            <div class="m-t-n clearfix shadow_manipulation_options">
                                                <div class="col-sm-6 text-left no-padder smo_mro">
                                                    <div class="h6 text-dark dker m-r-n m-b-n m-t-xm">|| Shadow Making Options</div>
                                                    <hr class="m-l-n m-r-n">
                                                    <div class="form-group m-t-n shadow_options">
                                                        <label class="radio i-checks">
                                                            <input id="shadow_option1" name="shadow_option" value="Drop Shadow" data-cost="0.25" type="radio">
                                                            <i></i>
                                                            Drop Shadow:  <span id="ar-pop17" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url();?>assets/images/pricing/shadow/1.jpg' /></div>" rel="popover" data-placement="right" data-original-title="Drop Shadow: US $0.25 / Image">$0.25</span>
                                                        </label>
                                                        <label class="radio i-checks">
                                                            <input id="shadow_option2" name="shadow_option" value="Natural Shadow" data-cost="0.50" type="radio">
                                                            <i></i>
                                                            Natural Shadow: <span id="ar-pop18" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url();?>assets/images/pricing/shadow/2.jpg' /></div>" rel="popover" data-placement="right" data-original-title="Natural Shadow: US $0.50 / Image">$0.50</span>
                                                        </label>
                                                        <label class="radio i-checks">
                                                            <input id="shadow_option3" name="shadow_option" value="Reflection Shadow" data-cost="0.50" type="radio">
                                                            <i></i>
                                                            Reflection Shadow: <span id="ar-pop19" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url();?>assets/images/pricing/shadow/3.jpg' /></div>" rel="popover" data-placement="right" data-original-title="Reflection Shadow: US $0.50 / Image">$0.50</span>
                                                        </label>
                                                        <label class="radio i-checks">
                                                            <input id="shadow_option4" name="shadow_option" value="Mirror Effect" data-cost="0.50" type="radio">
                                                            <i></i>
                                                            Mirror Effect: <span id="ar-pop20" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url();?>assets/images/pricing/shadow/4.jpg' /></div>" rel="popover" data-placement="right" data-original-title="Mirror Effect: US $0.50 / Image">$0.50</span>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6 text-left no-padder smo_mro">
                                                    <div class="h6 text-dark dker m-l-n m-r-n m-b-n m-t-xm">|| Mannequin Remove Options</div>
                                                    <hr>
                                                    <div class="form-group m-t-n">
                                                        <label class="radio i-checks">
                                                            <input class="mannequin_option" name="mannequin_option" value="Neck Joint" data-cost="1.00" type="radio"><i></i>Neck-Joint: $1.00
                                                        </label>
                                                        <label class="radio i-checks">
                                                            <input class="mannequin_option" name="mannequin_option" value="Manniquin Remove" data-cost="1.5" type="radio"><i></i>Ghost Mannequin: $1.50
                                                        </label>
                                                        <label class="checkbox i-checks">
                                                            <input id="staight" name="staight" value="yes" data-cost="0.25" type="checkbox" checked="checked"><i></i>Straight &amp; Symmetric: <span class="text-info">$0.25</span>
                                                        </label>
                                                        <label class="checkbox i-checks">
                                                            <input id="brightness" name="brightness" value="yes" data-cost="0.25" type="checkbox"><i></i>Fix Imperfection: <span class="text-info">$0.25</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <input type="hidden" id="shadow_option_value" name="shadow_option_value" value="0"/>
                                                <input type="hidden" id="mannequin_option_value" name="mannequin_option_value" value="0"/>
                                                <input type="hidden" id="staight_value" name="staight_value" value="0"/>
                                                <input type="hidden" id="brightness_value" name="brightness_value" value="0"/>

                                                <a href="#" class="clear_shadow_option">Clear Selection</a>
                                            </div>
                                            <div class="h6 text-left font-bold m-b-n m-t-xl no-padder"><span class="text-info dker">Cropping &amp; Resizing</span></div>
                                            <hr>
                                            <div class="padder m-t-n free_variation">
                                                <div class="col-sm-6 text-left no-padder">
                                                    <label class="radio i-checks m-l-n">
                                                        <input id="variation1" name="variation" value="Variation (Upto 1)" type="radio" checked=""><i></i>Variation (Upto 1): <span class="text-info">Free</span>
                                                    </label>
                                                </div>
                                                <div class="col-sm-6 text-left no-padder m-b-sm">
                                                    <label class="radio i-checks m-l-n">
                                                        <input id="variation2" name="variation" value="Variation (Upto 3)" type="radio"><i></i>Variation (Upto 3): <span class="text-info">$0.25</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="m-l-n m-r-n wrapper">
                                                <textarea name="variation_desc" class="form-control input-sm block" rows="3" data-minwords="6" placeholder="Please write down your cropping &amp; resizing details here..."></textarea>
                                            </div>
                                            <div class="h6 text-left font-bold m-b-n m-t-xl"><span class="text-info dker">Return File Format</span></div>
                                            <hr>
                                            <div class="form-horizontal"></div>
                                            <div class="form-group m-t-n m-l-n">
                                                <div class="col-sm-12 m-b-lg rf_format">
                                                    <label class="checkbox-inline i-checks">
                                                        <input type="checkbox" id="rt_jpg" name="return_file_type[]" value="JPG" checked=""><i></i>JPG
                                                    </label>
                                                    <label class="checkbox-inline i-checks">
                                                        <input type="checkbox" id="rt_png" name="return_file_type[]" value="PNG"><i></i>PNG
                                                    </label>
                                                    <label class="checkbox-inline i-checks">
                                                        <input type="checkbox" id="rt_psd" name="return_file_type[]" value="PSD"><i></i> <span class="text-danger" data-toggle="tooltip" data-placement="top" title="Requesting PSD File will cost: $0.05 / Image in addition.">PSD!</span>
                                                    </label>
                                                    <label class="checkbox-inline i-checks">
                                                        <input type="checkbox" id="rt_tiff" name="return_file_type[]" value="TIFF"><i></i> <span class="text-danger" data-toggle="tooltip" data-placement="top" title="Requesting TIFF File will cost: $0.05 / Image in addition.">TIFF!</span>
                                                    </label>
                                                    <label class="checkbox-inline i-checks">
                                                        <input type="checkbox" id="rt_eps" name="return_file_type[]" value="EPS"><i></i>EPS
                                                    </label>
                                                    <label class="checkbox-inline i-checks">
                                                        <input type="checkbox" id="rt_ai" name="return_file_type[]" value="AI"><i></i>AI
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="h6 text-left font-bold m-b-n m-t-xl">More: <span class="text-info dker">Job Title &amp; Message</span></div>
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

                            <div class="col-lg-4 no-padder m-n">
                                <div class="wrapper" id="sidebar">
                                    <!-- .breadcrumb -->
                                    <ul class="breadcrumb" style="min-width:220px;">
                                        <li><i class="fa fa-dollar m-r-xm"></i> Summary &amp; Payment</li>
                                    </ul>
                                    <!-- / .breadcrumb -->
                                    <section class="panel panel-default" style="min-width:220px;">
                                        <div class="wrapper">
                                            <div class="form-horizontal">
                                                <div class="form-group m-b-none">
                                                    <div class="col-sm-12 m-b-none">
                                                        <div class="h6 text-left font-bold m-b-n"><span class="text-info dker">Turnaround Times</span></div>
                                                        <hr>
                                                        <div class="m-t-n">
                                                            <div class="row">
                                                                <div class="col-xs-6">
                                                                    <label class="radio i-checks">
                                                                        <input id="tat_24" name="tat" value="24" type="radio"/><i></i>24 Hours
                                                                    </label>
                                                                </div>
                                                                <div class="col-xs-6">
                                                                    <label class="radio i-checks">
                                                                        <input id="tat_48" name="tat" value="48" type="radio" checked="checked" /><i></i>48 Hours
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-xs-6">
                                                                    <label class="radio i-checks">
                                                                        <input id="tat_72" name="tat" value="72" type="radio"/><i></i>72 Hours
                                                                    </label>
                                                                </div>
                                                                <div class="col-xs-6">
                                                                    <label class="radio i-checks">
                                                                        <input id="tat_0" name="tat" value="0" type="radio"/><i></i>Flexible
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="h6 text-left font-bold m-t-md m-b-n"><span class="text-info dker">Cost Calculation</span></div>
                                                        <hr>
                                                        <div id="costing_box" class="m-t-n">
                                                            <?php
                                                            /*
                                                            
                                                            <div class="hbox b-b b-light m-b-xs">
                                                                <span class="pull-left">Image Quantity</span><span class="pull-right text-info dker" id="total_images">0</span>
                                                            </div> 
                                                            <div id="cp_pricing" class="hbox b-b b-light m-b-xs">
                                                                <span class="pull-left">CP - Basic: ($0.50)</span><span class="pull-right text-info dker" id="">0.00$</span>
                                                            </div> 
                                                            <div id="mask_pricing" class="hbox b-b b-light m-b-xs">
                                                                <span class="pull-left">Image Masking: ($0.50)</span><span class="pull-right text-info dker" id="">0.00$</span>
                                                            </div> 
                                                            <div id="retouch_pricing" class="hbox b-b b-light m-b-xs">
                                                                <span class="pull-left">Image Retouching / Touch-Up</span><span class="pull-right text-info dker" id="">0.00$</span>
                                                            </div> 
                                                            <div class="hbox b-b b-light m-b-xs">
                                                                <span class="pull-left">Drop Shadow: ($0.25)</span><span class="pull-right text-info dker">0.00$</span>
                                                            </div> 
                                                            <div class="hbox b-b b-light m-b-xs">
                                                                <span class="pull-left">Nick-Joint: ($1.00)</span><span class="pull-right text-info dker">0.00$</span>
                                                            </div> 
                                                            <div class="hbox b-b b-light m-b-xs">
                                                                <span class="pull-left">Crop-Resize: ($0.25)</span><span class="pull-right text-info dker">0.00$</span>
                                                            </div> 
                                                            <div class="hbox b-b b-dark m-b-xs">
                                                                <span class="pull-left">PSD File: ($0.05)</span><span class="pull-right text-info dker">0.00$</span>
                                                            </div>
                                                            <div class="hbox font-bold m-b-xs">
                                                                <span class="pull-left">Total Price:</span><span class="pull-right text-info dker">0.00$</span>
                                                            </div>

                                                            */
                                                            ?>
                                                        </div>
                                                        <div class="clearfix both"></div>
                                                        <div class="h6 text-left font-bold m-b-n m-t"><span class="text-info dker">Payment Form</span></div>
                                                        <hr>
                                                        <div class="m-t-n">
                                                            <label class="radio i-checks">
                                                                <input id="pay_now" checked="" name="payment_option" value="Pay Now" type="radio"><i></i>I will pay now
                                                            </label>
                                                            <label class="radio i-checks">
                                                                <input id="pay_later" name="payment_option" value="Pay Later" type="radio"><i></i>I will pay later - <span class="text-info dker" data-toggle="tooltip" data-placement="top" data-title="Please select if you want to pay us weekly basis.">Weekly</span>
                                                            </label>
                                                            <label class="radio i-checks hide">
                                                                <input id="qoute_only" name="payment_option" value="Request Quote" type="radio"><i></i>Supply me a quote
                                                            </label>
                                                        </div>
                                                        <div class="clearfix noheight"></div>
                                                        <div id="payment_method">
                                                            <div class="h6 text-left font-bold m-b-n m-t-md"><span class="text-info dker">Payment Method</span></div>
                                                            <hr class="m-b-none">
                                                            <div class="row">
                                                                <div class="col-xs-6 m-l-n p-r-none">
                                                                    <label class="radio i-checks">
                                                                        <input id="paypal" name="payment_method" value="PayPal" type="radio" checked=""><i></i><img src="<?php echo base_url();?>assets/images/paypal.png" alt="Paypal" />
                                                                    </label>
                                                                </div>
                                                                <div class="col-xs-6 m-r p-r-none">
                                                                    <label class="radio i-checks">
                                                                        <input id="payza" name="payment_method" value="Payza" type="radio"><i></i><img src="<?php echo base_url();?>assets/images/payza.png" alt="Payza" />
                                                                    </label>
                                                                </div>
                                                            </div>    
                                                        </div>
                                                        <div class="m-t">
                                                            <button type="submit" id="btn_order_submit" class="btn btn-info btn-block">Pay Now</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                            <input type="hidden" id="total_progress" name="total_progress" value="">
                        </form>
                    </section>
                </section>
            </aside>
                    
        </section>
    </section>
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>

<script type="application/javascript">
    var totaluploadprogress = 0;
    $(document).ready(function(){
        Portal.PageInit.PlaceOrder();
        Portal.Helpers.handlePlaceoderSidebarStyle();
        
        Dropzone.options.fileUpload = {
            init: function() {
                this.on("addedfile", function(file) {
                    $("#progress_bar").show().addClass('bounceIn');
                    totaluploadprogress = 0;
                });

                this.on("success", function(file, response) {
                    file.serverId = response;
                    if(response.status == "OK"){
                        var preview = response.preview[0];
                        file.previewElement.querySelector("img").src = preview;
                        total_images += 1;
                        Portal.Order.addNew.CostCalc();
                    }
                    else{
                        Portal.alert({title: 'File Upload Error!', text: response.msg.error, type: "danger"});
                    }
                });

                this.on("error", function(file, response) {
                    console.log(response);
                });

                this.on("removedfile", function(file){
                    $.ajax({
                        url: ajax_url + "/remove_tmp_file?order_id=<?php echo $order_id;?>",
                        data: file.serverId,
                        type: 'POST',
                        dataType: 'JSON',
                        success: function (data) {
                            if(data.status=='OK'){
                                total_images -= 1;
                                Portal.Order.addNew.CostCalc();
                            }
                        },
                        error: function (data) {
                        }
                    });
                });

                this.on("queuecomplete", function(file){
                    $("#upload_status").val('complete');
                });

                this.on("totaluploadprogress", function(percent, totalBytes, totalBytesSent){
                    console.log("percent:"+percent + ' | totalBytes:' + totalBytes + " | totalBytesSent:" + totalBytesSent);
                    if(percent > totaluploadprogress){
                        totaluploadprogress = percent;
                        var round_percent = Math.round(percent);
                        $("#total_progress").val(percent);
                        $("#progress_bar .text-info span").text(round_percent);
                        $("#progress_bar").find('.progress-bar').css('width', percent+'%');
                    }
                });
            },
            url: "<?php echo site_url('ajax/uploader/').'?order_id='.$order_id;?>",
            paramName: "file",
            maxFilesize: 512, // MB
            addRemoveLinks: true,
            maxFiles: 5000,
            maxThumbnailFilesize: 0.1, //MB
            //acceptedFiles: "image/*,.psd,.ai,.eps,.tif,.tiff,.pdf,.PSD,.AI,.EPS,.TIF,.TIFF,.PDF",
            acceptedFiles: ".jpg,.jpeg,.png,.psd,.tiff,.pdf,.eps,.ai,.svg,.3fr,.ari,.arw,.srf,.sr2,.bay,.crw,.cr2,.cap,.iiq,.eip,.dcs,.dcr,.drf,.k25,.kdc,.dng,.erf,.fff,.mef,.mdc,.mos,.mrw,.nef,.nrw,.orf,.pef,.ptx,.pxn,.R3D,.raf,.raw,.rw2,.raw,.rwl,.dng,.rwz,.srw,.x3f",
            //acceptedFiles: "image/*",
        };
            

        $(document).on('click', function(event) {
            Portal.Helpers.handlePlaceoderSidebarStyle();
        });
    });


</script>

