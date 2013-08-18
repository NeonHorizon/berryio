<?
/*------------------------------------------------------------------------------
  BerryIO Camera Show Command
------------------------------------------------------------------------------*/

$title = 'Camera Control';

// Load the Camera functions
require_once(FUNCTIONS.'camera.php');

// Check the args
if(count($args) != 2)
{
  $content .= usage('Please provide both type (image or video) and the filename');
  return FALSE;
}

// Check the args
if(camera_delete($args[0], $args[1]) === FALSE)
{
  // Find out the command line executable (if this is not running on the command line we are going to need to guess)
  $berryio = $GLOBALS['EXEC_MODE'] != 'cli' ? 'berryio' : $GLOBALS['EXEC'];
  $content .= message('ERROR: Could not delete the file.'.PHP_EOL.'If it definitely exists try sudo '.$berryio.' '.$args[0].' '.$args[1], 'camera_status');
  return FALSE;
}

if($GLOBALS['EXEC_MODE'] != 'api')
  $content .= go_to('camera_status');