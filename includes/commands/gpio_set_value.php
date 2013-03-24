<?
/*------------------------------------------------------------------------------
  BerryIO GPIO Set Value Command
------------------------------------------------------------------------------*/

$title = 'GPIO Control';

// Load the GPIO functions
require_once(FUNCTIONS.'gpio.php');

// Check the args
if(count($args) != 2)
{
  $content .= usage('Please provide pin and value information');
  return FALSE;
}

// Set the GPIO value
if(gpio_set_value($args[0], $args[1]) === FALSE)
{
  $content .= message('ERROR: Cannot set GPIO pin "'.$args[0].'" to value "'.$args[1].'" (is it in out mode?)', 'gpio_status');
  return FALSE;
}

if($GLOBALS['EXEC_MODE'] != 'api')
  $content .= go_to('gpio_status');
