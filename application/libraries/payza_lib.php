<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payza_lib {

    var $response;
    var $pp_data = array();
    var $fields = array();
    var $myCurlPreferences = array();
    var $processor_url;

    function __construct() {
        $this->ci = & get_instance();

        $this->ci->config->load('payza');

        // constructor.
        $this->processor_url = $this->ci->config->item('ap_main_url');
        $this->response = '';
        $this->add_field('rm', '2');
        $this->add_field('cmd', '_xclick');
        $this->add_field('ap_merchant', $this->ci->config->item('ap_email'));
        $this->add_field('ap_securitycode', $this->ci->config->item('ap_securitycode'));
        $this->add_field('ap_status', $this->ci->config->item('ap_status'));
        $this->add_field('ap_purchasetype', $this->ci->config->item('ap_purchase_type'));
        $this->add_field('ap_currency', $this->ci->config->item('ap_currency'));
        $this->add_field('ap_test', $this->ci->config->item('ap_istestmode'));
        $this->add_field('ap_transactiontype', $this->ci->config->item('ap_transactiontype'));
    }

    /**
     * Add form field
     */
    public function add_field($field, $value) {
        $this->fields["$field"] = $value;
    }

    public function setTransactionData($field, $value) {
        //if($field=="TotalAmount")
        //	$value = round($value*100);
        $this->myTransactionData["eway" . $field] = htmlentities(trim($value));
    }

    public function submit_toPayment_post() {
        //echo "<body onLoad=\"document.forms['paymentprocess_form'].submit();\">\n";
        $html = '<div id="form-content">';
        $html .= "<center><div class='wait_msg'>Please wait, your order is being processed and you will be redirected to the payment page within 5 seconds.</div></center>\n";
        $html .= "<form id=\"paymentprocess_form\" method=\"post\" name=\"paymentprocess_form\" ";
        $html .= "action=\"" . $this->processor_url . "\">\n";
        foreach ($this->fields as $name => $value) {
            $html .= "<input type=\"hidden\" name=\"$name\" value=\"$value\"/>\n";
        }
        $html .= '<center><br/><div class="progress progress-sm progress-striped  active">
                          <div class="progress-bar bg-info lter" data-toggle="tooltip" style="width: 0%"></div>
                        </div></center>';
        // $html .= "<center>If you are not automatically redirected to ";
        $html .= "<center>Still loading after 5 seconds?</center><br/><br/>\n";
        $html .= "<center><input type=\"submit\" class=\"submitProcessing btn btn-default\" value=\"Try Again\"></center>\n";
        $html .= "</form>\n";
        $html .= '</div>';

        return $html;
    }

    /**
     * Send XML Transaction Data and receive XML response
     */
    public function ewaysendTransactionToEway($xmlRequest) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->processor_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlRequest);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        foreach ($this->myCurlPreferences as $key => $value) {
            curl_setopt($ch, $key, $value);
        }

        if (!$xmlResponse = curl_exec($ch)) {
            trigger_error(curl_error($ch));
        }

        if (curl_errno($ch) == CURLE_OK) {
            curl_close($ch);
            return $xmlResponse;
        }
        curl_close($ch);
    }

    /**
     * Parse XML response from eway and place them into an array
     */
    public function ewayparseResponse($xmlResponse) {
        $xml_parser = xml_parser_create();
        xml_parse_into_struct($xml_parser, $xmlResponse, $xmlData, $index);
        $responseFields = array();
        foreach ($xmlData as $data) {
            if ($data["level"] == 2) {
                $responseFields[$data["tag"]] = $data["value"];
            }
        }
        return $responseFields;
    }

    public function setCurlPreferences($field, $value) {
        $this->myCurlPreferences[$field] = $value;
    }

    public function getVisitorIP() {
        $ip = $_SERVER["REMOTE_ADDR"];
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $proxy = $_SERVER["HTTP_X_FORWARDED_FOR"];
            if (ereg("^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$", $proxy)) {
                $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
            }
        }
        return $ip;
    }

    /**
     * @param array $post_data
     * @return array formatted
     */
    public function ipnv1_handler($post_data) {
        $result = array();
        if (!empty($post_data) && is_array($post_data)) {
            $result['receivedSecurityCode'] = urldecode($post_data['ap_securitycode']);
            $result['receivedMerchantEmailAddress'] = urldecode($post_data['ap_merchant']);
            $result['transactionStatus'] = urldecode($post_data['ap_status']);
            $result['testModeStatus'] = urldecode($post_data['ap_test']);
            $result['purchaseType'] = urldecode($post_data['ap_purchasetype']);
            $result['totalAmountReceived'] = urldecode($post_data['ap_totalamount']);
            $result['feeAmount'] = urldecode($post_data['ap_feeamount']);
            $result['netAmount'] = urldecode($post_data['ap_netamount']);
            $result['transactionReferenceNumber'] = urldecode($post_data['ap_referencenumber']);
            $result['currency'] = urldecode($post_data['ap_currency']);
            $result['transactionDate'] = urldecode($post_data['ap_transactiondate']);
            $result['transactionType'] = urldecode($post_data['ap_transactiontype']);

            //Setting the customer's information from the IPN post variables
            $result['customerFirstName'] = urldecode($post_data['ap_custfirstname']);
            $result['customerLastName'] = urldecode($post_data['ap_custlastname']);
            $result['customerAddress'] = urldecode($post_data['ap_custaddress']);
            $result['customerCity'] = urldecode($post_data['ap_custcity']);
            $result['customerState'] = urldecode($post_data['ap_custstate']);
            $result['customerCountry'] = urldecode($post_data['ap_custcountry']);
            $result['customerZipCode'] = urldecode($post_data['ap_custzip']);
            $result['customerEmailAddress'] = urldecode($post_data['ap_custemailaddress']);

            //Setting information about the purchased item from the IPN post variables
            $result['job_title'] = urldecode($post_data['ap_itemname']);
            $result['order_id'] = urldecode($post_data['ap_itemcode']);
            $result['job_desc'] = urldecode($post_data['ap_description']);
            $result['cart_quantity'] = urldecode($post_data['ap_quantity']);
            $result['total_value'] = urldecode($post_data['ap_amount']);

            //Setting extra information about the purchased item from the IPN post variables
            $result['additionalCharges'] = urldecode($post_data['ap_additionalcharges']);
            $result['shippingCharges'] = urldecode($post_data['ap_shippingcharges']);
            $result['taxAmount'] = urldecode($post_data['ap_taxamount']);
            $result['discountAmount'] = urldecode($post_data['ap_discountamount']);

            //Setting your customs fields received from the IPN post variables
            $result['paidby_user_id'] = urldecode($post_data['apc_1']);
            $result['myCustomField_2'] = urldecode($post_data['apc_2']);
            $result['myCustomField_3'] = urldecode($post_data['apc_3']);
            $result['myCustomField_4'] = urldecode($post_data['apc_4']);
            $result['myCustomField_5'] = urldecode($post_data['apc_5']);
            $result['myCustomField_6'] = urldecode($post_data['apc_6']);
            return $result;
        }
        return false;
    }

    /**
     * @param string token
     * @return array formatted
     */
    public function ipnv2_handler($token) {
        $token = urlencode($token);
        $token_verify_url = $this->ci->config->item('ipn_v2_handler');
        //preappend the identifier string "token=" 
        $token = "token=" . $token;

        /**
         * 
         * Sends the URL encoded TOKEN string to the Payza's IPN handler
         * using cURL and retrieves the response.
         * 
         * variable $response holds the response string from the Payza's IPN V2.
         */
        $response = '';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $token_verify_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $token);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);

        curl_close($ch);

        if (strlen($response) > 0) {
            if (urldecode($response) == "INVALID TOKEN") {
                return false;
            } else {
                //urldecode the received response from Payza's IPN V2
                $response = urldecode($response);

                //split the response string by the delimeter "&"
                $aps = explode("&", $response);

                $info = array();
                foreach ($aps as $ap) {
                    //put the IPN information into an associative array $info
                    $ele = explode("=", $ap);
                    $info[$ele[0]] = $ele[1];
                }

                $result = array();

                //setting information about the transaction from the IPN information array
                $result['receivedMerchantEmailAddress'] = $info['ap_merchant'];
                $result['transactionStatus'] = $info['ap_status'];
                $result['testModeStatus'] = $info['ap_test'];
                $result['purchaseType'] = $info['ap_purchasetype'];
                $result['totalAmountReceived'] = $info['ap_totalamount'];
                $result['feeAmount'] = $info['ap_feeamount'];
                $result['netAmount'] = $info['ap_netamount'];
                $result['transactionReferenceNumber'] = $info['ap_referencenumber'];
                $result['currency'] = $info['ap_currency'];
                $result['transactionDate'] = $info['ap_transactiondate'];
                $result['transactionType'] = $info['ap_transactiontype'];

                //setting the customer's information from the IPN information array
                $result['customerFirstName'] = $info['ap_custfirstname'];
                $result['customerLastName'] = $info['ap_custlastname'];
                $result['customerAddress'] = $info['ap_custaddress'];
                $result['customerCity'] = $info['ap_custcity'];
                $result['customerState'] = $info['ap_custstate'];
                $result['customerCountry'] = $info['ap_custcountry'];
                $result['customerZipCode'] = $info['ap_custzip'];
                $result['customerEmailAddress'] = $info['ap_custemailaddress'];

                //setting information about the purchased item from the IPN information array
                $result['job_title'] = $info['ap_itemname'];
                $result['order_id'] = $info['ap_itemcode'];
                $result['job_desc'] = $info['ap_description'];
                $result['cart_quantity'] = $info['ap_quantity'];
                $result['total_value'] = $info['ap_amount'];

                //setting extra information about the purchased item from the IPN information array
                $result['additionalCharges'] = $info['ap_additionalcharges'];
                $result['shippingCharges'] = $info['ap_shippingcharges'];
                $result['taxAmount'] = $info['ap_taxamount'];
                $result['discountAmount'] = $info['ap_discountamount'];

                //setting your customs fields received from the IPN information array
                $result['paidby_user_id'] = $info['apc_1'];
                $result['myCustomField_2'] = $info['apc_2'];
                $result['myCustomField_3'] = $info['apc_3'];
                $result['myCustomField_4'] = $info['apc_4'];
                $result['myCustomField_5'] = $info['apc_5'];
                $result['myCustomField_6'] = $info['apc_6'];

                return $result;
            }
        } else {
            //something is wrong, no response is received from Payza
            return false;
        }
    }

}

//class end  
















