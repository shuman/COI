<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.minicolors.css" type="text/css" />   -->
<?php
define('AWS_ACCESS_KEY', 'AKIAIGZJPUUTGWEPZBRQ');
define('AWS_SECRET', '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');

$s3FormDetails = getS3Details('www-cutoutimage-com', 'eu-west-1');

function getS3Details($s3Bucket, $region, $acl = 'private') {

    // Options and Settings
    $awsKey = (!empty(getenv('AWS_ACCESS_KEY')) ? getenv('AWS_ACCESS_KEY') : AWS_ACCESS_KEY);
    $awsSecret = (!empty(getenv('AWS_SECRET')) ? getenv('AWS_SECRET') : AWS_SECRET);

    $algorithm = "AWS4-HMAC-SHA256";
    $service = "s3";
    $date = gmdate("Ymd\THis\Z");
    $shortDate = gmdate("Ymd");
    $requestType = "aws4_request";
    $expires = "86400"; // 24 Hours
    $successStatus = "201";
    $url = "https://{$s3Bucket}.{$service}-{$region}.amazonaws.com";

    // Step 1: Generate the Scope
    $scope = [
        $awsKey,
        $shortDate,
        $region,
        $service,
        $requestType
    ];
    $credentials = implode('/', $scope);

    // Step 2: Making a Base64 Policy
    $policy = [
        'expiration' => gmdate('Y-m-d\TG:i:s\Z', strtotime('+6 hours')),
        'conditions' => [
            ['bucket' => $s3Bucket],
            ['acl' => $acl],
            ['starts-with', '$key', ''],
            ['starts-with', '$Content-Type', ''],
            ['success_action_status' => $successStatus],
            ['x-amz-credential' => $credentials],
            ['x-amz-algorithm' => $algorithm],
            ['x-amz-date' => $date],
            ['x-amz-expires' => $expires],
        ]
    ];
    $base64Policy = base64_encode(json_encode($policy));

    // Step 3: Signing your Request (Making a Signature)
    $dateKey = hash_hmac('sha256', $shortDate, 'AWS4' . $awsSecret, true);
    $dateRegionKey = hash_hmac('sha256', $region, $dateKey, true);
    $dateRegionServiceKey = hash_hmac('sha256', $service, $dateRegionKey, true);
    $signingKey = hash_hmac('sha256', $requestType, $dateRegionServiceKey, true);

    $signature = hash_hmac('sha256', $base64Policy, $signingKey);

    // Step 4: Build form inputs
    // This is the data that will get sent with the form to S3
    $inputs = [
        'Content-Type' => '',
        'acl' => $acl,
        'success_action_status' => $successStatus,
        'policy' => $base64Policy,
        'X-amz-credential' => $credentials,
        'X-amz-algorithm' => $algorithm,
        'X-amz-date' => $date,
        'X-amz-expires' => $expires,
        'X-amz-signature' => $signature
    ];

    return compact('url', 'inputs');
}
?>
<section class="vbox">
    <section ng-controller="mainCtrl">
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
                                        <form action="<?php echo site_url('ajax/uploader'); ?>" class="dropzone dz-clickable" id="file-upload" enctype="multipart/form-data">
                                            <div class="dz-default dz-message"><span>Click or drop your files here!</span></div>
                                        </form>
                                    </div>
                                </div>
                            </section>
                        </div>

                        <div class="wrapper hidden-xs">
                            <section class="panel no-border m-n">
                                <div class="col-lg-12 no-padder m-b-sm">
                                    <form action="<?php echo $s3FormDetails['url']; ?>"
                                          method="POST"
                                          enctype="multipart/form-data"
                                          id="file-upload"
                                          class="dropzone">
