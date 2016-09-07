<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
  |--------------------------------------------------------------------------
  | Status
  |--------------------------------------------------------------------------
 */
define('ORDER_CANCELLED', 0);
define('ORDER_PENDING', 1);
define('ORDER_COMPLETED', 2);
define('ORDER_HOLD', 3);
define('ORDER_TERMINATED', 4);

define('QUOTE_REJECTED', 0);
define('QUOTE_AWAITING', 1);
define('QUOTE_REVIEWED', 2);
define('QUOTE_ACCEPTED', 3);

/*
  |--------------------------------------------------------------------------
  | COST for services
  |--------------------------------------------------------------------------
 */

define('MASKING_VALUE', 0.50);
define('RETOUCH_VALUE', 0.50);
define('CROP_RESIZE', 0.25);
define('COLOR_CORRECTION', 0.50);
define('DROP_SHADOW', 0.25);
define('NATURAL_SHADOW', 0.50);
define('MIRROR_EFFECT', 0.50);
define('FILE_TYPE', 0.05);

/*
  |--------------------------------------------------------------------------
  | Table Names
  |--------------------------------------------------------------------------
 */
define('FREE_TRIAL', 'free_trial');
define('SERVICES', 'services');
define('ORDERS', 'orders');
define('QUOTES', 'quotes');
define('USERS', 'users');
define('USER_PROFILES', 'user_profiles');
define('COMPANY', 'company');
define('COUNTRY', 'country');
define('SETTINGS', 'settings');
define('COMPANY_MEMBER', 'company_member');
define('USER_INVITE', 'user_invite');
define('PAYMENT', 'payment');
define('MESSAGES', 'messages');
define('MESSAGE_STATUS', 'message_status');
define('AUDIT_LOG', 'audit_log');
define('ERROR_TABLE', 'error_msg');

/*
  |--------------------------------------------------------------------------
  | Settings Names
  |--------------------------------------------------------------------------
 */
define('NEWSLETTER', 'newsletter');
define('NOTIFY_BILLING_PAYMENT', 'notify_billing_payment');

define('NOTIFY_QUOTE_SUBMIT', 'notify_quote_submit');
define('NOTIFY_QUOTE_CONFIRM', 'notify_quote_confirm');
define('NOTIFY_QUOTE_ACCEPT', 'notify_quote_accept');
define('NOTIFY_QUOTE_REVIEWED', 'notify_quote_reviewed');
define('NOTIFY_QUOTE_REJECT', 'notify_quote_reject');

define('NOTIFY_ORDER_SUBMIT', 'notify_order_submit');
define('NOTIFY_ORDER_RECEIVED', 'notify_order_received');
define('NOTIFY_ORDER_READY', 'notify_order_ready');
define('NOTIFY_ORDER_CONFIRM', 'notify_order_confirm');
define('NOTIFY_ORDER_STATUS', 'notify_order_status');
define('NOTIFY_ORDER_DELIVERY', 'notify_order_delivery');

define('NOTIFY_NEW_MESSAGE', 'notify_new_message');
define('NOTIFY_MANAGER_MESSAGE', 'notify_manager_message');
define('NOTIFY_MANAGER_UPDATES', 'notify_manager_updates');

define('NOTIFY_PROFILE_UPDATE', 'notify_profile_update');
define('NOTIFY_ADMIN_MESSAGE', 'notify_admin_message');


/*
  |--------------------------------------------------------------------------
  | AWS Credentials
  |--------------------------------------------------------------------------
 */
define('AWS_ACCESS_KEY', 'AKIAIGZJPUUTGWEPZBRQ');
define('AWS_SECRET', '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');


/*
  |--------------------------------------------------------------------------
  | File and Directory Modes
  |--------------------------------------------------------------------------
  |
  | These prefs are used when checking and setting modes when working
  | with the file system.  The defaults are fine on servers with proper
  | security, but you may wish (or even need) to change the values in
  | certain environments (Apache running a separate process for each
  | user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
  | always be used to set the mode correctly.
  |
 */
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
  |--------------------------------------------------------------------------
  | File Stream Modes
  |--------------------------------------------------------------------------
  |
  | These modes are used when working with fopen()/popen()
  |
 */

define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');


/* End of file constants.php */
/* Location: ./application/config/constants.php */