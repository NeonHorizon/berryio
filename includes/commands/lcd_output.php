<?
/*------------------------------------------------------------------------------
  BerryIO LCD Output String Command
------------------------------------------------------------------------------*/

$title = 'LCD Control';

// Load the LCD functions
require_once(FUNCTIONS.'lcd.php');

// If we have a clear command do that first
if(isset($_POST['clear']))
  if(lcd_command('clear') === FALSE)
  {
    $content .= message('ERROR: Cannot clear the LCD', 'lcd_status');
    return FALSE;
  }

// If its a post, use that as the args
if(isset($_POST['output']))
  $args[] = $_POST['output'];

// Check the args
if(count($args) < 1)
{
  $content .= usage('Please include the string you wish to send');
  return FALSE;
}

// Execute the command
if(lcd_output(implode(' ', $args)) === FALSE)
{
  $content .= message('ERROR: Cannot send the string "'.implode(' ', $args).'" to the LCD, is it initialised?', 'lcd_status');
  return FALSE;
}

if(EXEC_MODE == 'html')
  $content .= go_to('lcd_status');
else
  $content .= message('String "'.implode(' ', $args).'" sent to the LCD', 'lcd_status');
