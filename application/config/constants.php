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

define('APPTITLE','On Show App  ');
define('APPTITLEDEMO','On Show App  ');
define('ADMINAPPTITLE','On Show App Admin');
define('ROOTPATH','//home//chachinn//public_html//');
define('UPLOADPATH','//home//chachinn//public_html//uploads//');
define('COMPANY','On Show App ');
define('ADMINEMAIL','support@onshowapp.co.za');
define('WELCOMEEMAIL','donotreply@onshowapp.co.za');
define('SUPPORTEMAIL','support@onshowapp.co.za');
define('WEBSITEEMAIL','info@onshowapp.co.za');
define('DONOTREPLYEMAIL','donotreply@onshowapp.co.za');
define('NEWSLETTEREMAIL','newsletter@onshowapp.co.za');


define('EXTENSIONS1','doc|docx|pdf|xls|xlsx|txt');                                                

define('SUPERADMIN',1);
define('ADMIN',2);
define('STAFF',3);



/* End of file constants.php */
/* Location: ./application/config/constants.php */