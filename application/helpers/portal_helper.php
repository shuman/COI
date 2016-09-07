<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function check_user_listed($param) {
    
}

if (!function_exists('avatar')) {

    function avatar($email = null, $size = array()) {
        $CI = & get_instance();
        $src = 'images/avatar.png';

        if ($email != null) {
            $profile = $CI->mod_portal->get_user_by_email($email);
            if ($profile && $profile->avatar != '') {
                $src = 'avatar/' . $profile->avatar;
            }
        } else {
            $user_ref = $CI->portal_lib->get_cookie('user_ref');
            if (isset($CI->user_profile->avatar) && $CI->user_profile->avatar != null) {
                $src = 'avatar/' . $CI->user_profile->avatar;
            } else if (isset($user_ref->avatar) && !empty($user_ref->avatar)) {
                $src = 'avatar/' . $user_ref->avatar;
            }
        }

        if (!empty($size)) {
            $img_size = "h=$size[0]&w=$size[1]";
        } else {
            $img_size = "h=140&w=140";
        }

        return base_url() . "assets/timthumb.php?src=$src&" . $img_size;
    }

}

if (!function_exists('get_avatar')) {

    function get_avatar($user_id, $size = array()) {
        $CI = & get_instance();
        $profile = $CI->mod_portal->get_user($user_id);
        $src = 'images/avatar.png';

        if ($profile && !empty($profile->avatar)) {
            $src = 'avatar/' . $profile->avatar;
        }

        if (!empty($size)) {
            $img_size = "h=$size[0]&w=$size[1]";
        } else {
            $img_size = "h=140&w=140";
        }

        return base_url() . "assets/timthumb.php?src=$src&" . $img_size;
    }

}

if (!function_exists('secondsToTime')) {

    function secondsToTime($seconds = false) {
        if (!$seconds) {
            return false;
        }
        // extract hours
        $hours = floor($seconds / (60 * 60));

        // extract minutes
        $divisor_for_minutes = $seconds % (60 * 60);
        $minutes = floor($divisor_for_minutes / 60);

        // extract the remaining seconds
        $divisor_for_seconds = $divisor_for_minutes % 60;
        $seconds = ceil($divisor_for_seconds);

        // return the final array
        $obj = array(
            "h" => str_pad($hours, 2, '0', STR_PAD_LEFT),
            "m" => str_pad($minutes, 2, '0', STR_PAD_LEFT),
            "s" => str_pad($seconds, 2, '0', STR_PAD_LEFT),
        );
        return $obj;
    }

}

if (!function_exists('current_fullurl')) {

    function current_fullurl() {
        $CI = & get_instance();
        $url = $CI->config->site_url($CI->uri->uri_string());
        return $_SERVER['QUERY_STRING'] ? $url . '?' . $_SERVER['QUERY_STRING'] : $url;
    }

}

if (!function_exists('create_nonce')) {

    function create_nonce($action) {
        $CI = & get_instance();
        $uniqid = uniqid();
        $CI->session->set_flashdata($action, $uniqid);
        return $uniqid;
    }

}

if (!function_exists('verify_nonce')) {

    function verify_nonce($nonce, $action) {
        $CI = & get_instance();
        if ($nonce == $CI->session->flashdata($action)) {
            return true;
        } else {
            return false;
        }
    }

}

if (!function_exists('order_status2text')) {

    function order_status2text($id) {
        switch ($id) {
            case ORDER_PENDING:
                return 'Pending';
                break;
            case ORDER_CANCELLED:
                return 'Cancelled';
                break;
            case ORDER_COMPLETED:
                return 'Completed';
                break;
            default:
                return false;
                break;
        }
    }

}

if (!function_exists('quote_status2text')) {

    function quote_status2text($id) {
        switch ($id) {
            case QUOTE_REJECTED:
                return 'Rejected';
                break;
            case QUOTE_AWAITING:
                return 'Awaiting';
                break;
            case QUOTE_REVIEWED:
                return 'Reviwed';
                break;
            case QUOTE_ACCEPTED:
                return 'Accepted';
                break;
            default:
                return false;
                break;
        }
    }

}

