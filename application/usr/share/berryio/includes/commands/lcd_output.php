<?
/*------------------------------------------------------------------------------
  BerryIO LCD Output String Command
------------------------------------------------------------------------------*/

// Load the LCD functions
require_once(FUNCTIONS.'lcd.php');

// If we have a clear command do that first
if(isset($_POST['clear']))
  lcd_command('clear');

// If its a post, use that as the args
if(isset($_POST['output']))
  $args[] = $_POST['output'];

// Execute the command
if(count($args) < 1)
  $content .= usage('Please include the string you wish to send');
elseif(!lcd_output(implode(' ', $args)))
  $content .= message('ERROR: Cannot send the string "'.implode(' ', $args).'" to the LCD', 'lcd_status');
elseif(EXEC_MODE == 'html')
  $content .= go_to('lcd_status');
else
  $content .= message('String "'.implode(' ', $args).'" sent to the LCD', 'lcd_status');
