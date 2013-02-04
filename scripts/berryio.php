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

// Show the help command by default
if(count($args) < 1)
  $args[0] = 'help';

// Check for commands which need to be run as root
if(posix_getuid() != 0 && in_array($args[0], $GLOBALS['NEED_SUDO']))
{
  $page['content'] = message('ERROR: '.basename($exec).' '.$args[0].' must be run as root'.PHP_EOL.'Try: sudo '.basename($exec).' '.implode(' ', $args));
  $GLOBALS['SUCCESS'] = FALSE;
}
else
{
  // Presume its OK unless stated otherwise
  $GLOBALS['SUCCESS'] = TRUE;

  // Run command
  $page['content'] = call_user_func_array('command', $args);
}

/*------------------------------------------------------------------------------
  Output the page
------------------------------------------------------------------------------*/
echo view('layout/common', $page);

exit(!$GLOBALS['SUCCESS'] + 0);
