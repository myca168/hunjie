<?php
// Document root folder
define('DOCROOT', dirname(__FILE__));
// Root folder of whole system
define('ROOT', dirname(DOCROOT));
// Define path to application directory
define('APPLICATION_PATH', realpath(ROOT . '/application'));
// Define path to library directory
define('LIBRARY_PATH', realpath(ROOT . '/library'));
// Define application environment
define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

if ( APPLICATION_ENV != 'production' ) {
    // we will write more detail log if we have DEBUG set to true
    define('DEBUG', true);
} else {
    define('DEBUG', false);
}
// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
	 LIBRARY_PATH,
   	 APPLICATION_PATH,
    get_include_path(),
)));

// Zend_Application
require_once 'Zend/Application.php';
// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV, 
    APPLICATION_PATH . '/configs/application.ini'
);
$application->bootstrap();
