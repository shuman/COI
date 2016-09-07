 <section class="hbox stretch">
    <section class="vbox" id="dashboard-custom-style">
        <section class="scrollable padder">
            <section class="row m-b-md">
                <div class="col-sm-6">
                    <h3 class="m-b-xs text-black">Create Quote</h3>
                    <small>New Create Quote</small>
                    <!-- <pre><?php print_r($orders); ?><pre/> -->
                </div>
                <div class="col-sm-6">
                    <ul class="breadcrumb pull-right-lg" style="background: transparent; border: 0;">
                        <li><a href="<?php echo site_url('/admin/');?>"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Quote Order</li>
                    </ul>
                </div>
            </section>
            <div class="row">
                <div class="col-sm-12">
                    <form id="quoteForm" action="" method="post" name="quoteForm" novalidate style="max-width: 850px; width: 100%;">
                        <div class="clearfix par block p-md bg-white b-a">
                            <input type="hidden" name="order_id" value="" />
                            <input type="hidden" name="o_service" value="cutout" />
                            <input type="hidden" name="service_option_cutout" value="cutout" />
                            <input type="hidden" name="tat" value="0" />
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="h6 text-left font-bold m-b-n text-info dker">Quotation Title:</div>
                                    <hr>
                                    <div class="form-group">
                                        <input type="text" name="job_title" class="form-control parsley-validated block" required placeholder="Quotation Title" />
                                    </div>
                                </div>
                            </div>
                            <div class="m-t-n clearfix" id="quote_services">
                                <div class="h6 text-left font-bold m-b-n m-t-l"><span class="text-info dker">Service Type / Required Services</span></div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6 text-left smo_mro">
                                        
                                        <div class="form-group m-t-n">
                                            <label class="checkbox i-checks">
                                                <input name="service_types[]" class="s_type" value="Cut Out" type="checkbox" ng-click="qServiceSelection($event)"><i></i>
                                                Photo Cut Out <span class="hoverPopover" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url();?>assets/images/pricing/shadow/1.jpg' /></div>" rel="popover" data-placement="right" data-original-title="Cut Out"><span class="fa fa-question-circle text-info"></span></span>
                                            </label>
                                            <label class="checkbox i-checks">
                                                <input name="service_types[]" class="s_type" value="Clipping Path" type="checkbox" ng-click="qServiceSelection($event)"><i></i>
                                                Clipping Path <span class="hoverPopover" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url();?>assets/images/pricing/shadow/1.jpg' /></div>" rel="popover" data-placement="right" data-original-title="Clipping Path"><span class="fa fa-question-circle text-info"></span></span>
                                            </label>
                                            <label class="checkbox i-checks">
                                                <input name="service_types[]" class="s_type" value="Background Removal" type="checkbox" ng-click="qServiceSelection($event)"><i></i>
                                                Background Removal <span class="hoverPopover" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url();?>assets/images/pricing/shadow/1.jpg' /></div>" rel="popover" data-placement="right" data-original-title="Background Removal"><span class="fa fa-question-circle text-info"></span></span>
                                            </label>
                                            <label class="checkbox i-checks">
                                                <input name="service_types[]" class="s_type" value="Drop Shadow" type="checkbox" ng-click="qServiceSelection($event)"><i></i>
                                                Drop Shadow <span class="hoverPopover" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url();?>assets/images/pricing/shadow/1.jpg' /></div>" rel="popover" data-placement="right" data-original-title="Drop Shadow"><span class="fa fa-question-circle text-info"></span></span>
                                            </label>
                                            <label class="checkbox i-checks">
                                                <input name="service_types[]" class="s_type" value="Natural Shadow" type="checkbox" ng-click="qServiceSelection($event)"><i></i>
                                                Natural Shadow <span class="hoverPopover" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url();?>assets/images/pricing/shadow/1.jpg' /></div>" rel="popover" data-placement="right" data-original-title="Natural Shadow"><span class="fa fa-question-circle text-info"></span></span>
                                            </label>
                                            <label class="checkbox i-checks">
                                                <input name="service_types[]" class="s_type" value="Reflection Shadow" type="checkbox" ng-click="qServiceSelection($event)"><i></i>
                                                Reflection Shadow <span class="hoverPopover" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url();?>assets/images/pricing/shadow/1.jpg' /></div>" rel="popover" data-placement="right" data-original-title="Reflection Shadow"><span class="fa fa-question-circle text-info"></span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 text-left smo_mro">
                                        <div class="form-group m-t-n">
                                            <label class="checkbox i-checks">
                                                <input name="service_types[]" class="s_type" value="Mirror Effect" type="checkbox" ng-click="qServiceSelection($event)"><i></i>
                                                Mirror Effect <span class="hoverPopover" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url();?>assets/images/pricing/shadow/1.jpg' /></div>" rel="popover" data-placement="right" data-original-title="Mirror Effect"><span class="fa fa-question-circle text-info"></span></span>
                                            </label>
                                            <label class="checkbox i-checks">
                                                <input name="service_types[]" class="s_type" value="Photo Retouching" type="checkbox" ng-click="qServiceSelection($event)"><i></i>
                                                Photo Retouching <span class="hoverPopover" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url();?>assets/images/pricing/shadow/1.jpg' /></div>" rel="popover" data-placement="right" data-original-title="Photo Retouching"><span class="fa fa-question-circle text-info"></span></span>
                                            </label>
                                            <label class="checkbox i-checks">
                                                <input name="service_types[]" class="s_type" value="Mannequin Removal" type="checkbox" ng-click="qServiceSelection($event)"><i></i>
                                                Mannequin Removal <span class="hoverPopover" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url();?>assets/images/pricing/shadow/1.jpg' /></div>" rel="popover" data-placement="right" data-original-title="Mannequin Removal"><span class="fa fa-question-circle text-info"></span></span>
                                            </label>
                                            <label class="checkbox i-checks">
                                                <input name="service_types[]" class="s_type" value="Crop-Resizing" type="checkbox" ng-click="qServiceSelection($event)"><i></i>
                                                Crop-Resizing <span class="hoverPopover" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url();?>assets/images/pricing/shadow/1.jpg' /></div>" rel="popover" data-placement="right" data-original-title="Crop-Resizing"><span class="fa fa-question-circle text-info"></span></span>
                                            </label>
                                            <label class="checkbox i-checks">
                                                <input name="service_types[]" class="s_type" value="E-Commerce Optimization" type="checkbox" ng-click="qServiceSelection($event)"><i></i>
                                                E-Commerce Optimization <span class="hoverPopover" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url();?>assets/images/pricing/shadow/1.jpg' /></div>" rel="popover" data-placement="right" data-original-title="E-Commerce Optimization"><span class="fa fa-question-circle text-info"></span></span>
                                            </label>
                                            <label class="checkbox i-checks">
                                                <input name="service_types[]" class="s_type" value="I'm Not Certain" type="checkbox" ng-click="qServiceSelection($event)"><i></i>
                                                I'm Not Certain <span class="hoverPopover" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url();?>assets/images/pricing/shadow/1.jpg' /></div>" rel="popover" data-placement="right" data-original-title="I'm Not Certain"><span class="fa fa-question-circle text-info"></span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="h6 text-left font-bold m-b-n m-t-l"><span class="text-info dker">Retouching Photos</span></div>
                                    <hr>
                                    <div class="form-horizontal"></div>
                                    <div class="form-group m-t-n m-l-n">
                                        <div class="col-sm-12 m-b-lg rf_format">
                                            <label class="radio-inline i-checks">
                                                <input type="radio" name="retouching_opt" value="None" checked="" ng-click="qRetouching = false"><i></i>None
                                            </label>
                                            <label class="radio-inline i-checks">
                                                <input type="radio" name="retouching_opt" value="Basic Retouching" ng-click="qRetouching = 'Basic Retouching'"><i></i>Basic Retouching
                                            </label>
                                            <label class="radio-inline i-checks">
                                                <input type="radio" name="retouching_opt" value="Highend Retouching" ng-click="qRetouching = 'Highend Retouching'"><i></i>Highend Retouching
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
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
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="h6 text-left font-bold m-b-n m-t-l"><span class="text-info dker">File Format</span></div>
                                    <hr>
                                    <div class="form-horizontal"></div>
                                    <div class="form-group m-t-n m-l-n">
                                        <div class="col-sm-12 m-b-lg rf_format">
                                            <label class="checkbox-inline i-checks">
                                                <input type="checkbox" id="rt_jpg" name="return_file_type[]" value="JPG" ng-click="qReturnFileTypeSelection($event)"><i></i>JPG
                                            </label>
                                            <label class="checkbox-inline i-checks">
                                                <input type="checkbox" id="rt_png" name="return_file_type[]" value="PNG" ng-click="qReturnFileTypeSelection($event)"><i></i>PNG
                                            </label>
                                            <label class="checkbox-inline i-checks">
                                                <input type="checkbox" id="rt_psd" name="return_file_type[]" value="PSD" ng-click="qReturnFileTypeSelection($event)"><i></i> <span class="text-danger" data-toggle="tooltip" data-placement="top" title="Requesting PSD File will cost: $0.05 / Image in addition.">PSD!</span>
                                            </label>
                                            <label class="checkbox-inline i-checks">
                                                <input type="checkbox" id="rt_tiff" name="return_file_type[]" value="TIFF" ng-click="qReturnFileTypeSelection($event)"><i></i> <span class="text-danger" data-toggle="tooltip" data-placement="top" title="Requesting TIFF File will cost: $0.05 / Image in addition.">TIFF!</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="h6 text-left font-bold m-b-n text-info dker">Background Options:</div>
                                    <hr>
                                    <div class="form-horizontal"></div>
                                    <div class="form-group m-t-n m-l-n">
                                        <div class="col-sm-12 m-b-lg rf_format">
                                            <label class="radio-inline i-checks">
                                                <input type="radio" id="rt_jpg" name="cutout_bg_option" value="White BG" ng-click="bgOpt = 'White BG'" ng-init="bgOpt = 'White BG'" checked=""><i></i>White
                                            </label>
                                            <label class="radio-inline i-checks">
                                                <input type="radio" id="rt_png" name="cutout_bg_option" value="Transparent" ng-click="bgOpt = 'Transparent BG'"><i></i>Transparent
                                            </label>
                                            <label class="radio-inline i-checks">
                                                <input type="radio" id="rt_png" name="cutout_bg_option" value="Original" ng-click="bgOpt = 'Original'"><i></i>Original
                                            </label>
                                            <label class="radio-inline i-checks">
                                                <input type="radio" id="rt_png" name="cutout_bg_option" value="Custom" ng-click="bgOpt = 'Custom'"><i></i>Custom
                                            </label>
                                            <label class="">
                                                <input type="text"  name="cutout_bg_color" value="#1CCACC" class="minicolors" style="width: 80px;">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="h6 text-left font-bold m-b-n text-info dker">Detailed Requirements:</div>
                                    <hr>
                                    <div class="form-horizontal"></div>
                                    <div class="form-group">
                                        <div class="m-b-lg">
                                            <textarea name="job_desc" class="form-control input-sm block" rows="3" placeholder="" required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 no-padder">
                            <div class="form-group">
                                <input type="submit" name="submit" class="form-control  block btn btn-info m-t-md" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </section>
</section>
