#!/usr/bin/php
<?
/*------------------------------------------------------------------------------
 BerryIO Command Line Bootstrap
------------------------------------------------------------------------------*/
define('EXEC_MODE', 'cli');
require_once('/etc/berryio/paths.php');
require_once(BASE.'/includes/configs/paths.php');


/*------------------------------------------------------------------------------
  Load the commonly used config, settings and functions
------------------------------------------------------------------------------*/
require_once(CONFIGS.'common.php');
require_once(SETTINGS.'common.php');
require_once(FUNCTIONS.'common.php');


/*------------------------------------------------------------------------------
  Check theres a requested controller and load it checking for root if required
------------------------------------------------------------------------------*/
$args = $argv;
$exec = array_shift($args);
if(count($args) < 1)
  // Show usage by default
  $page['content'] = usage();
elseif(posix_getuid() != 0 && !in_array($args[0], $GLOBALS['NO_SUDO']))
  // Must be run as root!
  $page['content'] = message('ERROR: Some '.basename($exec).' commands must be run as root'.PHP_EOL.'Try: sudo '.basename($exec).' '.implode(' ', $args));
else
  // Run command
  $page['content'] = call_user_func_array('command', $args);


/*------------------------------------------------------------------------------
  Output the page
------------------------------------------------------------------------------*/
echo view('layout/common', $page);
