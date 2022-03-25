<?php
defined('BASEPATH') or exit('No direct script access allowed');
defined('SHOW_DEBUG_BACKTRACE') or define('SHOW_DEBUG_BACKTRACE', TRUE);

defined('FILE_READ_MODE') or define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') or define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE') or define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE') or define('DIR_WRITE_MODE', 0755);

defined('FOPEN_READ') or define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE') or define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE') or define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE') or define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE') or define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE') or define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT') or define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT') or define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

defined('EXIT_SUCCESS') or define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR') or define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG') or define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE') or define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS') or define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') or define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT') or define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE') or define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN') or define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX') or define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/* Generic Constants */
define('BASE', APPPATH . 'controllers/Base.php');
define('EMPTY_STRING', "");

/* Custom Constants */
defined('NEWRELIC_API_URL') or define('NEWRELIC_API_URL',"https://api.newrelic.com/graphql");
defined('NEWRELIC_API_KEY') or define('NEWRELIC_API_KEY',"NRAK-MPGQ6RYBGCJWKVEP1X27MRF9KXY");
defined('NEWRELIC_ENTITY_GUID') or define('NEWRELIC_ENTITY_GUID',"MTM5MDQ0NXxBUE18QVBQTElDQVRJT058Mzg1MjQ3NjY3");
defined('NEWRELIC_ACCOUNT_ID') or define('NEWRELIC_ACCOUNT_ID',"1390445");