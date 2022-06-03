<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
 */
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

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
defined('FILE_READ_MODE') OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE') OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE') OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
 */
defined('FOPEN_READ') OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE') OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE') OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESCTRUCTIVE') OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE') OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE') OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT') OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT') OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
 */
defined('EXIT_SUCCESS') OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR') OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG') OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE') OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS') OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT') OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE') OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN') OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX') OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/*
 * Heard Copy Amount
 */
define('heard_copy_amount', '50');
/*
| Template used constants
 */
defined('TEMPLATES_DIR') OR define('TEMPLATES_DIR', './application/views/templates/'); // directory of templates
defined('VIEWS_DIR') OR define('VIEWS_DIR', './application/views/'); // directory of views
// Set Date Time
date_default_timezone_set('Asia/Kolkata');
/* Payment Status */
define('PAYMENT_STATUS', serialize(array('0' => 'Pending', '1' => 'In Progress', '3' => 'Cancled', '3' => 'On Hold', '4' => 'Success')));
define('GRIEVANCE_STATUS', serialize(array('0' => 'Pending', '1' => 'Grievance Submitted', '2' => 'In Progress', '3' => 'Closed', '4' => 'Reopned', '5' => 'Reopned', '6' => 'Closed', '7' => 'Reopned', '8' => 'Reopned', '9' => 'Closed', '10' => 'Reopned', '11' => 'Reopned', '12' => 'Closed')));

/* PAYTM Payment Gateway Constant*/
define('PAYTM_ENVIRONMENT', 'TEST'); // PROD
define('PAYTM_CHANNEL_ID', 'WEB'); //Change this constant's value with MID (Merchant ID) received from Paytm
define('PAYTM_INDUSTRY', 'RETAIL'); //Change this constant's value with MID (Merchant ID) received from Paytm
define('PAYTM_STATUS_QUERY_NEW_URL', 'https://securegw-stage.paytm.in/merchant-status/getTxnStatus');

if (PAYTM_ENVIRONMENT == 'PROD') {
	define('PAYTM_MERCHANT_KEY', 'MPPKnZtMmcfkRtTL');
	define('PAYTM_MERCHANT_MID', 'Sharda82809553440292');
	define('PAYTM_MERCHANT_WEBSITE', 'Shardaweb');
	define('PAYTM_REFUND_URL', 'https://secure.paytm.in/oltp/HANDLER_INTERNAL/REFUND');
	define('PAYTM_STATUS_QUERY_URL', 'https://secure.paytm.in/oltp/HANDLER_INTERNAL/TXNSTATUS');
	define('PAYTM_TXN_URL', 'https://secure.paytm.in/oltp-web/processTransaction');
} else {
	define('PAYTM_MERCHANT_KEY', 'ldnoMOg0GFUJBsR1');
	define('PAYTM_MERCHANT_MID', 'Sharda81867340973124');
	define('PAYTM_MERCHANT_WEBSITE', 'ShardaEducationalweb');
	define('PAYTM_REFUND_URL', '');
	define('PAYTM_STATUS_QUERY_URL', 'https://securegw-stage.paytm.in/merchant-status/getTxnStatus');
	define('PAYTM_TXN_URL', 'https://securegw-stage.paytm.in/theia/processTransaction');
}

define('TBL_ADMIN', 'admin');
define('API_KEY', '108045B4BAF2D77655BD7D68F5D5B0C1');
