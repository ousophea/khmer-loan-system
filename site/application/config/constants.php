<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/**
 * constand defined by custom user
 * Constant for access directory path
 */
define('MEDIA_PATH', 'images/');
define('BOOTSTRAP_MEDIA_PATH', 'bootstrap/images/');
define('MAIN_MASTER', 'layouts/master_page');
define('LAYOUT_LOGIN', 'layouts/login/default');
define('CSS_PATH','css/');
define('CSS_PATH_BOOTSTRAP', 'bootstrap/css/');
define('JS_PATH_BOOTSTRAP', 'bootstrap/js/');
define('JS_PATH', 'js/');
define('IMAGES_PATH', 'images/');
define('IMAGES_PATH_BOOTSTRAP', 'bootstrap/images/');
define('FONT_PATH', 'bootstrap/font/');


/**
 * Format & prefix
 */
define('CONTACT_DIGIT', '000000');
// setting
define('SUPERADMIN', 'SuperAdmin');
define('ADMIN', 'Admin');
define('ACCOUNTAIN', 'Accountain');
define('TELLER', 'Teller');

/* End of file constants.php */
/* Location: ./application/config/constants.php */
/**
 * Format & prefix
 */
define('APPROVED', "2");
define('DISBURSED', "7");


/* End of file constants.php */
/* Location: ./application/config/constants.php */