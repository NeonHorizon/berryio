<?
/*------------------------------------------------------------------------------
  BerryIO GPIO Get Values Command
  This command would not normally be used by a user and is there to support
  refreshing on the web interface
------------------------------------------------------------------------------*/

// Load the GPIO functions
require_once(FUNCTIONS.'gpio.php');

// Get the GPIO values and output them
foreach(gpio_get_values() as $pin => $value)
  echo $pin.':'.$value.',';

// Don't render the HTML page as this doesn't display one it just outputs values
exit();
