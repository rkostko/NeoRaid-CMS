<?php
$GLOBALS['galleries'] = "galleries";
$GLOBALS['articles'] = "articles";
$GLOBALS['_width_'] = 150;
$GLOBALS['_height_'] = 100;
$GLOBALS['_quality_'] = 80;
$GLOBALS['_offset_'] = 0;
$GLOBALS['_count_'] = 20;
$GLOBALS['_slider_width_'] = 150;
$GLOBALS['_slider_height_'] = 100;

if (!defined("IN_PHP"))
{
	die();
}

/** 
 * if you want to run in demo mode, enable the macro below
 * if it runs in demo mode, it doesn't care what TARGET_PLATFORM is
 */
//define("DEMO_MODE", true);


/** target platform types
 *  this script runs for both database(mysql) and file system. 
 *  database is supposed to be mysql
 */
define ("DATABASE_PLATFORM", 0); // Don't edit
define ("FILE_SYSTEM_PLATFORM", 1); // Don't edit


/** 
 * choose target platform according to your needs 
 * it may be DATABASE_PLATFORM or FILE_SYSTEM_PLATFORM
 */
//define ("TARGET_PLATFORM", FILE_SYSTEM_PLATFORM);
define ("TARGET_PLATFORM", DATABASE_PLATFORM);

if (TARGET_PLATFORM == FILE_SYSTEM_PLATFORM)
{
	/**
 	* if FILE_SYSTEM_PLATFORM is selected as TARGET_PLATFORM,
 	* then assign root folder adress to FILE_ROOT macro
 	*/ 
	define("FILE_ROOT", $_SERVER['DOCUMENT_ROOT'].'/4x4cp'); 
}
else if (TARGET_PLATFORM == DATABASE_PLATFORM)
{
	/**
	 * if DATABASE_PLATFORM is selected as TARGET_PLATFORM,
	 * set the variables to connect database and 
	 * set the TREE_TABLE_PREFIX if you want to
	 * change the prefix of table name
	 */	
	// set database host 
	$dbHost = "localhost";
	//set database user name    
	$dbUsername = "noraid_noraid"; 
	// set password to connect to database	 
	$dbPassword = "lOA0hjMU";
	// set database name
	$dbName = "noraid_4x4";
	// set database table prefix 
	define ("TREE_TABLE_PREFIX", "tree");
}
else {
	die("No known target platform specified, in includes/config.php");
}


define ("SUCCESS", 1);  // Don't edit
define ("FAILED", -1);  // Don't edit
define ("FAILED_FILE_WITH_SAME_NAME_EXIST", -2); // Don't edit, it is only used in FILE_SYSTEM_PLATFORM

error_reporting(0); 
?>