<?
/*------------------------------------------------------------------------------
  BerryIO Web Bootstrap
------------------------------------------------------------------------------*/
$EXEC_MODE = 'html';
require_once('/etc/berryio/paths.php');
require_once(BASE.'/includes/configs/paths.php');


/*------------------------------------------------------------------------------
  Load the commonly used config, settings and functions
------------------------------------------------------------------------------*/
require_once(CONFIGS.'common.php');
require_once(SETTINGS.'common.php');
require_once(FUNCTIONS.'common.php');
require_once(FUNCTIONS.'html.php');
settings('menu', 2);


/*------------------------------------------------------------------------------
  Get the command and run it
------------------------------------------------------------------------------*/
$argv = explode('/', rtrim($_SERVER["SERVER_NAME"].$_SERVER['PATH_INFO'], '/'));
$args = $argv;
$EXEC = array_shift($args).($_SERVER['SERVER_PORT'] != 80 ? ':'.$_SERVER['SERVER_PORT'] : '');

// Show welcome by default
if($args[0] == '')
  go_to('welcome');

// Presume its OK unless stated otherwise
$GLOBALS['SUCCESS'] = TRUE;

// Run command
$page['content'] = call_user_func_array('command', $args);


/*------------------------------------------------------------------------------
  Output the page
------------------------------------------------------------------------------*/
$page['selected'] = $argv[1];
echo view('layout/common', $page);