if (!function_exists('job_options')) {

    function job_options($data, $flag) {
        $job_options = array();
        $service_options = explode('|', $data->service_option);
        /* Service Types */
        $job_options[] = ($data->service_flatness > 0) ? '&#8667;&nbsp;CP Flatness: ' . $data->service_flatness . 'px' : '';
        if ($data->service_type == 'cutout') {
            $job_options[] = (!empty($data->image_complexity)) ? '&#8667;&nbsp;Image Complexity: ' . $data->image_complexity : null;
            if ($data->service_option == 'CP with Flatness') {
                $job_options[] = '&#8667;&nbsp;Clipping Path Flatness: ' . $data->service_flatness;
            }
        } else if ($data->service_type == 'masking') {
            
        } else if ($data->service_type == 'retouch') {
            $job_options[] = (!empty($data->retouch_quality)) ? '&#8667;&nbsp;Retouching Level: ' . $data->retouch_quality : null;
        }
        /* Background Options */
        if (!empty($data->bg_option)) {
            if ($data->bg_option == 'Custom') {
                $job_options[] = '&#8667;&nbsp;Background: ' . $data->bg_option . ' (' . $data->bg_color . ')';
            } else {
                $job_options[] = '&#8667;&nbsp;Background: ' . $data->bg_option;
            }
        }
        $fix_imper_note = "";
        $photo_touch_note = "";
        $crop_resize_note = "";
        $color_collection_note = "";
        if ($flag != 'email') {
            $fix_imper_note = (isset($data->fix_imperfection_note) && $data->fix_imperfection_note != null ) ? '&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="seeNote text-info">See Note</a><p class="noteDesc">' . $data->fix_imperfection_note . '</p>' : '';
            $photo_touch_note = (isset($data->photo_retouch_note) && $data->photo_retouch_note != null) ? '&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="seeNote text-info">See Note</a><p class="noteDesc">' . $data->photo_retouch_note . '</p>' : '';
            $crop_resize_note = (isset($data->cropping_resizing_note) && $data->cropping_resizing_note != null) ? '&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="seeNote text-info">See Note</a><p class="noteDesc">' . $data->cropping_resizing_note . '</p>' : '';
            $color_collection_note = (isset($data->color_correction_note) && $data->color_correction_note != null) ? '&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="seeNote text-info">See Note</a><p class="noteDesc">' . $data->color_correction_note . '</p>' : '';
        }
        $job_options[] = (!empty($data->shadow_option) && $data->shadow_option_value > 0) ? '&#8667;&nbsp;Shadow: ' . $data->shadow_option : null;
        $job_options[] = ($data->mannequin_option_value != 'none' && $data->mannequin_option_value > 0) ? '&#8667;&nbsp;Mannequin: 3D - Invisible ($0.75)' : null;
        $job_options[] = ($data->straight_n_symmetric > 0) ? '&#8667;&nbsp;Straight & Symmetric ($0.25)' . $fix_imper_note : null;
        $job_options[] = ($data->fix_imperfection > 0) ? '&#8667;&nbsp;Fix Imperfection ($0.25)' . $fix_imper_note : null;
        $job_options[] = $data->photo_retouch_value > 0 ? '&#8667;&nbsp;Retouching: ' . $data->photo_retouch . ' ($' . $data->photo_retouch_value . ')' . $photo_touch_note : NULL;
        $job_options[] = ($data->cropping_resizing_value > 0) ? '&#8667;&nbsp;Cropping & Resizing: ' . $data->cropping_resizing . ' ($' . $data->cropping_resizing_value . ')' . $crop_resize_note : null;
        $job_options[] = ($data->color_correction_value > 0 && $data->color_correction != 'None') ? '&#8667;&nbsp;Color Correction: ' . $data->color_correction . ' ($' . $data->color_correction_value . ')' . $color_collection_note : null;

        $output = '<strong>Job Options Selected:</strong><br>';
        $output .= implode('<br>', array_filter($job_options));
        return $output;
    }

}

