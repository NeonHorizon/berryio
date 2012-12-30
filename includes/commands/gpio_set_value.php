<?
/*------------------------------------------------------------------------------
  BerryIO GPIO Set Value Command
------------------------------------------------------------------------------*/

// Load the GPIO functions
require_once(FUNCTIONS.'gpio.php');

// Set the GPIO Mode
if(count($args) != 2)
  $content .= usage('Please provide pin and value information');
elseif(!gpio_set_value($args[0], $args[1]))
  $content .= message('ERROR: Cannot set GPIO pin "'.$args[0].'" to value "'.$args[1].'" (is it in out mode?)', 'gpio_status');
else
  $content .= go_to('gpio_status');
