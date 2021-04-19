<?php
// todo change constant
/**
 * Define site paths
 * Change these when upload or download project
*/
// App Root
$appRoot = dirname(__FILE__, 2);
define('APPROOT', $appRoot);

// URL Root
$urlRoot = 'http://localhost/my_projects/quick_post';
define('URLROOT', $urlRoot);

// Site Root
$siteName = 'Quick Post';
define('SITENAME', $siteName);

// App Version
$appVersion = '1.0.0';
define('APPVERSION', $appVersion);


/********************************************************************/
// DB Params
/**
 * These constants are for connect to DataBase
 * Change these when upload or download project
 */
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'qp_social_network');


