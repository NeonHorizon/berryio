<?
/*------------------------------------------------------------------------------
  BerryIO GPIO Set Mode Command
------------------------------------------------------------------------------*/

// Load the GPIO functions
require_once(FUNCTIONS.'gpio.php');

// Check the args
if(count($args) != 2)
{
  $content .= usage('Please provide pin and mode information');
  return FALSE;
}

// Set the GPIO Mode
if(gpio_set_mode($args[0], $args[1]) === FALSE)
{
  $content .= message('ERROR: Cannot set GPIO pin "'.$args[0].'" into mode "'.$args[1].'"', 'gpio_status');
  return FALSE;
}

$content .= go_to('gpio_status');
