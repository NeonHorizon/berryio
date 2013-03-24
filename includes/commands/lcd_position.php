<?
/*------------------------------------------------------------------------------
  BerryIO LCD Position Command
------------------------------------------------------------------------------*/

$title = 'LCD Control';

// Load the LCD functions
require_once(FUNCTIONS.'lcd.php');

// Check the args
if(count($args) < 1 || count($args) > 2)
{
  $content .= usage('Please include the position of the cursor');
  return FALSE;
}

// Execute the command
if(call_user_func_array('lcd_position', $args) === FALSE)
{
  $content .= message('ERROR: Cannot position the LCD cursor, is the LCD initialised, are the positions valid?', 'lcd_status');
  return FALSE;
}

if(EXEC_MODE == 'html')
  $content .= go_to('lcd_status');
else
  $content .= message('LCD cursor positioned to x='.$args[0].' y='.(isset($args[1]) ? $args[1] : 0), 'lcd_status');
