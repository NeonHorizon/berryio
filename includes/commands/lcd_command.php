<?
/*------------------------------------------------------------------------------
  BerryIO LCD Send Command
------------------------------------------------------------------------------*/

// Load the LCD functions
require_once(FUNCTIONS.'lcd.php');

// Execute the command
if(count($args) < 1)
  $content .= usage('Please include the command you wish to run');
elseif(!call_user_func_array('lcd_command', $args))
  $content .= message('ERROR: Cannot execute '.(count($args) > 1 ? 'some or all of' : '').' the LCD command'.(count($args) > 1 ? 's' : '').' '.implode(', ', $args).', is the LCD initialised, are the commands valid?', 'lcd_status');
elseif(EXEC_MODE == 'html')
  $content .= go_to('lcd_status');
else
  $content .= message('Command'.(count($args) > 1 ? 's' : '').' '.implode(', ', $args).' sent to the LCD', 'lcd_status');
