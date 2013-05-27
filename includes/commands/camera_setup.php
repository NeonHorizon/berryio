<?
/*------------------------------------------------------------------------------
  BerryIO Camera Setup Command
------------------------------------------------------------------------------*/

$title = 'Camera Setup';

// Load the Camera functions
require_once(FUNCTIONS.'camera.php');

// Make sure we are in CLI mode
if($GLOBALS['EXEC_MODE'] != 'cli')
{
  // Find out the command line executable (if this is not running on the command line we are going to need to guess)
  $berryio = $GLOBALS['EXEC_MODE'] != 'cli' ? 'berryio' : $GLOBALS['EXEC'];
  $content = message('ERROR: Please run sudo '.$berryio.' camera_setup from the command line');
}
else
  camera_setup();