<?php foreach ($s3FormDetails['inputs'] as $name => $value) { ?>
                                            <input type="hidden" name="<?php echo $name; ?>" value="<?php echo $value; ?>">
                                              <?php } ?>
                                        <input type="hidden" id="keyInput" name="key" value="">
                                    </form>
                                </div>
                            </section>  
                        </div>
                    </section>
                </section>
            </aside>

            <aside class="col-lg-8 b-l no-padder job_details ">
                <section class="vbox ng-cloak" ng-app="" >
                    <section class="scrollable">                            
                        <div class="col-lg-8 no-padder m-n">
                            <div class="wrapper">
                                <!-- .breadcrumb -->
                                <ul class="breadcrumb">
                                    <li><i class="i i-pencil2 m-r-xs"></i> Instructions / Job Details</li>
                                </ul>
                                <!-- / .breadcrumb -->
                                <!-- left tab -->
                                <section id="service_tab" class="panel panel-default" style="border-top: 0px;">
                                    <section class="row m-l-none m-r-none m-b-none text-center box-shadow">
                                        <svg class="hidden">
                                        <defs>
                                        <path id="tabshape" d="M80,60C34,53.5,64.417,0,0,0v60H80z"/>
                                        </defs>
                                        </svg>

                                        <div class="tabs_shape tabs-style-shape">
                                            <ul style="background-color: #F2F4F8;">
                                                <li class="ord_view select" onclick="showOrderQuote('o')" style="margin-right: 50px;">
                                                    <a href="#order">
                                                        <svg viewBox="0 0 80 60" preserveAspectRatio="none"><use xlink:href="#tabshape"></use></svg>
                                                        <span class="font-bold lead-14">Easy Order Form</span>
                                                    </a>
                                                </li>
                                                <li class="qt_view" onclick="showOrderQuote('q')" style="margin-right: 48px;">
                                                    <a href="#quote">
                                                        <svg viewBox="0 0 80 60" preserveAspectRatio="none"><use xlink:href="#tabshape"></use></svg>
                                                        <svg viewBox="0 0 80 60" preserveAspectRatio="none"><use xlink:href="#tabshape"></use></svg>
                                                        <span class="font-bold lead-14">Quote Request Form</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div><!-- /tabs -->
                                    </section> 
                                    <div class="panel-body">
                                        <div class="tab-content">
                                            <!-- Tab 1 Order -->
                                            <div class="clearfix order_view">
                                                <!-- <img class="m-b" style="width:100%; height:100%;" src="/assets/images/create-order.png" alt="Before - After (Sample)"> -->
                                                <form id="orderForm" action="" method="post" name="orderForm">
                                                    <!-- Hidden Fields -->
                                                    <input type="hidden" id="order_id" name="order_id" value="<?php echo $order_id; ?>" />
                                                    <input type="hidden" id="o_service" name="o_service" value="cutout" />
                                                    <input type="hidden" name="service_option_cutout" value="cutout" />
                                                    <input type="hidden" name="tat" ng-value="tatVal" ng-init="tatVal = 48" />
                                                    <input type="hidden" name="payment_method" ng-value="payMethod" ng-init="payMethod = 'PayPal'" />
                                                    <input type="hidden" name="payment_option" ng-value="paymentOption.text" />
                                                    <input type="hidden" id="tat_value" name="tat_value" value="">

                                                    <div class="form-group m-t-md">
                                                        <input type="text" name="job_title" class="form-control parsley-validated block" placeholder="Your Job Title" 
                                                               ng-model="order.job_title"
                                                               ng-class="{'parsley-error': orderForm.job_title.$invalid && !orderForm.job_title.$pristine}"
                                                               ng-minlength="6" 
                                                               ng-maxlength="50"
                                                               required
                                                               />
                                                    </div>

                                                    <div class="inline lead-13 text-left font-weight-600 m-b-n m-t-lg"><span class="text-dark">Metadata Info &amp; Flatness</span></div>
                                                    <hr>
                                                    <div class="form-horizontal"></div>
                                                    <div class="inline form-group m-t-n col-sm-12 no-padder">
                                                        <div class="no-padder col-sm-8 cocp">
                                                            <label class="checkbox i-checks">
                                                                <input type="checkbox" name="keep_metadata" ng-model="keep_meta" ng-checked="keep_meta" value="0"><i></i>Keep My Metadata Intact <strong> - </strong><a data-toggle="ajaxModal" href ="<?php echo site_url('ajax/metadata_info'); ?>" class="text-danger font-normal">What's This?</a>
                                                            </label>
                                                            <label class="checkbox i-checks">
                                                                <input type="checkbox" name="flatness_value" ng-model="flatness_value" value="0"><i></i>Clipping Path with Flatness
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-4 b-l m-t-sm cocp">
                                                            <label>Flatness:</label>
                                                            <div class="input-group">
                                                                <input type="number" id="flatness" name="cutout_flatness" class="form-control input-sm" value="0.5" disabled="" />
                                                                <span class="input-group-addon">px</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="inline lead-13 text-left font-weight-600 m-b-n m-t-n"><span class="text-dark">Returned File Format</span></div>
                                                    <hr>
                                                    <div class="form-horizontal"></div>
                                                    <div class="form-group m-t-n m-l-n">
                                                        <div class="col-sm-12 m-b-md rf_format">
                                                            <label class="checkbox-inline i-checks">
                                                                <input type="checkbox" checked="" class="o_rft" name="return_file_type[]" value="JPG" /><i></i>JPG
                                                            </label>
                                                            <label class="checkbox-inline i-checks">
                                                                <input type="checkbox" class="o_rft" name="return_file_type[]" value="PNG" /><i></i>PNG
                                                            </label>
                                                            <label class="checkbox-inline i-checks">
                                                                <input type="checkbox" class="o_rft" name="return_file_type[]" value="PSD" /><i></i> <span class="text-danger" data-toggle="tooltip" data-placement="top" title="Deliverable in PSD format will cost: ${{servicePrice.fileFormat.psd}} / image in addition.">PSD !</span>
                                                            </label>
                                                            <label class="checkbox-inline i-checks">
                                                                <input type="checkbox" class="o_rft" name="return_file_type[]" value="TIFF" /><i></i> <span class="text-danger" data-toggle="tooltip" data-placement="top" title="Deliverable in TIFF format will cost: ${{servicePrice.fileFormat.tiff}} / image in addition">TIFF !</span>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="lead-13 text-left font-weight-600 m-b-n text-dark">Background Options:</div>
                                                    <hr>
                                                    <div class="form-horizontal"></div>
                                                    <div class="form-group m-t-n m-l-n">
                                                        <div class="col-sm-12 m-b-md rf_format" style="min-height: 25px;">
                                                            <label class="radio-inline i-checks">
                                                                <input type="radio" name="cutout_bg_option" value="White BG" checked="" class="white" ng-click="customColor = false"><i></i>White
                                                            </label>
                                                            <label class="radio-inline i-checks">
                                                                <input type="radio" name="cutout_bg_option" value="Original" ng-click="customColor = false"><i></i>Keep Original
                                                            </label>
                                                            <label class="radio-inline i-checks">
                                                                <input type="radio" name="cutout_bg_option" class="transparent" value="Transparent BG" ng-click="customColor = false"><i></i>Transparent
                                                            </label>
                                                            <label class="radio-inline i-checks">
                                                                <input type="radio" name="cutout_bg_option" value="Custom" ng-model="customColor"><i></i>Color
                                                            </label>
                                                            <label class="" ng-show="customColor">
                                                             <!--  <input type="text" name="cutout_bg_color" value="#1CCACC" class="minicolors"> -->
                                                                <div class="custom-color-widget">
                                                                    <div id="cp2" class="input-group colorpicker-component">
                                                                        <input type="text" name="cutout_bg_color" value="#00AABB" class="form-control" style="height:29px;" />
                                                                        <span class="input-group-addon"><i></i></span>
                                                                    </div>
                                                                    <script>
                                                                                $(function () {
                                                                                    $('#cp2').colorpicker();
                                                                                });
                                                                    </script>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="clearfix noheight"></div>
                                                    <div class="lead-13 text-left font-weight-600 m-b-n m-t-md"><span class="text-dark">Price / Image:</span> Choose Image Complexity</div>
                                                    <hr>
                                                    <div class="padder m-t-n m-b-xs">
                                                        <div class="form-horizontal">
                                                            <div id="img_complexity" class="form-group v2">
                                                                <label class="complexity_item" for="ic_option_1" ng-class="{selected: imgCmplx.defaultType === 'basic'}" ng-click="imgCmplx.defaultType = 'basic'">
                                                                    <span id="ar-pop1" data-html="true" data-container="body" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url(); ?>assets/images/pricing/d/1.png' /></div>" rel="popover" data-placement="top" data-original-title="CP - Basic: US $0.50 / Image"> 
                                                                        <img src="<?php echo base_url(); ?>assets/images/pricing/d/1.png" />
                                                                    </span>
                                                                    <div class="cplx_price ">
                                                                        {{servicePrice.complexity.basic| currency:"$":1}}
                                                                    </div>
                                                                    <input type="radio" class="hide" id="ic_option_1" name="image_complexity" data-title="CP Basic" value="{{servicePrice.complexity.basic}}" 
                                                                           ng-model="imgCmplx.defaultValue"/>
                                                                </label>
                                                                <label class="complexity_item" for="ic_option_2" ng-class="{selected: imgCmplx.defaultType === 'regular'}" ng-click="imgCmplx.defaultType = 'regular'">
                                                                    <span id="ar-pop2" data-html="true" data-container="body" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url(); ?>assets/images/pricing/d/2.png' /></div>" rel="popover" data-placement="top" data-original-title="CP - Regular: US $1.00 / Image"> 
                                                                        <img src="<?php echo base_url(); ?>assets/images/pricing/d/2.png" />
                                                                    </span>
                                                                    <div class="cplx_price">
                                                                        {{servicePrice.complexity.regular| currency:"$":1}}
                                                                    </div>
                                                                    <input type="radio" class="hide" id="ic_option_2" name="image_complexity" data-title="CP Regular"
                                                                           value="{{servicePrice.complexity.regular}}" 
                                                                           ng-model="imgCmplx.defaultValue" />
                                                                </label>
                                                                <label class="complexity_item" for="ic_option_3" ng-class="{selected: imgCmplx.defaultType === 'medium'}" ng-click="imgCmplx.defaultType = 'medium'">
                                                                    <span id="ar-pop3" data-html="true" data-container="body" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url(); ?>assets/images/pricing/d/3.png' /></div>" rel="popover" data-placement="top" data-original-title="CP - Medium: US $2.00 / Image"> 
                                                                        <img src="<?php echo base_url(); ?>assets/images/pricing/d/3.png" />
                                                                    </span>
                                                                    <div class="cplx_price">
                                                                        {{servicePrice.complexity.medium| currency:"$":1}}
                                                                    </div>
                                                                    <input type="radio" class="hide" id="ic_option_3" name="image_complexity" data-title="CP Medium"
                                                                           value="{{servicePrice.complexity.medium}}" 
                                                                           ng-model="imgCmplx.defaultValue"/>
                                                                </label>
                                                                <label class="complexity_item" for="ic_option_4" ng-class="{selected: imgCmplx.defaultType === 'advance'}" ng-click="imgCmplx.defaultType = 'advance'">
                                                                    <span id="ar-pop4" data-html="true" data-container="body" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url(); ?>assets/images/pricing/d/4.png' /></div>" rel="popover" data-placement="top" data-original-title="CP - Advance: US $3.50 / Image"> 
                                                                        <img src="<?php echo base_url(); ?>assets/images/pricing/d/4.png" />
                                                                    </span>
                                                                    <div class="cplx_price">
                                                                        {{servicePrice.complexity.advance| currency:"$":1}}
                                                                    </div>
                                                                    <input type="radio" class="hide" id="ic_option_4" name="image_complexity" data-title="CP Advance"
                                                                           value="{{servicePrice.complexity.advance}}" 
                                                                           ng-model="imgCmplx.defaultValue"/>
                                                                </label>
                                                                <label class="complexity_item" for="ic_option_5" ng-class="{selected: imgCmplx.defaultType === 'complex'}" ng-click="imgCmplx.defaultType = 'complex'">
                                                                    <span id="ar-pop5" data-html="true" data-container="body" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url(); ?>assets/images/pricing/d/5.png' /></div>" rel="popover" data-placement="top" data-original-title="CP - Complex: US $7.00 / Image"> 
                                                                        <img src="<?php echo base_url(); ?>assets/images/pricing/d/5.png" />
                                                                    </span>
                                                                    <div class="cplx_price">
                                                                        {{servicePrice.complexity.complex| currency:"$":1}}
                                                                    </div>
                                                                    <input type="radio" class="hide" id="ic_option_5" name="image_complexity" data-title="CP Complex"
                                                                           value="{{servicePrice.complexity.complex}}" 
                                                                           ng-model="imgCmplx.defaultValue"/>
                                                                </label>
                                                                <div class="complexity_option_mask hide"></div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 m-b-xl m-t-n no-padder" style="min-height: 25px;">
                                                        <div class="lead-13 text-center m-b-n m-t-md b-b b-t b-light b-dashed"><span class="text-dark">Not Sure of Complexity?</span> <i class="fa fa-long-arrow-right"></i> <a href="#quote" onclick="showOrderQuote('q')"class="font-bold">Ask For Quote</a></div>
                                                    </div>
                                                    <!-- Instruction Message -->
                                                    <div class="form-group m-t-xl">
                                                        <textarea name="job_desc" class="form-control input-sm block" rows="3" placeholder="Your Message (Further instructions if any...)"
                                                                  ng-model="order.job_desc"
                                                                  ng-class="{'parsley-error': orderForm.job_desc.$invalid && !orderForm.job_desc.$pristine}"
                                                                  ng-minlength="1" 
                                                                  required
                                                                  ></textarea>
                                                    </div>

                                                    <!-- Addons devider -->
                                                    <div class="or_devider addons m-t-lg m-b-lg"><span class="font-bold p-sm">ADD-ONS</span></div>

                                                    <!-- Shadow Adding -->
                                                    <section class="panel panel-default" ng-controller="shadowAdding">
                                                        <header class="panel-heading">
                                                            <div style="position:relative;">
                                                                <i class="fa-ar-wd fa fa-2x fa-cube"></i> <span style="position:relative; top:-3px;" class="lead-15">Shadow Adding</span>
                                                                <label class="switch" style="position:absolute; right: 0px; top: -1px;">
                                                                    <input type="checkbox" name="shadow_option_value" value="0" ng-model="shadowOn" ng-change="resetShadow()" ng-value="shadowValue">
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </header>
                                                        <div class="panel-body" ng-show="shadowOn">
                                                            <div class="col-sm-6 no-padder">
                                                                <p class="m-r-md ar-text-justify">Please see the examples and select your preferred <strong>Shadow Option</strong>.</p>
                                                                <div class="radio i-checks"><label><input ng-click="showImage($event); shadowValue = 0.25" data-img="1.jpg" type="radio" name="shadow_option" value="Drop Shadow: ($0.25)"><i></i>Drop Shadow - <span class="text-info">$0.25</span></label></div>
                                                                <div class="radio i-checks"><label><input ng-click="showImage($event); shadowValue = 0.5" data-img="2.jpg" type="radio" name="shadow_option" value="Natural Shadow: ($0.50)"><i></i>Natural Shadow - <span class="text-info">$0.50</span></label></div>
                                                                <div class="radio i-checks"><label><input ng-click="showImage($event); shadowValue = 0.5" data-img="3.jpg" type="radio" name="shadow_option" value="Reflection Shadow: ($0.50)"><i></i>Reflection Shadow - <span class="text-info">$0.50</span></label></div>
                                                                <div class="radio i-checks"><label><input ng-click="showImage($event); shadowValue = 0.75" data-img="4.jpg" type="radio" name="shadow_option" value="Mirror Effect: ($0.75)"><i></i>Mirror Effect - <span class="text-info">$0.75</span></label></div>
                                                                <div class="radio i-checks"><label><input ng-click="showImage($event); shadowValue = 0" data-img="" type="radio" name="shadow_option" value=""><i></i>None</label></div>
                                                            </div>
                                                            <div class="col-sm-6 no-padder">
                                                                <div class="thumbnail"> 
                                                                    <img src="{{imgUrl}}" alt="{{shadowName}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>


                                                    <!-- Fix Imperfection -->        
                                                    <section class="panel panel-default">
                                                        <header class="panel-heading">
                                                            <div style="position:relative;">
                                                                <label class="switch" style="position:absolute; right: 0px; top: -1px;">
                                                                    <input type="checkbox" ng-model="fixImpOn" ng-click="fixImpOpt()">
                                                                    <span></span>
                                                                </label> 
                                                                <i class="fa-ar-wd fa fa-2x fa-magic"></i> <span style="position:relative; top:-3px;" class="lead-15">Fix Imperfection</span>
                                                            </div>
                                                        </header>
                                                        <div class="panel-body" ng-show="fixImpOn">
                                                            <div class="col-sm-12 no-padder">
                                                                <p class="ar-text-justify">Through this section we offer basic error correction and dust clean up service like removing acne. If you are not sure of the imperfections' complexity, please ask for <strong>[<a  class="font-bold" href="#quote" onclick="showOrderQuote('q')">Quote Here</a>]</strong>.</p>

                                                                <p class="ar-text-justify m-b-md"><strong class="text-danger">Please Note:</strong> We may REJECT the order if our review goes to higher complexity.</p>

                                                                <label class="checkbox i-checks">
                                                                    <input type="checkbox" name="brightness_value" ng-model="fix_basic" ng-checked="fix_basic" value="0.50"><i></i>Fix Imperfection (Basic) - <span class="text-info">$0.50</span>
                                                                </label>
                                                                <label class="checkbox i-checks">
                                                                    <input type="checkbox" name="staight_value" ng-model="fix_variation" value="0.25" data-title="Straighten &amp; Symmetric"><i></i>Straighten &amp; Symmetric - <span class="text-info">$0.25</span>
                                                                </label>
                                                                <div class="m-b-n wrapper">
                                                                    <textarea name="fix_imperfection_desc" class="form-control input-sm block" rows="3" data-minwords="6" placeholder="Please write down your instructions and mention the imperfection that needs to be fixed"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>

                                                    <!-- Invisible Mannequin / Ghost 3D -->
                                                    <section class="panel panel-default">
                                                        <header class="panel-heading">
                                                            <div style="position:relative;">
                                                                <label class="switch" style="position:absolute; right: 0px; top: -1px;">
                                                                    <input type="checkbox" name="mannequin_option_value" value="0.75" ng-model="mannequinOn" />
                                                                    <span></span>
                                                                </label> 
                                                                <i class="fa-ar-wd fa fa-2x fa-female"></i> <span style="position:relative; top:-3px;" class="lead-15">3D / Mannequin Remove</span>
                                                            </div>
                                                        </header>
                                                        <div class="panel-body" ng-show="mannequinOn">
                                                            <div class="col-sm-12 no-padder">
                                                                <p class="ar-text-justify">Manipulating product images worn on a mannequin or dummy enhances the looks of the products. <strong>Photo Manipulation, Invisible Mannequin</strong> or <strong>3D Product Image Modeling</strong> are very similar things as a service.</p>
                                                                <label class="radio-inline i-checks"><input type="radio" name="mannequin_option" value="3D - Invisible ($0.75)" ng-checked="mannequinOn"><i></i>3D Ghost / Invisible Mannequin - <span class="text-info">$0.75</span></label>
                                                                <label class="radio-inline i-checks"><input type="radio" name="mannequin_option" ng-click="mannequinOn = false" value="none" ng-checked="!mannequinOn"><i></i>None</label>
                                                                <hr>
                                                            </div>
                                                            <div class="col-sm-12 no-padder">
                                                                <div class="thumbnail"> 
                                                                    <img src="/assets/images/manipulation.jpg" alt="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>

                                                    <!-- Photo Retouching -->        
                                                    <section class="panel panel-default">
                                                        <header class="panel-heading">
                                                            <div style="position:relative;">
                                                                <label class="switch" style="position:absolute; right: 0px; top: -1px;">
                                                                    <input type="checkbox" ng-model="RetouchOn" ng-click="RetouchOpt()">
                                                                    <span></span>
                                                                </label> 
                                                                <i class="fa-ar-wd fa fa-2x fa-eye"></i> <span style="position:relative; top:-3px;" class="lead-15">Photo Retouching</span>
                                                            </div>
                                                        </header>
                                                        <div class="panel-body" ng-show="RetouchOn">
                                                            <div class="col-sm-12 no-padder">
                                                                <p class="ar-text-justify">For <strong>Photo Touchup</strong> we strongly recommend you to <strong>[<a  class="font-bold" href="#quote" onclick="showOrderQuote('q')">Ask for Quote Here</a>]</strong> unless you know the work is of a basic complexity of Retouching as its difficult to define the complexity.</p>

                                                                <p class="ar-text-justify m-b-md"><strong class="text-danger">Please Note:</strong> We may REJECT the order if our review goes to higher complexity.</p>

                                                                <label class="checkbox i-checks">
                                                                    <input type="checkbox" name="retbasic_value" ng-model="retouch_basic" ng-checked="retouch_basic" value="1.00"><i></i>Basic Photo Retouching - <span class="text-info">$1.00</span>
                                                                </label>
                                                                <label class="checkbox i-checks">
                                                                    <input type="checkbox" disabled="" name="rethigh_value" ng-model="retouch_high" value="7.00" data-title="Photo Retouching"><i></i>High-End Photo Retouching - <span class="text-info">$2.00 - $30.00</span> <span><a  class="text-danger font-bold" href="#quote" onclick="showOrderQuote('q')">[Ask for Quote]</a></span>
                                                                </label>
                                                                <div class="m-b-n wrapper">
                                                                    <textarea name="retouch_desc" class="form-control input-sm block" rows="3" data-minwords="6" placeholder="Please write down your instructions and mention what you want us to retouch on the photos"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                    <!-- Cropping & Resizing -->
                                                    <section class="panel panel-default">
                                                        <header class="panel-heading">
                                                            <div style="position:relative;">
                                                                <label class="switch" style="position:absolute; right: 0px; top: -1px;">
                                                                    <input type="checkbox" ng-model="resizingOn">
                                                                    <span></span>
                                                                </label> 
                                                                <i class="fa-ar-wd fa fa-2x fa-crop"></i> <span style="position:relative; top:-3px;" class="lead-15">Cropping &amp; Resizing</span>
                                                            </div>
                                                        </header>
                                                        <div class="panel-body" ng-show="resizingOn">
                                                            <div class="col-sm-12 text-left no-padder">
                                                                <p class="ar-text-justify">You will need to write down the resizing and cropping note in the below box. Letting us know the exact <em class="font-bold">Height, Width, Margin, Padding, Horizontal Alignment &amp; Vertical Alignment</em> would help us to give you the best result in return.</p>

                                                                <label class="radio i-checks">
                                                                    <input type="radio" name="crop_resize" value="Variation (Upto 1)" ng-checked="resizingOn"><i></i>Variation (Upto 1): <span class="text-info">Free</span>
                                                                </label>
                                                                <label class="radio i-checks">
                                                                    <input type="radio" name="crop_resize" value="Variation (Upto 3)"><i></i>Variation (Upto 3): <span class="text-info">$0.25</span>
                                                                </label>
                                                                <label class="radio i-checks">
                                                                    <input type="radio" name="crop_resize" value="" ng-click="resizingOn = false"><i></i> None
                                                                </label>
                                                                <div class="m-b-n wrapper">
                                                                    <textarea name="crop_resize_desc" class="form-control input-sm block" rows="3" data-minwords="6" placeholder="Please write down your cropping &amp; resizing details here"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>

                                                    <!-- Color Corrections -->
                                                    <section class="panel panel-default">
                                                        <header class="panel-heading">
                                                            <div style="position:relative;">
                                                                <label class="switch" style="position:absolute; right: 0px; top: -1px;">
                                                                    <input type="checkbox" ng-model="colorOn">
                                                                    <span></span>
                                                                </label>  
                                                                <i class="fa-ar-wd fa fa-2x fa-adjust"></i> <span style="position:relative; top:-3px;" class="lead-15">Color Corrections</span>
                                                            </div>
                                                        </header>
                                                        <div class="panel-body" ng-show="colorOn">
                                                            <div class="col-sm-12 text-left no-padder m-b-md">
                                                                <label class="radio-inline i-checks">
                                                                    <input type="radio" name="color_fix" value="Basic Adjustment" ng-checked="colorOn"><i></i>Basic Color Adjustment: <span class="text-info">$0.50</span>
                                                                </label>
                                                                <label class="radio-inline i-checks">
                                                                    <input type="radio" name="color_fix" value="None" ng-click="colorOn = false" ng-checked="!ColorOn"><i></i> None
                                                                </label>
                                                            </div>
                                                            <div class="m-b-n wrapper">
                                                                <textarea name="color_fix_desc" class="form-control input-sm block" 
                                                                          ng-model="color_fix_desc"
                                                                          rows="3"
                                                                          ng-class="{'parsley-error': orderForm.color_fix_desc.$invalid && !orderForm.color_fix_desc.$pristine}"
                                                                          ng-minlength="6" 
                                                                          ng-maxlength="50"
                                                                          required
                                                                          placeholder="Please write down your instructions here">

                                                                </textarea>
                                                            </div>
                                                        </div>
                                                    </section>
                                                </form>
                                            </div>

                                            <!-- Tab 2 Quote -->
                                            <div class="clearfix quote_view hide">
                                                <div class="m-b b b-base">
                                                    <img style="max-width:19%; display:inline;" src="/assets/images/pricing/d/1.png" alt="">
                                                    <img style="max-width:19%; display:inline;" src="/assets/images/pricing/d/2.png" alt="">
                                                    <img style="max-width:19%; display:inline;" src="/assets/images/pricing/d/3.png" alt="">
                                                    <img style="max-width:19%; display:inline;" src="/assets/images/pricing/d/4.png" alt="">
                                                    <img style="max-width:19%; display:inline;" src="/assets/images/pricing/d/5.png" alt="">
                                                </div>
                                                <form id="quoteForm" action="" method="post" name="quoteForm" novalidate>
                                                    <input type="hidden" name="order_id" value="<?php echo $order_id; ?>" />
                                                    <input type="hidden" name="o_service" value="cutout" />
                                                    <input type="hidden" name="service_option_cutout" value="cutout" />
                                                    <input type="hidden" name="tat" value="0" />


                                                    <div class="lead-13 text-left font-weight-600 m-b-n text-dark">Service Type / Required Services</div>
                                                    <hr>
                                                    <div class="m-t-n clearfix" id="quote_services">

                                                        <div class="col-sm-6 text-left no-padder smo_mro">
                                                            <div class="form-group">
                                                                <label class="checkbox i-checks">
                                                                    <input name="service_types[]" class="s_type" value="Cut Out" type="checkbox" ng-click="qServiceSelection($event)"><i></i>
                                                                    Photo Cut Out <span class="hoverPopover" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url(); ?>assets/images/pricing/shadow/1.jpg' /></div>" rel="popover" data-placement="right" data-original-title="Cut Out"><span class="fa fa-question-circle text-info"></span></span>
                                                                </label>
                                                                <label class="checkbox i-checks">
                                                                    <input name="service_types[]" class="s_type" value="Clipping Path" type="checkbox" ng-click="qServiceSelection($event)"><i></i>
                                                                    Clipping Path <span class="hoverPopover" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url(); ?>assets/images/pricing/shadow/1.jpg' /></div>" rel="popover" data-placement="right" data-original-title="Clipping Path"><span class="fa fa-question-circle text-info"></span></span>
                                                                </label>
                                                                <label class="checkbox i-checks">
                                                                    <input name="service_types[]" class="s_type" value="Background Removal" type="checkbox" ng-click="qServiceSelection($event)"><i></i>
                                                                    Background Removal <span class="hoverPopover" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url(); ?>assets/images/pricing/shadow/1.jpg' /></div>" rel="popover" data-placement="right" data-original-title="Background Removal"><span class="fa fa-question-circle text-info"></span></span>
                                                                </label>
                                                                <label class="checkbox i-checks">
                                                                    <input name="service_types[]" class="s_type" value="Drop Shadow" type="checkbox" ng-click="qServiceSelection($event)"><i></i>
                                                                    Drop Shadow <span class="hoverPopover" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url(); ?>assets/images/pricing/shadow/1.jpg' /></div>" rel="popover" data-placement="right" data-original-title="Drop Shadow"><span class="fa fa-question-circle text-info"></span></span>
                                                                </label>
                                                                <label class="checkbox i-checks">
                                                                    <input name="service_types[]" class="s_type" value="Natural Shadow" type="checkbox" ng-click="qServiceSelection($event)"><i></i>
                                                                    Natural Shadow <span class="hoverPopover" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url(); ?>assets/images/pricing/shadow/1.jpg' /></div>" rel="popover" data-placement="right" data-original-title="Natural Shadow"><span class="fa fa-question-circle text-info"></span></span>
                                                                </label>
                                                                <label class="checkbox i-checks">
                                                                    <input name="service_types[]" class="s_type" value="Reflection Shadow" type="checkbox" ng-click="qServiceSelection($event)"><i></i>
                                                                    Reflection Shadow <span class="hoverPopover" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url(); ?>assets/images/pricing/shadow/1.jpg' /></div>" rel="popover" data-placement="right" data-original-title="Reflection Shadow"><span class="fa fa-question-circle text-info"></span></span>
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6 text-left no-padder smo_mro">
                                                            <div class="form-group">
                                                                <label class="checkbox i-checks">
                                                                    <input name="service_types[]" class="s_type" value="Mirror Effect" type="checkbox" ng-click="qServiceSelection($event)"><i></i>
                                                                    Mirror Effect <span class="hoverPopover" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url(); ?>assets/images/pricing/shadow/1.jpg' /></div>" rel="popover" data-placement="right" data-original-title="Mirror Effect"><span class="fa fa-question-circle text-info"></span></span>
                                                                </label>
                                                                <label class="checkbox i-checks">
                                                                    <input name="service_types[]" class="s_type" value="Photo Retouching" type="checkbox" ng-click="qServiceSelection($event)"><i></i>
                                                                    Photo Retouching <span class="hoverPopover" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url(); ?>assets/images/pricing/shadow/1.jpg' /></div>" rel="popover" data-placement="right" data-original-title="Photo Retouching"><span class="fa fa-question-circle text-info"></span></span>
                                                                </label>
                                                                <label class="checkbox i-checks">
                                                                    <input name="service_types[]" class="s_type" value="Mannequin Removal" type="checkbox" ng-click="qServiceSelection($event)"><i></i>
                                                                    Mannequin Removal <span class="hoverPopover" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url(); ?>assets/images/pricing/shadow/1.jpg' /></div>" rel="popover" data-placement="right" data-original-title="Mannequin Removal"><span class="fa fa-question-circle text-info"></span></span>
                                                                </label>
                                                                <label class="checkbox i-checks">
                                                                    <input name="service_types[]" class="s_type" value="Crop-Resizing" type="checkbox" ng-click="qServiceSelection($event)"><i></i>
                                                                    Crop-Resizing <span class="hoverPopover" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url(); ?>assets/images/pricing/shadow/1.jpg' /></div>" rel="popover" data-placement="right" data-original-title="Crop-Resizing"><span class="fa fa-question-circle text-info"></span></span>
                                                                </label>
                                                                <label class="checkbox i-checks">
                                                                    <input name="service_types[]" class="s_type" value="E-Commerce Optimization" type="checkbox" ng-click="qServiceSelection($event)"><i></i>
                                                                    E-Commerce Optimization <span class="hoverPopover" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url(); ?>assets/images/pricing/shadow/1.jpg' /></div>" rel="popover" data-placement="right" data-original-title="E-Commerce Optimization"><span class="fa fa-question-circle text-info"></span></span>
                                                                </label>
                                                                <label class="checkbox i-checks">
                                                                    <input name="service_types[]" class="s_type" value="I'm Not Certain" type="checkbox" ng-click="qServiceSelection($event)"><i></i>
                                                                    I'm Not Certain <span class="hoverPopover" data-html="true" data-container="body" class="text-info" data-content="<div style='border:1px solid #20c198; border-radius:3px;'><img width='240' height='240' src='<?php echo base_url(); ?>assets/images/pricing/shadow/1.jpg' /></div>" rel="popover" data-placement="right" data-original-title="I'm Not Certain"><span class="fa fa-question-circle text-info"></span></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="lead-13 text-left font-weight-600 m-b-n text-dark">Retouching Photos</div>
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
                                                                <input type="radio" name="retouching_opt" value="Highend Retouching" ng-click="qRetouching = 'Highend Retouching'"><i></i>High-End Retouching
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="lead-13 text-left font-weight-600 m-b-n text-dark">Image Masking</div>
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
                                                    <div class="lead-13 text-left font-weight-600 m-b-n text-dark">File Format</div>
                                                    <hr>
                                                    <div class="form-horizontal"></div>
                                                    <div class="form-group m-t-n m-l-n">
                                                        <div class="col-sm-12 m-b-lg rf_format">
                                                            <label class="checkbox-inline i-checks">
                                                                <input type="checkbox" id="rt_jpg" class="rtf_opt" name="return_file_type[]" value="JPG" ng-click="qReturnFileTypeSelection($event)"><i></i>JPG
                                                            </label>
                                                            <label class="checkbox-inline i-checks">
                                                                <input type="checkbox" id="rt_png" class="rtf_opt" name="return_file_type[]" value="PNG" ng-click="qReturnFileTypeSelection($event)"><i></i>PNG
                                                            </label>
                                                            <label class="checkbox-inline i-checks">
                                                                <input type="checkbox" id="rt_psd" class="rtf_opt" name="return_file_type[]" value="PSD" ng-click="qReturnFileTypeSelection($event)"><i></i> <span class="text-danger" data-toggle="tooltip" data-placement="top" title="Requesting PSD File will cost: $0.10 / Image in addition.">PSD!</span>
                                                            </label>
                                                            <label class="checkbox-inline i-checks">
                                                                <input type="checkbox" id="rt_tiff" class="rtf_opt" name="return_file_type[]" value="TIFF" ng-click="qReturnFileTypeSelection($event)"><i></i> <span class="text-danger" data-toggle="tooltip" data-placement="top" title="Requesting TIFF File will cost: $0.10 / Image in addition.">TIFF!</span>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="lead-13 text-left font-weight-600 m-b-n text-dark">Background Options</div>
                                                    <hr>
                                                    <div class="form-horizontal"></div>
                                                    <div class="form-group m-t-n m-l-n">
                                                        <div class="col-sm-12 m-b-lg rf_format">
                                                            <label class="radio-inline i-checks">
                                                                <input type="radio"  id="rt_white" name="cutout_bg_option" value="White BG" ng-click="bgOpt = 'White BG'" ng-init="bgOpt = 'White BG'" checked=""><i></i>White
                                                            </label>
                                                            <label class="radio-inline i-checks">
                                                                <input type="radio" id="rt_transparent" name="cutout_bg_option" value="Transparent" ng-click="bgOpt = 'Transparent BG'"><i></i>Transparent
                                                            </label>
                                                            <label class="radio-inline i-checks">
                                                                <input type="radio" id="rt_original" name="cutout_bg_option" value="Original" ng-click="bgOpt = 'Original'"><i></i>Original
                                                            </label>
                                                            <label class="radio-inline i-checks">
                                                                <input type="radio" id="rt_custom" name="cutout_bg_option" value="Custom" ng-click="bgOpt = 'Custom'"><i></i>Custom
                                                            </label>
                                                            <label class="" ng-show="bgOpt == 'Custom'">
                                                                <!-- <input type="text" name="cutout_bg_color" value="#1CCACC" class="minicolors"> -->
                                                                <div class="example-content-widget">
                                                                    <div id="cp3" class="input-group colorpicker-component">
                                                                        <input type="text" name="cutout_bg_color" value="#00AABB" class="form-control" style="height: 33px;" />
                                                                        <span class="input-group-addon"><i></i></span>
                                                                    </div>
                                                                    <script>
                                                                                $(function () {
                                                                                    $('#cp3').colorpicker();
                                                                                });
                                                                    </script>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="lead-13 text-left font-weight-600 m-b-n text-dark">Detailed Requirements</div>
                                                    <hr>
                                                    <div class="form-horizontal"></div>
                                                    <div class="form-group">
                                                        <div class="m-b-md">
                                                            <textarea name="job_desc" class="form-control input-sm block" rows="3" placeholder="Please write down your requirements in details here" required
                                                                      ng-model="quote.job_desc" 
                                                                      ng-minlength="1"
                                                                      ng-class="{'parsley-error' : quoteForm.job_desc.$invalid && !quoteForm.job_desc.$pristine}"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" name="job_title" class="form-control parsley-validated block" required placeholder="Your Quotation Title" 
                                                               ng-model="quote.job_title" 
                                                               ng-minlength="6" 
                                                               ng-maxlength="50"
                                                               ng-class="{'parsley-error' : quoteForm.job_title.$invalid && !quoteForm.job_title.$pristine}" />
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- End quote panel -->
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>

                        <div class="col-lg-4 no-padder m-n">
                            <div class="wrapper" id="sidebar">
                                <!-- .breadcrumb -->
                                <ul class="breadcrumb" style="min-width:230px;">
                                    <li><i class="fa fa-dollar m-r-xm"></i> Summary &amp; Payment</li>
                                </ul>
                                <!-- / .breadcrumb -->

                                <!-- Order Summery -->
                                <section id="order_summery" class="panel panel-default order_view" style="min-width:230px;">
                                    <form id="sitebar_data" action="" method="POST">
                                        <div class="wrapper">
                                            <div class="form-horizontal">
                                                <div class="form-group m-b-none">
                                                    <div class="col-sm-12 m-b-none">
                                                        <div class="lead-13 text-left font-bold m-b-n"><span class="text-black">Turnaround Times</span></div>
                                                        <hr>
                                                        <div class="m-t-n">
                                                            <div class="row">
                                                                <div class="col-xs-6">
                                                                    <label class="radio i-checks">
                                                                        <input id="tat_24" name="tat" value="24" type="radio" ng-model="tatVal"/><i></i>24H <a data-toggle="ajaxModal" href ="<?php echo site_url('ajax/tat_extra'); ?>"><span class="text-xs-ar text-danger font-bold" data-toggle="tooltip" data-placement="right" title="Details">(+15%)</span></a>
                                                                    </label>
                                                                </div>
                                                                <div class="col-xs-6">
                                                                    <label class="radio i-checks" data-toggle="tooltip" data-placement="left" title="Standard TAT">
                                                                        <input id="tat_48" name="tat" value="48" type="radio" ng-model="tatVal" /><i></i>48 Hours
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-xs-6">
                                                                    <label class="radio i-checks">
                                                                        <input id="tat_72" name="tat" value="72" type="radio" ng-model="tatVal"/><i></i>72H <a data-toggle="ajaxModal" href ="<?php echo site_url('ajax/tat_discount'); ?>"><span class="text-xs-ar text-danger font-bold" data-toggle="tooltip" data-placement="right" title="Details">(-15%)</span></a>
                                                                    </label>
                                                                </div>
                                                                <div class="col-xs-6">
                                                                    <label class="radio i-checks" data-toggle="tooltip" data-placement="left" title="Flex. 6H-72H">
                                                                        <input id="tat_0" name="tat" value="0" type="radio" ng-model="tatVal"/><i></i>Flexible
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="lead-13 text-left font-bold m-t-md m-b-n"><span class="text-black">Cost Calculation</span></div>
                                                        <hr>
                                                        <div id="costing_box" class="m-t-n">
                                                            <!-- Calc info push here -->
                                                        </div>
                                                        <div class="clearfix both"></div>
                                                        <div class="lead-13 text-left font-bold m-b-n m-t"><span class="text-black">Payment Terms</span></div>
                                                        <hr>
                                                        <div class="m-t-n">
                                                            <label class="radio i-checks">
                                                                <input ng-model="paymentOption.text" ng-click="hide_payment = false" name="payment_option" value="Pay Now" type="radio"><i></i>Pay Now
                                                            </label>
                                                            <label class="radio i-checks">
                                                                <input ng-model="paymentOption.text" ng-click="hide_payment = true" name="payment_option" value="Place Order" type="radio"><i></i>Pay Later <a data-toggle="ajaxModal" href ="<?php echo site_url('ajax/pay_later'); ?>">(<span class="text-info dker" data-toggle="tooltip" data-placement="top" data-title="Option For Regular Customers">Weekly</span>)</a>
                                                            </label>
                                                            <label class="radio i-checks">
                                                                <input ng-model="paymentOption.text" ng-click="hide_payment = true" name="payment_option" value="Use Credit" type="radio"><i></i>Use Credit (<span class="text-info dker" data-toggle="tooltip" data-placement="top" data-title="Use Credit on Account">$124.50</span>)
                                                            </label>
                                                        </div>
                                                        <div class="clearfix noheight"></div>
                                                        <div id="payment_method" ng-hide="hide_payment">
                                                            <div class="lead-13 text-left font-bold m-b-n m-t-md"><span class="text-black">Payment Methods</span></div>
                                                            <hr class="m-b-none">
                                                            <div class="row">
                                                                <div class="col-xs-5 m-l-n p-r-none">
                                                                    <label class="radio i-checks">
                                                                        <input id="paypal" name="payment_method" value="PayPal" type="radio" ng-model="payMethod"><i></i><img class="img-responsive inline" src="<?php echo base_url(); ?>assets/images/paypal-3.png" alt="PayPal" />
                                                                    </label>
                                                                </div>
                                                                <div class="col-xs-7 m-l-n p-r-none">
                                                                    <label class="radio i-checks">
                                                                        <input id="2checkout" name="payment_method" value="2Checkout" type="radio" ng-model="payMethod"><i></i><img class="img-responsive inline" src="<?php echo base_url(); ?>assets/images/2co-3.png" alt="2CheckOut"/>
                                                                    </label>
                                                                </div>
                                                                <!-- 
                                                                <div class="col-xs-6 m-l-n m-r p-r-none">
                                                                    <label class="radio i-checks">
                                                                        <input id="stripe" name="payment_method" value="Stripe" type="radio" ng-model="payMethod"><i></i><img style="height: 20px;" class="img-responsive inline" src="<?php echo base_url(); ?>assets/images/stripe.png" alt="Stripe"/>
                                                                    </label>
                                                                </div>
                                                                <div class="col-xs-6 m-r p-r-none">
                                                                    <label class="radio i-checks">
                                                                        <input id="payza" name="payment_method" value="Payza" type="radio" ng-model="payMethod"><i></i><img src="<?php echo base_url(); ?>assets/images/payza.png" alt="Payza" />
                                                                    </label>
                                                                </div> 
                                                                -->
                                                                <div class="col-xs-12 m-t-sm">
                                                                    <img class="img-responsive b r" src="<?php echo base_url(); ?>assets/images/cards.png" alt=""/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="m-t">
                                                            <button type="button" id="btn_order_submit" class="btn btn-block"
                                                                    ng-class="{'btn-info' : orderForm.$valid, 'btn-default' : orderForm.$invalid}" 
                                                                    ng-disabled="orderForm.$invalid"
                                                                    onclick="jQuery('#orderForm').submit()">{{paymentOption.text}}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </section>

                                <!-- Quote information -->
                                <section class="panel panel-default quote_view hide" style="min-width:220px;">
                                    <div class="wrapper">
                                        <div class="form-horizontal">
                                            <div class="form-group m-b-none">
                                                <div class="col-sm-12 m-b-none">

                                                    <div class="lead-14 text-left font-bold m-b-n"><span class="text-black">Quotation Details</span></div>
                                                    <hr>
                                                    <div id="quote_criteria">
                                                        <div ng-show="qServices.length">
                                                            <div class="lead-13 text-left font-bold m-t-sm"><span class="text-black">Service Type / Required Services</span></div>
                                                            <div class="hbox b-b b-light m-b-sm p-b-xs">
                                                                <label class="label bg-info text-white-ar m-r-xs m-b-n inline" ng-repeat="qs in qServices">{{qs}}</label>
                                                            </div>
                                                        </div>
                                                        <div ng-show="qRetouching">
                                                            <div class="lead-13 text-left font-bold m-t-sm"><span class="text-black">Retouching Photos</span></div>
                                                            <div class="hbox b-b b-light m-b-sm p-b-xs">
                                                                <label class="label bg-info text-white-ar m-r-xs m-b-n inline">{{qRetouching}}</label>
                                                            </div>
                                                        </div>
                                                        <div ng-show="qMasking">
                                                            <div class="lead-13 text-left font-bold m-t-sm"><span class="text-black">Image Masking</span></div>
                                                            <div class="hbox b-b b-light m-b-sm p-b-xs">
                                                                <label class="label bg-info text-white-ar m-r-xs m-b-n inline">{{qMasking}}</label>
                                                            </div>
                                                        </div>
                                                        <div ng-show="qReturnFileType.length">
                                                            <div class="lead-13 text-left font-bold m-t-sm"><span class="text-black">Return File Type</span></div>
                                                            <div class="hbox b-b b-light m-b-sm p-b-xs">
                                                                <label class="label bg-info text-white-ar m-r-xs m-b-n inline" ng-repeat="rft in qReturnFileType">{{rft}}</label>
                                                            </div>
                                                        </div>
                                                        <div ng-show="bgOpt">
                                                            <div class="lead-13 text-left font-bold m-t-sm"><span class="text-black">Background Option</span></div>
                                                            <div class="hbox b-b b-light m-b-sm p-b-xs">
                                                                <label class="label bg-info text-white-ar m-r-xs m-b-n inline">{{bgOpt}}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="m-t">
                                                        <button type="button" id="btn_quote_submit" class="btn btn-block"
                                                                ng-class="{'btn-info' : quoteForm.$valid, 'btn-default' : quoteForm.$invalid}" 
                                                                ng-disabled="quoteForm.$invalid"
                                                                onclick="jQuery('#quoteForm').submit()">Quote Request</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                        <input type="hidden" id="total_progress" name="total_progress" value="0">
                        <input type="hidden" id="qty" name="qty" ng-value="qty" value="0">
                        <input type="hidden" id="shadow_option_value" name="shadow_option_value" value="0"/>
                    </section>
                </section>
            </aside>

        </section>
    </section>
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>

