<?
/*------------------------------------------------------------------------------
  BerryIO LCD Send Command
------------------------------------------------------------------------------*/

// Load the LCD functions
require_once(FUNCTIONS.'lcd.php');

// Check the args
if(count($args) < 1)
{
  $content .= usage('Please include the command you wish to run');
  return FALSE;
}

// Execute the command
if(call_user_func_array('lcd_command', $args) === FALSE)
{
  $content .= message('ERROR: Cannot execute '.(count($args) > 1 ? 'some or all of' : '').' the LCD command'.(count($args) > 1 ? 's' : '').' '.implode(', ', $args).', is the LCD initialised, are the commands valid?', 'lcd_status');
  return FALSE;
}

if(EXEC_MODE == 'html')
  $content .= go_to('lcd_status');
else
  $content .= message('Command'.(count($args) > 1 ? 's' : '').' '.implode(', ', $args).' sent to the LCD', 'lcd_status');
