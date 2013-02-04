<?
/*------------------------------------------------------------------------------
  BerryIO Initialise LCD Command
------------------------------------------------------------------------------*/

// Load the LCD functions
require_once(FUNCTIONS.'lcd.php');

// Initialise the LCD
if(lcd_initialise() === FALSE)
{
  $content .= message('ERROR: Cannot initialise the LCD', 'lcd_status');
  return FALSE;
}

$content .= go_to('lcd_status');