/**
 * @param object company info
 */
if (!function_exists('company_address')) {

    function company_address($company) {
        $address = '';
        $address .= '<h4 class="text-info"><strong>' . $company->name . '</strong></h4>';
        $address .= '<p>';
        $address .= (!empty($company->address1)) ? $company->address1 . ', ' : '';
        $address .= (!empty($company->address2)) ? $company->address2 . ', <br>' : '';
        $address .= (!empty($company->city)) ? $company->city . ((!empty($company->postal_code)) ? ' - ' . $company->postal_code : '') . ', <br>' : '';
        $address .= (!empty($company->country)) ? '<b>' . country_name($company->country) . '</b><br>' : '';
        $address .= (!empty($company->phone)) ? 'Phone: ' . $company->phone . '<br>' : '';
        $address .= (!empty($company->email)) ? 'Email: ' . $company->email . '<br>' : '';
        $address .= '</p>';

        return $address;
    }

}
if (!function_exists('country_name')) {

    function country_name($iso = null) {
        $CI = & get_instance();
        $country = $CI->mod_portal->get_country_by_iso($iso);

        if ($country) {
            return $country->nicename;
        } else {
            return false;
        }
    }

}

if (!function_exists('country_dropdown')) {

    //selected country would be retrieved from a database or as post data
    function country_dropdown($name, $id, $class, $selected_country, $top_countries = array(), $show_all = TRUE) {
        $CI = & get_instance();

        // You may want to pull this from an array within the helper
        // $countries = config_item('country_list');
        $countries = $CI->mod_portal->get_countries();

        $html = "<select name='{$name}' id='{$id}' class='{$class}' required>";
        $html .= "<option value=''>Select Country</option>";

        if (!empty($top_countries)) {
            $html .= "<optgroup label='Countries'>";
            foreach ($countries as $country) {
                if (in_array($country->iso, $top_countries)) {
                    $html .= "<option value='{$country->iso}' data-callcode='{$country->phonecode}'>{$country->nicename}</option>";
                }
            }
            $html .= "</optgroup>";
        }

        if ($show_all) {
            $html .= "<optgroup label='All Countries'>";
            foreach ($countries as $country) {
                $selected = ($country->iso == $selected_country) ? 'selected' : '';
                $html .= "<option value='{$country->iso}' data-callcode='{$country->phonecode}' $selected>{$country->nicename}</option>";
            }
            $html .= "</optgroup>";
        }

        $html .= "</select>";
        return $html;
    }

}

if (!function_exists('is_downloadable')) {

    function is_downloadable($order_id, $ext = 'zip') {

        $file_path = FCPATH . 'downloads/' . $order_id . '.' . $ext;
        if (file_exists($file_path)) {
            return TRUE;
        }
        return FALSE;
    }

}

/*
 * Remove only from %upload% named directory.
 */
if (!function_exists('rrmdir')) {

    function rrmdir($dir) {
        if (!preg_match('/upload/', $dir)) {
            exit('safe exit');
        }
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir . "/" . $object) == "dir") {
                        rrmdir($dir . "/" . $object);
                    } else {
                        unlink($dir . "/" . $object);
                    }
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }

}

function get_key($id) {
    $key = $id;
    $key = str_replace('COI-', '', $key);
    $key = str_replace('QR-', '', $key);
    $key = str_replace('INV-', '', $key);

    $key_id = explode('-', $key);
    return (isset($key_id[0]) && isset($key_id[1])) ? $key_id[0] . '-' . $key_id[1] : $id;
}

function orderid_to_key($order_id) {
    $key_id = explode('-', $order_id);
    return (isset($key_id[2])) ? $key_id[2] : $order_id;
}

function orderid_short($order_id) {
    $idArr = explode('-', $order_id);
    return date("d M", strtotime($idArr[4])) . " {$idArr[1]}({$idArr[2]})";
}

function quoteid_to_key($quote_id) {
    $key_id = explode('-', $quote_id);
    return (isset($key_id[3])) ? $key_id[3] : $quote_id;
}

