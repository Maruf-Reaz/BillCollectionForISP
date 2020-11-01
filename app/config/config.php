<?php
//DB params
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '123456');
define('DB_NAME', 'optimus_isp_db');


defined("DS") ? null : define('DS', DIRECTORY_SEPARATOR);
//App root

define('APPROOT', dirname(dirname(__FILE__)));
define('SITE_ROOT', dirname(dirname(dirname(__FILE__))) . DS . 'public');
defined("VENDOR_PATH") ? null : define('VENDOR_PATH', '/vendor');

//Url root
//define('URLROOT', "http://localhost");

define('URLROOT', "http://optimus-isp");

//Site name
define('SITENAME', 'EMS MVC V1');
define('APP_VERSION', '1.0.0');