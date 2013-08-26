<?
/*------------------------------------------------------------------------------
  BerryIO Camera Take Image
------------------------------------------------------------------------------*/

$title = 'Camera Control';

// Load the Camera functions
require_once(FUNCTIONS.'camera.php');

// Convert arguments to options
$this_option = '';
$this_value = '';
foreach($args as $this_arg)
  // If it starts with a - and its not a negative number then its an option
  if(strlen($this_arg) > 1 && $this_arg[0] == '-' && !is_numeric(substr($this_arg, 1)))
  {
    // Store previous option
    $options[$this_option] = $this_value;

    // Start new one
    $this_option = substr($this_arg, 1);
    $this_value = '';
  }
  else
    $this_value .= $this_arg;
$options[$this_option] = $this_value;
unset($options['']);

// Take the image
if(($image = camera_take_image($options)) === FALSE)
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
