<div class="col-lg-8 no-padder m-n">
    <div class="wrapper">
        <!-- .breadcrumb -->
        <ul class="breadcrumb">
            <li><i class="i i-pencil2 m-r-xs"></i> Instructions / Job Details</li>
        </ul>
        <!-- / .breadcrumb -->

        <!-- left tab -->
        <section class="panel panel-default">
            <section class="row m-l-none m-r-none m-b text-center box-shadow">
                <div class="col-xs-4 bg-success lt r-tl ">
                    <div class="wrapper">
                        <a href="#clipping-path" data-toggle="tab">
                            <div class="service_cp"><img src="<?php echo base_url();?>assets/images/dot.png" /></div>
                        </a>
                        <small class="m-t-xs">CutOut</small>
                    </div>
                </div>

                <div class="col-xs-4 bg-success">
                    <div class="wrapper">
                        <a href="#image-masking" data-toggle="tab">
                            <div class="service_mask"><img src="<?php echo base_url();?>assets/images/dot.png" /></div>
                        </a>
                        <small class="m-t-xs">Masking</small>
                    </div>
                </div>

                <div class="col-xs-4 bg-success lt r-tr">
                    <div class="wrapper">
                        <a href="#image-retouching" data-toggle="tab">
                            <div class="service_retouch"><img src="<?php echo base_url();?>assets/images/dot.png" /></div>
                        </a>
                        <small class="m-t-xs">Retouch</small>
                    </div>
                </div>
            </section>

            <div class="panel-body">
                <div class="tab-content">              
                    <div class="tab-pane active" id="clipping-path">
                        <div class="h5 text-left font-bold m-b-n">Service Options: <span class="text-success">Cut Out / Clipping Path</span></div>
                        <hr>
                        <form class="form-horizontal">
                            <div class="form-group">
                                <div class="col-sm-8 m-b">
                                    <label class="radio i-checks"><input id="cp1" name="cp" value="Clipping Path Only" type="radio"><i></i>Clipping Path Only</label>
                                    <label class="radio i-checks"><input id="cp2" name="cp" value="CP with White BG" type="radio"><i></i>Clipping Path w/ White BG</label>
                                    <label class="radio i-checks"><input id="cp3" name="cp" value="CP with Transparent BG" type="radio"><i></i>Clipping Path w/ Transparent BG</label>
                                    <label class="radio i-checks"><input id="cp4" name="cp" value="CP with Original Shadow" type="radio"><i></i>Clipping Path w/ Shadow</label>
                                    <label class="radio i-checks"><input id="cp5" name="cp" value="CP with Flatness" type="radio"><i></i>Clipping Path w/ Flatness</label>
                                </div>
                                <div class="col-sm-4 b-l">
                                    <div class="input-group">
                                        <input type="text" class="form-control input-sm" id="flatness" placeholder="Flatness (if any)">
                                        <span class="input-group-addon">px</span>
                                    </div>
                                </div>
                            </div>
                        </form>
                        
                        <div class="h6 text-left font-bold m-b-n m-t-md">Image Complexity: <span class="text-success">Price Per Image</span></div>
                        <hr>
                        <div class="padder m-b-n m-t-n">
                            <div class="form-horizontal">
                                <div class="form-group">
                                    <div class="col-sm-2 text-center">
                                        <span id="ar-pop1" data-html="true" data-container="body" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url();?>assets/images/pricing/d/1.png' /></div>" rel="popover" data-placement="top" data-original-title="CP - Basic: US $0.50 / Image"> <img src="<?php echo base_url();?>assets/images/pricing/1.jpg" /></span>
                                    </div>
                                    <div class="col-sm-2 text-center">
                                        <span id="ar-pop2" data-html="true" data-container="body" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url();?>assets/images/pricing/d/2.png' /></div>" rel="popover" data-placement="top" data-original-title="CP - Regular: US $1.00 / Image"> <img src="<?php echo base_url();?>assets/images/pricing/2.jpg" />
                                        </span>
                                    </div>
                                    <div class="col-sm-2 text-center">
                                        <span id="ar-pop3" data-html="true" data-container="body" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url();?>assets/images/pricing/d/3.png' /></div>" rel="popover" data-placement="top" data-original-title="CP - Medium: US $2.00 / Image"> <img src="<?php echo base_url();?>assets/images/pricing/3.jpg" />
                                        </span>
                                    </div>
                                    <div class="col-sm-2 text-center">
                                        <span id="ar-pop4" data-html="true" data-container="body" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url();?>assets/images/pricing/d/4.png' /></div>" rel="popover" data-placement="top" data-original-title="CP - Advance: US $3.50 / Image"> <img src="<?php echo base_url();?>assets/images/pricing/4.jpg" />
                                        </span>
                                    </div>
                                    <div class="col-sm-2 text-center">
                                        <span id="ar-pop5" data-html="true" data-container="body" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url();?>assets/images/pricing/d/5.png' /></div>" rel="popover" data-placement="top" data-original-title="CP - Complex: US $7.00 / Image"> <img src="<?php echo base_url();?>assets/images/pricing/5.jpg" />
                                        </span>
                                    </div>
                                    <div class="col-sm-2 text-center">
                                        <span id="ar-pop6" data-html="true" data-container="body" data-content="<div class='text-justify text-black bg-info .text-lg wrapper' style='border:1px solid #20c198; border-radius:3px;'>If you don't really understand the images complexity or images are super complex, please <strong>'REQUEST FOR QUOTE'</strong>. <br /><br />Our CSR will get back to you with a price update shortly.</div>" rel="popover" data-placement="top" data-original-title="CP - Super Complex: Request Quote"> <img src="<?php echo base_url();?>assets/images/pricing/6.jpg" />
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                        <div class="padder m-t-n">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <div class="col-sm-2 text-center">
                                        <label class="radio i-checks text"><input id="cp-p1" name="cp-p" value="option2" type="radio"><i></i> 0.5$</label>
                                    </div>
                                    <div class="col-sm-2 text-center">
                                        <label class="radio i-checks"><input id="cp-p2" name="cp-p" value="option2" type="radio"><i></i>1.0$</label>
                                    </div>
                                    <div class="col-sm-2 text-center">
                                        <label class="radio i-checks"><input id="cp-p3" name="cp-p" value="option2" type="radio"><i></i>2.0$</label>
                                    </div>
                                    <div class="col-sm-2 text-center">
                                        <label class="radio i-checks"><input id="cp-p4" name="cp-p" value="option2" type="radio"><i></i>3.5$</label>
                                    </div>
                                    <div class="col-sm-2 text-center">
                                        <label class="radio i-checks"><input id="cp-p5" name="cp-p" value="option2" type="radio"><i></i>7.0$</label>
                                    </div>
                                    <div class="col-sm-2 text-center">
                                        <label class="radio i-checks"><input id="cp-p6" name="cp-p" value="option2" type="radio"><i></i><span data-toggle="tooltip" data-placement="top" title="Request for Quotation">RFQ</span></label>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="h6 text-left font-bold m-b-n m-t-xl"><span class="text-success">Shadow &amp; Manipulation</span></div>
                        <hr>
                        <div class="padder m-t-n">
                            <div class="col-sm-6 text-left no-padder">
                                <div class="h6 text-info dker m-l-n m-r-n m-b-n m-t-xm">|| Shadow Making Options</div>
                                <hr class="m-l-n m-r-n"/>
                                <form class="form-horizontal">
                                    <div class="form-group m-t-n">
                                        <label class="radio i-checks">
                                            <input id="cp1" name="cp" value="option1" type="radio">
                                            <i></i>
                                            Drop Shadow:  <span id="ar-pop7" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url();?>assets/images/pricing/shadow/1.jpg' /></div>" rel="popover" data-placement="right" data-original-title="Drop Shadow: US $0.25 / Image">$0.25</span>
                                        </label>

                                        <label class="radio i-checks">
                                            <input id="cp2" name="cp" value="option2" type="radio">
                                            <i></i>
                                            Natural Shadow: <span id="ar-pop8" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url();?>assets/images/pricing/shadow/2.jpg' /></div>" rel="popover" data-placement="right" data-original-title="Natural Shadow: US $0.50 / Image">$0.50</span>
                                        </label>
                                        <label class="radio i-checks">
                                            <input id="cp3" name="cp" value="option1" type="radio">
                                            <i></i>
                                            Reflection Shadow: <span id="ar-pop9" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url();?>assets/images/pricing/shadow/3.jpg' /></div>" rel="popover" data-placement="right" data-original-title="Reflection Shadow: US $0.50 / Image">$0.50</span>
                                        </label>
                                        <label class="radio i-checks">
                                            <input id="cp4" name="cp" value="option2" type="radio">
                                            <i></i>
                                            Mirror Effect: <span id="ar-pop10" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url();?>assets/images/pricing/shadow/4.jpg' /></div>" rel="popover" data-placement="right" data-original-title="Mirror Effect: US $0.50 / Image">$0.50</span>
                                        </label>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-6 text-left no-padder">
                                <div class="h6 text-info dker m-l-n m-r-n m-b-n m-t-xm">|| Mannequin Remove Options</div>
                                <hr class="m-l-n m-r-n"/>
                                <form class="form-horizontal">
                                    <div class="form-group m-t-n m-b-xl">
                                        <label class="radio i-checks">
                                            <input id="manniquin" name="manniquin" value="Neck Joint" type="radio">
                                            <i></i>
                                            Neck-Joint: <span id="ar-pop11" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url();?>assets/images/pricing/neck/1.jpg' /></div>" rel="popover" data-placement="right" data-original-title="Neck-Joint: US $1.00 / Image">$1.00</span>
                                        </label>

                                        <label class="radio i-checks">
                                            <input id="manniquin2" name="manniquin" value="Manniquin Remove" type="radio">
                                            <i></i>
                                            Ghost Mannequin: <span id="ar-pop12" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url();?>assets/images/pricing/neck/2.jpg' /></div>" rel="popover" data-placement="right" data-original-title="Ghost Mannequin: US $1.50 / Image">$1.50</span>
                                        </label>
                                        <label class="checkbox i-checks">
                                            <input id="staight" name="staight" value="Straight-Symmetric" type="checkbox">
                                            <i></i>
                                            Straight & Symmetric: <span class="text-info">$0.25</span>
                                        </label>

                                        <label class="checkbox i-checks">
                                            <input id="brightness" name="staight" value="Imperfection-Brightness" type="checkbox">
                                            <i></i>
                                            Fix Imperfection: <span class="text-info">$0.25</span>
                                        </label>
                                    </div>
                                </form>
                            </div>
                            <div class="h6 text-left font-bold m-b-n m-t-xl"><span class="text-success">Cropping &amp; Resizing</span></div>
                            <hr>
                            <div class="padder m-t-n">
                                <div class="col-sm-6 text-left no-padder">
                                    <label class="radio i-checks m-l-n">
                                        <input id="manniquin" name="manniquin" value="Neck Joint" type="radio">
                                        <i></i>
                                        Variation (Upto 1): <span class="text-info">Free</span>
                                    </label>
                                </div>

                                <div class="col-sm-6 text-left no-padder m-b-sm">
                                    <label class="radio i-checks m-l-n">
                                        <input id="manniquin" name="manniquin" value="Neck Joint" type="radio">
                                        <i></i>
                                        Variation (Upto 3): <span class="text-info">$0.25</span>
                                    </label>
                                </div>
                            </div>
                            <div class="m-l-n m-r-n wrapper">
                                <textarea class="form-control input-sm block" rows="3" data-minwords="6" placeholder="Please write down your cropping &amp; resizing details here..."></textarea>
                            </div>

                            <div class="h6 text-left font-bold m-b-n m-t-xl"><span class="text-success">Return File Format</span></div>
                            <hr>
                            <div class="form-horizontal"></div>
                            <div class="form-group m-t-n m-l-n">
                                <div class="col-sm-12 m-b-lg ">
                                    <label class="checkbox-inline i-checks"><input type="checkbox" id="inlineCheckbox1" value="JPG"><i></i>JPG</label>
                                    <label class="checkbox-inline i-checks"><input type="checkbox" id="inlineCheckbox2" value="PNG"><i></i>PNG</label>
                                    <label class="checkbox-inline i-checks"><input type="checkbox" id="inlineCheckbox3" value="PSD"><i></i>PSD <span class="text-danger font-bold" data-toggle="tooltip" data-placement="top" title="Requesting PSD File will cost: $0.05/Image in addition.">!</span></label>
                                    <label class="checkbox-inline i-checks"><input type="checkbox" id="inlineCheckbox4" value="TIFF"><i></i>TIFF <span class="text-danger font-bold" data-toggle="tooltip" data-placement="top" title="Requesting TIFF File will cost: $0.05/Image in addition.">!</span></label>
                                    <label class="checkbox-inline i-checks"><input type="checkbox" id="inlineCheckbox6" value="EPS"><i></i>EPS</label>
                                    <label class="checkbox-inline i-checks"><input type="checkbox" id="inlineCheckbox7" value="AI"><i></i>AI</label>
                                </div>
                            </div>
                            <div class="h6 text-left font-bold m-b-n m-t-xl">More: <span class="text-success">Job Title &amp; Message</span></div>
                            <hr>
                            <div class="form-group">
                                <input type="text" class="form-control block" data-required="true" class="form-control" placeholder="Job Title">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control input-sm block" rows="6" data-minwords="6" placeholder="Message (Further instructions if any...)"></textarea>
                            </div>
                            
                        </div>









                        <div class="tab-pane" id="image-masking">
                            <div class="h5 text-left font-bold m-b-n">Service Options: <span class="text-success">Image Masking / Knockout</span></div>
                            <hr>
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <div class="col-sm-8 m-b">
                                        <label class="radio i-checks"><input id="cp1" name="cp" value="Clipping Path Only" type="radio"><i></i>Layer Masking</label>
                                        <label class="radio i-checks"><input id="cp2" name="cp" value="CP with White BG" type="radio"><i></i>Alpha Channel Masking</label>
                                        <label class="radio i-checks"><input id="cp3" name="cp" value="CP with Transparent BG" type="radio"><i></i>Translucent Masking</label>
                                    </div>
                                    <!--col-sm-8-->
                                    <div class="col-sm-4 b-l">
                                        <div class="input-group"><input type="text" class="form-control input-sm" id="flatness" placeholder="Flatness (if any)"><span class="input-group-addon">px</span></div>
                                    </div>
                                </div>
                                <!--form-group-->
                            </form>
                            <div class="h6 text-left font-bold m-b-n m-t-xl"><span class="text-success">Shadow &amp; Manipulation</span></div>
                            <hr>
                            <div class="padder m-t-n">
                                <div class="col-sm-6 text-left no-padder">
                                    <div class="h6 text-info dker m-l-n m-r-n m-b-n m-t-xm">|| Shadow Making Options</div>
                                    <hr class="m-l-n m-r-n">
                                    <form class="form-horizontal">
                                        <div class="form-group m-t-n">
                                            <label class="radio i-checks">
                                                <input id="cp1" name="cp" value="option1" type="radio"> 
                                                <i></i>
                                                Drop Shadow:  
                                                <span id="ar-pop13" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url();?>assets/images/pricing/shadow/1.jpg' /></div>" rel="popover" data-placement="right" data-original-title="Drop Shadow: US $0.25 / Image">$0.25</span>
                                            </label>
                                            <label class="radio i-checks">
                                                <input id="cp2" name="cp" value="option2" type="radio">
                                                <i></i>
                                                Natural Shadow: <span id="ar-pop14" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url();?>assets/images/pricing/shadow/2.jpg' /></div>" rel="popover" data-placement="right" data-original-title="Natural Shadow: US $0.50 / Image">$0.50</span>
                                            </label>
                                            <label class="radio i-checks">
                                                <input id="cp3" name="cp" value="option1" type="radio">
                                                <i></i>
                                                Reflection Shadow: <span id="ar-pop15" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url();?>assets/images/pricing/shadow/3.jpg' /></div>" rel="popover" data-placement="right" data-original-title="Reflection Shadow: US $0.50 / Image">$0.50</span>
                                            </label>
                                            <label class="radio i-checks">
                                                <input id="cp4" name="cp" value="option2" type="radio">
                                                <i></i>
                                                Mirror Effect: <span id="ar-pop16" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url();?>assets/images/pricing/shadow/4.jpg' /></div>" rel="popover" data-placement="right" data-original-title="Mirror Effect: US $0.50 / Image">$0.50</span>
                                            </label>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-sm-6 text-left no-padder">
                                    <div class="h6 text-info dker m-l-n m-r-n m-b-n m-t-xm">|| Mannequin Remove Options</div>
                                    <hr class="m-l-n m-r-n">
                                    <form class="form-horizontal">
                                        <div class="form-group m-t-n m-b-xl">
                                            <label class="radio i-checks">
                                                <input id="manniquin" name="manniquin" value="Neck Joint" disabled type="radio">
                                                <i></i><span class="text-muted">Neck-Joint: $1.00</span>
                                            </label>

                                            <label class="radio i-checks">
                                                <input id="manniquin2" name="manniquin" value="Manniquin Remove" disabled type="radio">
                                                <i></i>
                                                <span class="text-muted">Ghost Mannequin: $1.50</span>
                                            </label>
                                            <label class="checkbox i-checks">
                                                <input id="staight" name="staight" value="Straight-Symmetric" type="checkbox">
                                                <i></i>
                                                Straight &amp; Symmetric: <span class="text-info">$0.25</span>
                                            </label>
                                            <label class="checkbox i-checks">
                                                <input id="brightness" name="staight" value="Imperfection-Brightness" type="checkbox">
                                                <i></i>
                                                Fix Imperfection: <span class="text-info">$0.25</span>
                                            </label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="h6 text-left font-bold m-b-n m-t-xl"><span class="text-success">Cropping &amp; Resizing</span></div>
                            <hr>
                            <div class="padder m-t-n">
                                <div class="col-sm-6 text-left no-padder">
                                    <label class="radio i-checks m-l-n">
                                        <input id="manniquin" name="manniquin" value="Neck Joint" type="radio">
                                        <i></i>
                                        Variation (Upto 1): <span class="text-info">Free</span>
                                    </label>
                                </div>
                                <div class="col-sm-6 text-left no-padder m-b-sm">
                                    <label class="radio i-checks m-l-n">
                                        <input id="manniquin" name="manniquin" value="Neck Joint" type="radio">
                                        <i></i>
                                        Variation (Upto 3): <span class="text-info">$0.25</span>
                                    </label>
                                </div>
                            </div>
                            <div class="m-l-n m-r-n wrapper">
                                <textarea class="form-control input-sm block" rows="3" data-minwords="6" placeholder="Please write down your cropping &amp; resizing details here..."></textarea>
                            </div>
                            <div class="h6 text-left font-bold m-b-n m-t-xl"><span class="text-success">Return File Format</span></div>
                            <hr>
                            <div class="form-horizontal"></div>
                            <div class="form-group m-t-n m-l-n">
                                <div class="col-sm-12 m-b-lg ">
                                    <label class="checkbox-inline i-checks">
                                        <input type="checkbox" id="inlineCheckbox1" value="JPG"> 
                                        <i></i>
                                        JPG
                                    </label>
                                    <label class="checkbox-inline i-checks">
                                        <input type="checkbox" id="inlineCheckbox2" value="PNG"> 
                                        <i></i>
                                        PNG
                                    </label>
                                    <label class="checkbox-inline i-checks">
                                        <input type="checkbox" id="inlineCheckbox3" value="PSD"> 
                                        <i></i>
                                        PSD <span class="text-danger font-bold" data-toggle="tooltip" data-placement="top" title="Requesting PSD File will cost: $0.05/Image in addition.">!</span>
                                    </label>
                                    <label class="checkbox-inline i-checks">
                                        <input type="checkbox" id="inlineCheckbox4" value="TIFF"> 
                                        <i></i>
                                        TIFF <span class="text-danger font-bold" data-toggle="tooltip" data-placement="top" title="Requesting TIFF File will cost: $0.05/Image in addition.">!</span>
                                    </label>
                                    <label class="checkbox-inline i-checks">
                                        <input type="checkbox" id="inlineCheckbox6" value="EPS"> 
                                        <i></i>
                                        EPS
                                    </label>
                                    <label class="checkbox-inline i-checks">
                                        <input type="checkbox" id="inlineCheckbox7" value="AI"> 
                                        <i></i>
                                        AI
                                    </label>
                                </div>
                            </div>
                            <div class="h6 text-left font-bold m-b-n m-t-xl">More: <span class="text-success">Job Title &amp; Message</span></div>
                            <hr>
                            <div class="form-group">
                                <input type="text" class="form-control block" data-required="true" class="form-control" placeholder="Job Title">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control input-sm block" rows="6" data-minwords="6" placeholder="Message (Further instructions if any...)"></textarea>
                            </div>
                        </div>
                        <div class="tab-pane" id="image-retouching">
                            <div class="h5 text-left font-bold m-b-n">Service Options: <span class="text-success">Image Retouching / Touch-Up</span></div>
                            <hr>
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <div class="col-sm-8 m-b">
                                        <label class="radio i-checks">
                                            <input id="cp1" name="cp" value="Clipping Path Only" type="radio">
                                            <i></i>
                                            Model Retouching
                                        </label>

                                        <label class="radio i-checks">
                                            <input id="cp2" name="cp" value="CP with White BG" type="radio">
                                            <i></i>
                                            Jewelry Retouching
                                        </label>

                                        <label class="radio i-checks">
                                            <input id="cp3" name="cp" value="CP with Transparent BG" type="radio">
                                            <i></i>
                                            Product Retouching
                                        </label>
                                    </div>
                                    <!--col-sm-8-->
                                    <div class="col-sm-4 b-l">
                                        <label class="radio i-checks">
                                            <input id="cp2" name="cp" value="CP with White BG" type="radio">
                                            <i></i>
                                            Basic
                                        </label>
                                        <label class="radio i-checks">
                                            <input id="cp3" name="cp" value="CP with Transparent BG" type="radio">
                                            <i></i>
                                            High-End
                                        </label>
                                    </div>
                                </div>
                                <!--form-group-->
                            </form>
                            <div class="h6 text-left font-bold m-b-n m-t-xl"><span class="text-success">Shadow &amp; Manipulation</span></div>
                            <hr>
                            <div class="padder m-t-n">
                                <div class="col-sm-6 text-left no-padder">
                                    <div class="h6 text-info dker m-l-n m-r-n m-b-n m-t-xm">|| Shadow Making Options</div>
                                    <hr class="m-l-n m-r-n">
                                    <form class="form-horizontal">
                                        <div class="form-group m-t-n">
                                            <label class="radio i-checks">
                                                <input id="cp1" name="cp" value="option1" type="radio">
                                                <i></i>
                                                Drop Shadow:  <span id="ar-pop17" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url();?>assets/images/pricing/shadow/1.jpg' /></div>" rel="popover" data-placement="right" data-original-title="Drop Shadow: US $0.25 / Image">$0.25</span>
                                            </label>
                                            <label class="radio i-checks">
                                                <input id="cp2" name="cp" value="option2" type="radio">
                                                <i></i>
                                                Natural Shadow: <span id="ar-pop18" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url();?>assets/images/pricing/shadow/2.jpg' /></div>" rel="popover" data-placement="right" data-original-title="Natural Shadow: US $0.50 / Image">$0.50</span>
                                            </label>
                                            <label class="radio i-checks">
                                                <input id="cp3" name="cp" value="option1" type="radio">
                                                <i></i>
                                                Reflection Shadow: <span id="ar-pop19" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url();?>assets/images/pricing/shadow/3.jpg' /></div>" rel="popover" data-placement="right" data-original-title="Reflection Shadow: US $0.50 / Image">$0.50</span>
                                            </label>

                                            <label class="radio i-checks">
                                                <input id="cp4" name="cp" value="option2" type="radio">
                                                <i></i>
                                                Mirror Effect: <span id="ar-pop20" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url();?>assets/images/pricing/shadow/4.jpg' /></div>" rel="popover" data-placement="right" data-original-title="Mirror Effect: US $0.50 / Image">$0.50</span>
                                            </label>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-sm-6 text-left no-padder">
                                    <div class="h6 text-info dker m-l-n m-r-n m-b-n m-t-xm">|| Mannequin Remove Options</div>
                                    <hr class="m-l-n m-r-n">
                                    <form class="form-horizontal">
                                        <div class="form-group m-t-n m-b-xl">
                                            <label class="radio i-checks">
                                                <input id="manniquin" name="manniquin" value="Neck Joint" disabled type="radio">
                                                <i></i>
                                                <span class="text-muted">Neck-Joint: $1.00</span>
                                            </label>
                                            <label class="radio i-checks">
                                                <input id="manniquin2" name="manniquin" value="Manniquin Remove" disabled type="radio">
                                                <i></i>
                                                <span class="text-muted">Ghost Mannequin: $1.50</span>
                                            </label>
                                            <label class="checkbox i-checks">
                                                <input id="staight" name="staight" value="Straight-Symmetric" type="checkbox">
                                                <i></i>
                                                Straight & Symmetric: <span class="text-info">$0.25</span>
                                            </label>
                                            <label class="checkbox i-checks">
                                                <input id="brightness" name="staight" value="Imperfection-Brightness" type="checkbox">
                                                <i></i>
                                                Fix Imperfection: <span class="text-info">$0.25</span>
                                            </label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="h6 text-left font-bold m-b-n m-t-xl"><span class="text-success">Cropping &amp; Resizing</span></div>
                            <hr>
                            <div class="padder m-t-n">
                                <div class="col-sm-6 text-left no-padder">
                                    <label class="radio i-checks m-l-n">
                                        <input id="manniquin" name="manniquin" value="Neck Joint" type="radio">
                                        <i></i>
                                        Variation (Upto 1): <span class="text-info">Free</span>
                                    </label>
                                </div>
                                <div class="col-sm-6 text-left no-padder m-b-sm">
                                    <label class="radio i-checks m-l-n">
                                        <input id="manniquin" name="manniquin" value="Neck Joint" type="radio">
                                        <i></i>
                                        Variation (Upto 3): <span class="text-info">$0.25</span>
                                    </label>
                                </div>
                            </div>
                            <div class="m-l-n m-r-n wrapper">
                                <textarea class="form-control input-sm block" rows="3" data-minwords="6" placeholder="Please write down your cropping &amp; resizing details here..."></textarea>
                            </div>
                            <div class="h6 text-left font-bold m-b-n m-t-xl"><span class="text-success">Return File Format</span></div>
                            <hr>
                            <div class="form-horizontal"></div>
                            <div class="form-group m-t-n m-l-n">
                                <div class="col-sm-12 m-b-lg ">
                                    <label class="checkbox-inline i-checks">
                                        <input type="checkbox" id="inlineCheckbox1" value="JPG"> 
                                        <i></i>
                                        JPG
                                    </label>
                                    <label class="checkbox-inline i-checks">
                                        <input type="checkbox" id="inlineCheckbox2" value="PNG"> 
                                        <i></i>
                                        PNG
                                    </label>
                                    <label class="checkbox-inline i-checks">
                                        <input type="checkbox" id="inlineCheckbox3" value="PSD"> 
                                        <i></i>
                                        PSD <span class="text-danger font-bold" data-toggle="tooltip" data-placement="top" title="Requesting PSD File will cost: $0.05/Image in addition.">!</span>
                                    </label>
                                    <label class="checkbox-inline i-checks">
                                        <input type="checkbox" id="inlineCheckbox4" value="TIFF"> 
                                        <i></i>
                                        TIFF <span class="text-danger font-bold" data-toggle="tooltip" data-placement="top" title="Requesting TIFF File will cost: $0.05/Image in addition.">!</span>
                                    </label>
                                    <label class="checkbox-inline i-checks">
                                        <input type="checkbox" id="inlineCheckbox6" value="EPS"> 
                                        <i></i>
                                        EPS
                                    </label>
                                    <label class="checkbox-inline i-checks">
                                        <input type="checkbox" id="inlineCheckbox7" value="AI"> 
                                        <i></i>
                                        AI
                                    </label>
                                </div>
                            </div>

                            <div class="h6 text-left font-bold m-b-n m-t-xl">More: <span class="text-success">Job Title &amp; Message</span></div>
                            <hr>
                            <div class="form-group">
                                <input type="text" class="form-control block" data-required="true" class="form-control" placeholder="Job Title">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control input-sm block" rows="6" data-minwords="6" placeholder="Message (Further instructions if any...)"></textarea>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
</div>