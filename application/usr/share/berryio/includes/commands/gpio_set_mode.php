<?
/*------------------------------------------------------------------------------
  BerryIO GPIO Set Mode Command
------------------------------------------------------------------------------*/

// Load the GPIO functions
require_once(FUNCTIONS.'gpio.php');

// Set the GPIO Mode
if(count($args) != 2)
  $content .= usage('Please provide pin and mode information');
elseif(!gpio_set_mode($args[0], $args[1]))
  $content .= message('ERROR: Cannot set GPIO pin "'.$args[0].'" into mode "'.$args[1].'"', 'gpio_status');
else
  $content .= go_to('gpio_status');
