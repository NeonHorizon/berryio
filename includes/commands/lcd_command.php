<?
/*------------------------------------------------------------------------------
  BerryIO LCD Send Command
------------------------------------------------------------------------------*/

$title = 'LCD Control';

// Load the LCD functions
require_once(FUNCTIONS.'lcd.php');

// Check for help
if(isset($args[0]) && $args[0] == 'help' )
{
  $content .= usage('', 'lcd_command');
  return;
}

// Check the args
if(count($args) < 1)
{
  $content .= usage('Please include the LCD command you wish to run', 'lcd_command');
  return FALSE;
}

// Execute the command
if(call_user_func_array('lcd_command', $args) === FALSE)
{
  if(count($args) > 1)
    $content .= message('ERROR: Cannot execute some or all of the LCD commands: '.implode(', ', $args).'. Is the LCD initialised, are the commands all valid?', 'lcd_status');
  else
    $content .= message('ERROR: Cannot execute the LCD command '.implode(', ', $args).', is the LCD initialised, is the command valid?', 'lcd_status');
  return FALSE;
}

if(EXEC_MODE == 'html')
  $content .= go_to('lcd_status');
else
  $content .= message('Command'.(count($args) > 1 ? 's' : '').' '.implode(', ', $args).' sent to the LCD', 'lcd_status');
