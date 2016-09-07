<?php 
use Omnipay\Omnipay;
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Testpad extends MY_Controller
{
	function __construct(){
		parent::__construct();
		// $this->output->enable_profiler(TRUE);
	}

	function index()
	{
		// echo FCPATH;
		$id = 'COI-000397-48-00188-20151108';
		$idArr = explode('-', $id);
		echo $shortId = date("d M", strtotime($idArr[4]))." {$idArr[1]}({$idArr[2]})";
	}

	function get_short_url(){
		$long_url = 'https://cutoutimage.com/?'.time();

		$res = get_short_url($long_url);

		echo '<pre>';
		var_dump($res);
	}

	function get_long_url($keyword='a'){

		$res = get_long_url($keyword);

		var_dump($res);
	}

	function getorder(){
		$res = $this->portal_lib->get_order();
		echo '<pre>';
		if($res){
			print_r($res);
		}
		echo '</pre>';
	}

	function test(){
		$black_listed_countries = array('BD', 'IND', 'PAK');
        $res = $this->mod_portal->is_bloced_by_country(188, $black_listed_countries);
        echo '<pre>';
        print_r($res);
        echo '</pre>';
        exit();

		// $this->mod_portal->set_company_member_permission(10, 2, array('manage_order'=>1));
		// $com = $this->portal_lib->get_company_permission(10, 2);


		// $res = $user_info = $this->portal_lib->get_user_profile_by_quote_id( 'COI-QR-000022-48-2-20150222' );
		// var_dump($com);
		//echo base_url().'assets/avatar/john-doe-3.jpg';
		

		// $user_info = $this->portal_lib->get_user_profile_by_order_id('COI-000071-48-11-20141027');
		// var_dump($user_info);



		//$payment_info = $this->mod_portal->get_payment_info_by_oderid('COI-000071-48-11-20141027');
		//var_dump($payment_info);

		//echo $site_name;
		// $res = $this->mod_portal->update_download_counter('COI-53EE1A24D3E24');
		// var_dump($res);


		// echo $this->config->item('email_asset');
		//$this->load->view('email/email_template');
		// $this->load->library('email_lib');
		// if($this->email_lib->test($data = array())){
		// 	echo "Success";
		// }
		// else{
		// 	echo "Failed<br>";
		// }
		// var_dump($this->email->print_debugger());


		// var_dump($this->user_profile);

		//date_default_timezone_set('UTC-0');
		
		/*echo date("c");
		echo '<hr>';
		echo date("Y-m-d H:i:s", time());*/
		//$this->load->view('tpl_invoice');
		//echo lang('p_test');
		//$data['invite_key'] = '345678';
		//$this->load->view('email/invite-html', $data);
		//$com = $this->portal_lib->get_my_companies($this->user_id);
		//$com = $this->portal_lib->load_messages();
		// $this->portal_lib->set_cookie('test', array("testarr1"=>"hello world"));
		//$data = $this->portal_lib->get_cookie('test');
		// echo '<pre>';
		// print_r($this->notifications);

	}

	function email_test($tpl='user_invitation'){
		$this->{$tpl}();
		// echo $tpl;
	}

	function user_invitation(){
		$data['asset_path'] = $this->config->item('email_asset');
		$data['company_name'] = 'Big Rocks';
		$data['invite_to_email'] = 'invite_to@email.com';
		$data['invite_url'] = site_url('/auth/invite/').'?key=234567890-6ds9876543234567890-6ds9876543';

		$data['invited_by_name'] = 'John Doe';

		$user    = $this->user_profile;
		$data['user_info'] = $user;

		$to      = $data['invite_to_email'];
		$subject = $data['invited_by_name'] . ' invited you to join '.$data['company_name'].' on Cut Out Image';

		$data['content'] = $this->load->view('email/user_invitation', $data, TRUE);
		$this->load->view('email/email_template', $data);
	}

	function admin_mail_quote_reviewed(){
		$data['asset_path'] = $this->config->item('email_asset');
		$data['company_name'] = 'Big Rocks';
		$data['invite_to_email'] = 'invite_to@email.com';
		$data['invite_url'] = site_url('/');

		$data['invited_by_name'] = 'John Doe';

		$user    = $this->user_profile;
		$data['user_info'] = $user;


		$to = 'hello@cutoutimage.com';
		$subject = 'New Quotation Reviewed';

		$data['content'] = $this->load->view('email/admin_quote_reviewed', $data, TRUE);
		$this->load->view('email/email_template', $data);
	}

	function user_mail_quote_reviewed($quote_id){
		
		$data['asset_path']      = $this->config->item('email_asset');
		$data['company_name']    = 'Big Rocks';
		$data['invite_to_email'] = 'invite_to@email.com';
		$data['invite_url']      = site_url('/');
		$data['invited_by_name'] = 'John Doe';
		$data['quote_key'] 		 = get_key($quote_id);
		

		$data['order_details'] = $this->portal_lib->get_quote_by_id($quote_id);

		$data['quote_id']        = $quote_id;
		$data['flat_rate']       = '2';
		
		$user                    = $this->user_profile;
		$data['user_info']       = $user;
		
		// var_dump($data);
		
		$to                      = 'hello@cutoutimage.com';
		$subject                 = 'New Quotation Reviewed';

		$subject = 'Admin Reviewed Quotation '.$data['quote_key'].'';
		$data['content'] = $this->load->view('email/user_quote_reviewed', $data, TRUE);
		$this->load->view('email/email_template', $data);
	}

	function page(){
		$data['title']       = (!empty($title)) ? $title : 'Cut Out Image Service Portal - Client Area';
        $data['profile']     = $this->user_profile;
        /* Template HTML */
        $html['content']     = $this->load->view('testpad-view', '', TRUE);
        $html['header']      = $this->load->view('tpl_header', $data, TRUE);
        // $html['topfixedbar'] = $this->load->view('tpl_topfixedbar', '', TRUE);
        // $html['navigation']  = $this->load->view('tpl_navigation','', TRUE);
        $html['footer']      = $this->load->view('tpl_footer','', TRUE);


    	$this->load->view('tpl_index', $html);
    	
		
	}

	function payment(){
		$this->load->library('merchant');
		$this->merchant->load('paypal_express');

		//$settings = $this->merchant->default_settings();

		$settings = array(
		    'username' => 'mrchnt_1320057709_biz_api1.gmail.com',
		    'password' => '1320057749',
		    'signature' => 'A9VQS-DhTo7HcBSk6lKpHj4Wx3w6ALaKoN2zkdDgM0Iy44hmHHOoJQt.',
		    'test_mode' => true);

		$this->merchant->initialize($settings);


		$params = array(
			    'amount' => 100.00,
			    'currency' => 'USD',
			    'return_url' => site_url('/payment_return/123'),
			    'cancel_url' => site_url('/payment_cancel')
		    );

		$response = $this->merchant->purchase($params);

		$response = $this->merchant->purchase_return($params);

		echo "payment test";
	}
	
	function test_user(){
		$user_id = $this->session->userdata('user_id');

		//$company = $this->portal_lib->get_company_info($user_id);

		$res = $invited_by = $this->mod_portal->get_user_by_email('jobaer.shuman@gmail.com');
		echo '<pre>';
		print_r($res);
	}

	function pdf(){
		$this->load->library('pdf');
		$html = $this->load->view('tpl_invoice', '', true);
		echo $html; 
		//$this->pdf->do_pdf('test', $html);
		// $this->pdf->load_view('welcome');
		// $this->pdf->render();
		//$this->pdf->stream("welcome.pdf");
	}

	function aws() {
		$a = 'F-UID-3-TI-1469713747263/${filename}';
		$b = explode('/', $a);
		var_dump($b[0]); die();
	}

	function paypl() {
		$html = $this->load->view('test_payment', '', true);
		echo $html; 
	}

	function t_payment_ch() {
		$sMerchantTransID = rand(11111111,99999999);
		$oGateway = Omnipay::create('TwoCheckout');
		// var_dump($oGateway); die();
		$oGateway->setAccountNumber('901323129');
		// $oGateway->setSecretWord('276B57C5-C819-46CA-959D-C3C0AC3FC1E7');
		$oGateway->setTestMode(true); // turns on Sandbox access

		$params = array(
					'amount'      => 2.00,
					'currency'    => 'USD',
					'returnUrl'  => site_url('testpad/c_success/'),
					'cancelUrl'  => site_url('testpad/c_cancel/')
					// 'card' => array(
				 //        'billingName' => 'Joe Flagster',
				 //        'billingAddress1' => '123 Main Street',
				 //        'billingAddress2' => '123 Main Street',
				 //        'billingCity' => 'Townsville',
				 //        'billingState' => 'Ohio',
				 //        'billingPostcode' => '43206',
				 //        'billingCountry' => 'USA',
				 //        'email' => 'tarekfb77@gmail.com'
				 //    )
			    );

		$response = $oGateway->purchase($params)->send();
    	if($response->isRedirect()) {
		    // Redirect user to paypal login page
		    return $response->redirect();
		} else {
		    var_dump('Unable to authenticate against PayPal'); die();     
		}
	}

	function c_success() {
		var_dump('Success'); die();
	}

	function c_cancel() {
		var_dump('Cancel'); die();
	}

	function t_payment() {
		$gateway = Omnipay::create('PayPal_Express');

		$gateway->setUsername('payment-facilitator_api1.diehardcoder.com');
    	$gateway->setPassword('9LVV3ZRBQENJWY62');
    	$gateway->setSignature('AFcWxV21C7fd0v3bYYYRCpSSRl31AKPzzDtFMTH5LqaEodDowuaUb.bU');
    	$gateway->setTestMode(true);

    	$params = array(
					'amount'      => 1.00,
					'description' => 'Hello Des',
					'currency'    => 'USD',
					'returnUrl'  => site_url('testpad/p_success/'),
					'cancelUrl'  => site_url('testpad/p_cancel/')
			    );
    	$response = $gateway->purchase($params)->send();
    	if($response->isRedirect()) {
		    // Redirect user to paypal login page
		    return $response->redirect();
		} else {
		    var_dump('Unable to authenticate against PayPal'); die();     
		}
	}

	function p_success() {
		$gateway = Omnipay::create('PayPal_Express');

		$gateway->setUsername('payment-facilitator_api1.diehardcoder.com');
    	$gateway->setPassword('9LVV3ZRBQENJWY62');
    	$gateway->setSignature('AFcWxV21C7fd0v3bYYYRCpSSRl31AKPzzDtFMTH5LqaEodDowuaUb.bU');
    	$gateway->setTestMode(true);
    	$purchaseId = $_GET['PayerID'];

    	$params = array(
					'amount'      => 1.00,
					'description' => 'Hello Des',
					'currency'    => 'USD',
					'returnUrl'  => site_url('testpad/p_success/'),
					'cancelUrl'  => site_url('testpad/p_cancel/'),
					'transactionReference' => $purchaseId
			    );
    	$response = $gateway->completePurchase($params)->send();

    	if($response->isSuccessful()) {
		    var_dump('Thank you for your payment!'); die();
		} else {
		    var_dump('Unable to complete transaction. Check your balance'); die();
		}

//     	$purchaseId = $_GET['PayerID'];
//         $response = $gateway->completePurchase([
//             'transactionReference' => $purchaseId
//         ])->send();

// var_dump('ok'); die();

//     	var_dump($response->getTransactionReference());
//     	var_dump($response->getMessage());
//     	$data = $response->getRedirectData();
//     	var_dump($data);
//     	if ($response->isSuccessful()) {
// 		    var_dump($response->isSuccessful());
// 		    var_dump('Success'); die();
// 		} elseif ($response->isRedirect()) {
// 		    var_dump($response->isRedirect());
// 		    var_dump('Redirect'); die();
// 		} else {
// 		    var_dump('else'); die();
// 		}
	}
}