<script type="application/javascript">
    $('document').ready(function(){
    var d = new Date();
    var n = d.getTime();
    var folder = 'F-UID-'+<?php echo $this->user_id; ?>+'-TI-'+n+'/${filename}';
    $('#keyInput').val(folder);
    })
    var totaluploadprogress = 0;
    $(document).ready(function(){

    // Portal.PageInit.PlaceOrder();
    // Portal.Helpers.handlePlaceoderSidebarStyle();
    Portal.Order.addNew.CostCalcNew();


    $(document).on('click', function(event) {
    Portal.Helpers.handlePlaceoderSidebarStyle();
    });

    $("#orderForm").on("change", "input", function(event){
    Portal.Order.addNew.CostCalcNew();
    $("#tat_value").val(1);
    uploade_change();
    });
    $("#sitebar_data").on("change", "input", function(event){
    Portal.Order.addNew.CostCalcNew();
    });

    /*
    * Submit new order form.
    */
    $("#orderForm").on("submit", function(event){
    event.preventDefault();

    var postData = $("#orderForm").serializeArray();
    var quantity = $('#qty').val();
    var aws_alias = $('#keyInput').val();
    postData.push({name: 'quantity', value: quantity});
    postData.push({name: 'aws_alias', value: aws_alias});
    console.log(postData); 
    Portal.Order.addNew.CostCalc();

    if(Portal.Order.addNew.ValidationNew()){
    Portal.wait();
    $.ajax({
    url: ajax_url + "/place_order",
    data: postData,
    type: 'POST',
    dataType: 'JSON',
    success: function (data) {
    if(data.status == "OK"){
    if(data.job_type == 'order'){
    if(data.payment_option == 'paynow'){
    if(data.payment_method == 'paypal'){
    Portal.alert({text: "Please wait. You are redirecting to payment page..", type: "success"});
    window.location.href = site_url + 'paypal_payment/' + data.order_id;
    }
    else if (data.payment_method == '2Checkout') {
    Portal.alert({text: "Please wait. You are redirecting to payment page..", type: "success"});
    window.location.href = site_url + 'Checkout2_payment/' + data.order_id;
    }
    else{
    Portal.alert({text: "Please wait. You are redirecting to payment page..", type: "success"});
    window.location.href = site_url + 'payza_payment/' + data.order_id;
    }
    }
    else{
    window.location.href = site_url + 'orders/';
    }
    }
    else{
    window.location.href = site_url + 'quotations/';
    }
    }
    else{
    Portal.removeWait();
    if(data.refresh == true){
    Portal.alert({text: data.msg, type: "danger", refresh: true});
    }
    else{
    Portal.alert({text: data.msg, type: "danger"});
    }
    }
    },
    error: function (data) {
    }
    });
    }
    return false;
    });
    //End

    /*
    * Submit new quote form.
    */
    $("#quoteForm").on("submit", function(event){
    event.preventDefault();

    var postData = $("#quoteForm").serializeArray();

    if (Portal.Quotation.AddNew.Validation()) {
    Portal.wait();
    $.ajax({
    url: ajax_url + "/place_quote",
    data: postData,
    type: 'POST',
    dataType: 'JSON',
    success: function (data) {
    if(data.status == "OK"){
    if(data.job_type == 'quote'){
    if(data.payment_option == 'paynow'){
    if(data.payment_method == 'paypal'){
    Portal.alert({text: "Please wait. You are redirecting to payment page..", type: "success"});
    window.location.href = site_url + 'paypal_payment/' + data.order_id;
    }
    else{
    Portal.alert({text: "Please wait. You are redirecting to payment page..", type: "success"});
    window.location.href = site_url + 'payza_payment/' + data.order_id;
    }
    }
    else{
    window.location.href = site_url + 'quotations/';
    }
    }
    else{
    window.location.href = site_url + 'orders/';
    }
    }
    else{
    Portal.removeWait();
    if(data.refresh == true){
    Portal.alert({text: data.msg, type: "danger", refresh: true});
    }
    else{
    Portal.alert({text: data.msg, type: "danger"});
    }
    }
    },
    error: function (data) {
    }
    });
    };

    });

    /*
    * Color picker
    */ 
    $('input.minicolors').minicolors({
    letterCase: 'uppercase',
    theme: 'cutout',
    });

    Dropzone.options.fileUpload = {
    init: function() {
    this.on("addedfile", function(file) {
    $("#progress_bar").show().addClass('bounceIn');
    totaluploadprogress = 0;
    });

    this.on("success", function(file, response) {
    file.serverId = response;
    // var preview = response.preview[0];
    //     file.previewElement.querySelector("img").src = preview;
    var quantity = parseInt($('#qty').val());
    quantity = quantity + 1;
    $('#qty').val(quantity);
    total_images += 1;
    Portal.Order.addNew.CostCalcNew();

    });

    this.on("removedfile", function(file){
    $.ajax({
    url: ajax_url + "/remove_tmp_file?order_id=<?php echo $order_id; ?>",
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
    $("#tat_value").val(1);
    uploade_change();
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
    // url: "<?php echo site_url('ajax/uploader/') . '?order_id=' . $order_id; ?>",
    // paramName: "file",
    // maxFilesize: 300, // MB
    // addRemoveLinks: true,
    // maxFiles: 500,
    // maxThumbnailFilesize: 0.3, //MB
    // parallelUploads: 4,

    // //acceptedFiles: "image/*,.psd,.ai,.eps,.tif,.tiff,.pdf,.PSD,.AI,.EPS,.TIF,.TIFF,.PDF",
    // acceptedFiles: ".jpg,.jpeg,.png,.psd,.tiff,.pdf,.eps,.ai,.svg,.3fr,.ari,.arw,.srf,.sr2,.bay,.crw,.cr2,.cap,.iiq,.eip,.dcs,.dcr,.drf,.k25,.kdc,.dng,.erf,.fff,.mef,.mdc,.mos,.mrw,.nef,.nrw,.orf,.pef,.ptx,.pxn,.R3D,.raf,.raw,.rw2,.raw,.rwl,.dng,.rwz,.srw,.x3f",
    //acceptedFiles: "image/*",
    };

    showOrderQuote();
    window.onbeforeunload = $("#tat_value").val(0);
    });

    $(function(){
    window.prettyPrint && prettyPrint()
    $('#cp1').colorpicker({
    format: 'hex'
    });
    $('#cp2').colorpicker();
    $('#cp3').colorpicker();
    var bodyStyle = $('body')[0].style;
    $('#cp4').colorpicker().on('changeColor', function(ev){
    bodyStyle.backgroundColor = ev.color.toHex();
    });
    });
    $(".nav-main a").click(function(e) {

    var check_valu = uploade_change();
    var href    = $(this).attr("href");
    var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
    var r_url = regexp.test(href);
    var msg = "Upload is in progress or you haven’t submitted the order yet. Do you want to leave without finishing?";
    if (check_valu == 1 && r_url) {
    Portal.alert({text: msg, type: "dark", confirm: true, href: href});
    e.preventDefault();

    }else {
    return true;
    }
    }); 
    $(".header.navbar a").click(function(e) {
    var check_valu = uploade_change();
    var href    = $(this).attr("href");
    var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
    var r_url = regexp.test(href);
    var msg = "You have made some changes on the order page or uploaded some images but you haven’t submitted the order yet. Do you want to leave without finishing?";
    if (check_valu == 1 && r_url) {
    Portal.alert({text: msg, type: "dark", confirm: true, href: href});
    e.preventDefault();
    }else {
    return true;
    }
    });


</script>
