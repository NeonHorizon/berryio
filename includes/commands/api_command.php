<?
/*------------------------------------------------------------------------------
  BerryIO API  Command
------------------------------------------------------------------------------*/

// Switch into API mode
$http = $GLOBALS['EXEC_MODE'] == 'html';
$GLOBALS['EXEC_MODE'] = 'api';

// Check the args
if(count($args) < 1)
{
  $content .= usage('Missing Command', 'api');
  return FALSE;
}

// Load the API config
require_once(CONFIGS.'api.php');

// Check the command is valid
if(!in_array($args[0], $GLOBALS['API_COMMANDS']))
{
  $content .= usage('Unknown Command', 'api');
  return FALSE;
}

// Check for commands which need to be run as root
if(!$http && posix_getuid() != 0 && in_array($args[0], $GLOBALS['NEED_SUDO']))
{
  $content .= message('ERROR: '.$GLOBALS['EXEC'].' '.$args[0].' must be run as root');
  return FALSE;
}

$content .= call_user_func_array('command', $args);

if($content == '')
  $content .= $GLOBALS['SUCCESS'] ? message('OK:') : message('ERROR: An unknown error occured');


