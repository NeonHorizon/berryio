<?
/*------------------------------------------------------------------------------
  BerryIO Camera Take Image
------------------------------------------------------------------------------*/

$title = 'Camera Control';

// Load the Camera functions
require_once(FUNCTIONS.'camera.php');

// Set the GPIO value
if(($image = camera_take_image()) === FALSE)
{
  // Find out the command line executable (if this is not running on the command line we are going to need to guess)
  $berryio = $GLOBALS['EXEC_MODE'] != 'cli' ? 'berryio' : $GLOBALS['EXEC'];

  $content .= message('ERROR: Unable to take an image, have you run sudo '.$berryio.' camera_setup?', 'camera_status');
  return FALSE;
}

if($GLOBALS['EXEC_MODE'] != 'api')
  $content .= go_to('camera_status');
else
  $content = 'OK:'.PHP_EOL.$image;
