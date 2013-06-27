<?
/*------------------------------------------------------------------------------
  BerryIO Camera Status Command
------------------------------------------------------------------------------*/

$title = 'Camera Control';

// Load the Camera functions
require_once(FUNCTIONS.'camera.php');

// Get the images
if(($page['images'] = camera_images()) === FALSE || ($page['videos'] = camera_videos()) === FALSE)
{
  // Find out the command line executable (if this is not running on the command line we are going to need to guess)
  $berryio = $GLOBALS['EXEC_MODE'] != 'cli' ? 'berryio' : $GLOBALS['EXEC'];

  $content .= message('ERROR: Unable to access the camera images/videos, have you run sudo '.$berryio.' camera_setup?');
  return FALSE;
}

// Display status page
$content .= view('pages/camera_status', $page);
