<?
/*------------------------------------------------------------------------------
  BerryIO Initialise LCD Command
------------------------------------------------------------------------------*/

// Load the LCD functions
require_once(FUNCTIONS.'lcd.php');

// Initialise the LCD
if(!lcd_initialise())
  $content .= message('ERROR: Cannot initialise the LCD');
else
  $content .= go_to('lcd_status');
