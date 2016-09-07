<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


//==== localhost ======
if(ENVIRONMENT == 'development'){
	$config['ap_email']            = "seller_2_jobaer.shuman@gmail.com";
	$config['ap_securitycode']     = "xTG9ZurBxZg6QrUR";
}

//==== http://www.cutoutimage.com/dev/ ======
if(ENVIRONMENT == 'testing'){
	$config['ap_email']            = "seller_1_jobaer.shuman@gmail.com";
	$config['ap_securitycode']     = "L1jPaL3KvZw2JTEs";
}

//==== https://www.cutoutimage.com/portal/ ======
if(ENVIRONMENT == 'production'){
	$config['ap_email']            = "hello@arcreativebd.com";
	$config['ap_securitycode']     = "3YobBqfbnp4D5PZA";
}

$test_mode = $this->config['test_payment']; //1=true, 0=false


$config['ap_status']           = "1";
$config['ap_purchase_type']    = "item";
$config['ap_currency']         = "USD";
$config['ap_istestmode']       = $test_mode;
$config['ap_transactiontype']  = "purchase";

if($test_mode == 1){
	$config['ap_main_url']    = "https://sandbox.payza.com/sandbox/payprocess.aspx";
	$config['ipn_v2_handler'] = "https://sandbox.payza.com/sandbox/ipn2.ashx";
}
else{
	$config['ap_main_url']    = "https://secure.payza.com/payprocess.aspx";
	$config['ipn_v2_handler'] = "https://secure.payza.com/ipn2.ashx";
	
}



/**
 * Log IPN info
 */
$config['log_ipn_info']      	= false;
