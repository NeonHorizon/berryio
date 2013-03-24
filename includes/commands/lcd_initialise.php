<?
/*------------------------------------------------------------------------------
  BerryIO Initialise LCD Command
------------------------------------------------------------------------------*/

$title = 'LCD Control';

// Load the LCD functions
require_once(FUNCTIONS.'lcd.php');

// Initialise the LCD
if(lcd_initialise() === FALSE)
{
  $content .= message('ERROR: Cannot initialise the LCD', 'lcd_status');
  return FALSE;
}

if($GLOBALS['EXEC_MODE'] == 'cli')
  $content .= message('LCD Initialised');
elseif($GLOBALS['EXEC_MODE'] != 'api')
  $content .= go_to('lcd_status');
