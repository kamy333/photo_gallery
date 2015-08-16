<?php
//require_once("functions.php");
//require_once("session.php");
//require_once("database.php");
//require_once("user.php");



        // Define the core paths
        // Define them as absolute paths to make sure that require_once works as expected

        // DIRECTORY_SEPARATOR is a PHP pre-defined constant
        // (\ for Windows, / for Unix)
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

$server_name = $_SERVER['SERVER_NAME'];
$server_local = "localhost";
$server_phpstorm = "PhpStorm 8.0.3";
$server_phpstorm3 = "PhpStorm 9.0";




//
//echo $server_name."<br>";
//echo $server_local."<br>";
//echo $server_phpstorm."<br>";
//
//if ($server_name === $server_local) {echo 'true';}else {echo 'false';}

    if ($server_name === $server_local || $server_name === $server_phpstorm || $server_name === $server_phpstorm3) {
    defined('SITE_ROOT') ? null : define('SITE_ROOT', 'C:' . DS . 'xampp' . DS . 'htdocs' . DS . 'Kamy_ByB' . DS . 'Kamy_Beyond_Basics');
    } else {
    defined('SITE_ROOT') ? null : define('SITE_ROOT', DS . 'home' . DS . 'www' . DS . '1fe720ae68582bc8524d72e4d0afafcb' . DS . 'web');

}




defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT.DS.'includes');


                // load config file first
//require_once(LIB_PATH.DS.'config.php');

            // load basic functions next so that everything after can use them
require_once(LIB_PATH.DS.'functions.php');

                // load core objects
require_once(LIB_PATH.DS.'session.php');
require_once(LIB_PATH.DS.'functions_after_session.php');

require_once(LIB_PATH.DS.'database.php');
require_once(LIB_PATH.DS.'database_object.php');
require_once(LIB_PATH.DS.'pagination.php');

            // load database-related classes
require_once(LIB_PATH.DS.'user.php');
require_once(LIB_PATH.DS.'photograph.php');
require_once(LIB_PATH.DS.'comment.php');
require_once(LIB_PATH.DS.'links.php');


?>