function invid_to_key($inv_id) {
    $key_id = explode('-', $inv_id);
    return (isset($key_id[3])) ? $key_id[3] : $inv_id;
}

function is_company_owner($user_id) {
    $CI = & get_instance();

    if ($CI->company->user_id == $user_id) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function has_permission($name, $user_id, $company_id) {
    $CI = & get_instance();

    $permission = $CI->portal_lib->get_company_permission($user_id, $company_id);

    if (is_company_owner($user_id)) {
        return true;
    }

    if (!isset($permission[$name]) || $permission[$name] != 1) {
        return false;
    }
    return true;
}

function get_short_url($long_url, $return_all = false) {
    $username = 'admin';
    $password = 'admin';
    $api_url = 'https://cutout.io/yourls-api.php';

    // Init the CURL session
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_HEADER, 0);            // No header in the result
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return, do not echo result
    curl_setopt($ch, CURLOPT_POST, 1);              // This is a POST request
    curl_setopt($ch, CURLOPT_POSTFIELDS, array(// Data to POST
        'url' => $long_url,
        'format' => 'json',
        'action' => 'shorturl',
        'username' => $username,
        'password' => $password
    ));

    // Fetch and return content
    $data = curl_exec($ch);
    curl_close($ch);

    // Do something with the result. Here, we echo the long URL
    $data = json_decode($data);
    $output = array();

    if (isset($data->statusCode) && $data->statusCode == 200) {
        $output['data'] = $data;
        $output['shorturl'] = $data->shorturl;
        $output['message'] = $data->message;
        $output['keyword'] = $data->url->keyword;
        if ($return_all) {
            return $output;
        } else {
            return $data->shorturl;
        }
    } else {
        if ($return_all) {
            return $output['shorturl'] = $long_url;
        } else {
            return $long_url;
        }
    }
}

function get_long_url($keyword) {
    $username = 'admin';
    $password = 'admin';
    $api_url = 'https://cutout.io/yourls-api.php';

    // Init the CURL session
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_HEADER, 0);            // No header in the result
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return, do not echo result
    curl_setopt($ch, CURLOPT_POST, 1);              // This is a POST request
    curl_setopt($ch, CURLOPT_POSTFIELDS, array(// Data to POST
        'shorturl' => $keyword,
        'format' => 'json',
        'action' => 'expand',
        'username' => $username,
        'password' => $password
    ));

    // Fetch and return content
    $data = curl_exec($ch);
    curl_close($ch);

    // Do something with the result. Here, we echo the long URL
    $data = json_decode($data);
    $output = array();
    if ($data->statusCode == 200) {
        $output['data'] = $data;
        $output['keyword'] = $data->keyword;
        $output['shorturl'] = $data->shorturl;
        $output['longurl'] = $data->longurl;
        $output['message'] = $data->message;
        return $output;
    }
    return $data;
}

if (!function_exists('truncate')) {

    function truncate($input, $maxWords, $maxChars = 500) {
        $words = preg_split('/\s+/', $input);
        $words = array_slice($words, 0, $maxWords);
        $words = array_reverse($words);

        $chars = 0;
        $truncated = array();

        while (count($words) > 0) {
            $fragment = trim(array_pop($words));
            $chars += strlen($fragment);

            if ($chars > $maxChars)
                break;

            $truncated[] = $fragment;
        }

        $result = implode($truncated, ' ');

        return $result . ($input == $result ? '' : '...');
    }

}



if (!function_exists('getErrMsg')) {

    function getErrMsg($key = '_ERR001') {
        $CI = & get_instance();
        $error = $CI->mod_portal->get_error_data($key);
        if ($error) {
            return $error->err_message;
        }
        return '';
    }

}


if (!function_exists('splitFullname')) {

    function splitFullname($name) {
        $name = trim($name);
        $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        $first_name = trim(preg_replace('#' . $last_name . '#', '', $name));
        return array($first_name, $last_name);
    }

}


if (!function_exists('getS3Details')) {

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
        $scope = [$awsKey, $shortDate, $region, $service, $requestType];
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

}

