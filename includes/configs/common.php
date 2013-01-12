<?
/*------------------------------------------------------------------------------
  BerryIO Common Configuration
------------------------------------------------------------------------------*/

// Real name of application
define('REAL_NAME', 'BerryIO');

// Commands which do not need sudo
$GLOBALS['NO_SUDO'] = array('help', 'about', 'check_version', 'changelog', 'disk_status', 'memory_status', 'email_status', 'gpio_status', 'lcd_status');

// Storage for javascripts which need displaying/executing
$GLOBALS['JAVASCRIPT_RUN'] = array();
$GLOBALS['JAVASCRIPT'] = array();
