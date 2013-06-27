<?
/*------------------------------------------------------------------------------
  BerryIO Camera Show Command
------------------------------------------------------------------------------*/

$title = 'Camera Control';

// Load the Camera functions
require_once(FUNCTIONS.'camera.php');

// Check we are in not in CLI mode
if($GLOBALS['EXEC_MODE'] == 'cli')
{
  $content .= message('ERROR: You should not run this on the command line because it will dump raw binary data.'.PHP_EOL.'If this is actually what you require please use the API version of camera_show instead.');
  return FALSE;
}

// Check the args
if(count($args) != 2)
{
  $content .= usage('Please provide both type (image, image_thumbnail, video or video_thumbnail) and filename information');
  return FALSE;
}

// Check the args
if(camera_show($args[0], $args[1]) === FALSE)
{
  $content .= message('ERROR: Could not find the file or unknown type');
  return FALSE;
}
