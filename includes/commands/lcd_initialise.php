<?
/*------------------------------------------------------------------------------
  BerryIO Initialise LCD Command
------------------------------------------------------------------------------*/

// Load the SPI functions
require_once(FUNCTIONS.'lcd.php');

// Set the SPI Value
if(!lcd_initialise())
  $content .= message('ERROR: Cannot initialise the LCD');
else
  $content .= go_to('lcd_status');
