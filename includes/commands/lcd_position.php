<?
/*------------------------------------------------------------------------------
  BerryIO LCD Position Command
------------------------------------------------------------------------------*/

// Load the LCD functions
require_once(FUNCTIONS.'lcd.php');

// Execute the command
if(count($args) < 1 || count($args) > 2)
  $content .= usage('Please include the position of the cursor');
elseif(!call_user_func_array('lcd_position', $args))
  $content .= message('ERROR: Cannot position the LCD cursor, is the LCD initialised, are the positions valid?', 'lcd_status');
elseif(EXEC_MODE == 'html')
  $content .= go_to('lcd_status');
else
  $content .= message('LCD cursor positioned to x='.$args[0].' y='.(isset($args[1]) ? $args[1] : 0), 'lcd_status');
