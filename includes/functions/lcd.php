<?
/*------------------------------------------------------------------------------
  BerryIO LCD Functions
------------------------------------------------------------------------------*/

/*------------------------------------------------------------------------------
  Load the LCD settings and config and functions we need
------------------------------------------------------------------------------*/
settings('lcd', '2');
require_once(CONFIGS.'lcd.php');
require_once(FUNCTIONS.'gpio.php');


/*----------------------------------------------------------------------------
  Prepares the LCD for use
----------------------------------------------------------------------------*/
function lcd_initialise()
{
  // Set the required GPIO pins to output
  if( !gpio_set_mode(LCD_RS_GPIO, 'out') ||
      !gpio_set_mode(LCD_ES_GPIO, 'out') ||
      !gpio_set_mode(LCD_D4_GPIO, 'out') ||
      !gpio_set_mode(LCD_D5_GPIO, 'out') ||
      !gpio_set_mode(LCD_D6_GPIO, 'out') ||
      !gpio_set_mode(LCD_D7_GPIO, 'out') )
    return FALSE;

  // If we are in 8 bit mode set those also
  if(LCD_BITS == 8)
    if( !gpio_set_mode(LCD_D0_GPIO, 'out') ||
        !gpio_set_mode(LCD_D1_GPIO, 'out') ||
        !gpio_set_mode(LCD_D2_GPIO, 'out') ||
        !gpio_set_mode(LCD_D3_GPIO, 'out') )
      return FALSE;

  // Switch into 4 bit mode if applicable
  if(LCD_BITS == 4)
    if( !_lcd_set_mode(FALSE) || // Go into command mode
        !_lcd_send(0b00110011) ||
        !_lcd_send(0b00110010) )
      return FALSE;

  // Reset LCD
  if(!lcd_command('2_line_5x8', 'on_no_cursor', 'clear', 'text_forwards'))
    return FALSE;

  return TRUE;
}


/*----------------------------------------------------------------------------
  Outputs a string to the screen
----------------------------------------------------------------------------*/
function lcd_output($string = '')
{
  // Go into character mode
  if(!_lcd_set_mode(TRUE)) return FALSE;

  // Send string
  $line = 1;
  for($i = 0; $i < strlen($string); $i++)
    if($string[$i] == "\n")
    {
      if(!lcd_position(0, $line++)) return FALSE;
      if(!_lcd_set_mode(TRUE)) return FALSE; // Go back into character mode
    }
    elseif($string[$i] != "\r")
      if(!_lcd_send(ord($string[$i]))) return FALSE;

  return TRUE;
}


/*----------------------------------------------------------------------------
  Positions the cursor
----------------------------------------------------------------------------*/
function lcd_position($x = 0, $y = 0)
{
  // Check for nonsense
  if(!is_numeric($x) || !is_numeric($y) || $x < 0 || $y < 0 || $x >= LCD_COLS || $y >= LCD_ROWS) return FALSE;

  // Calculate Y
  if($y == 1)
    $x += 64;
  elseif($y == 2)
    $x += 20;
  elseif($y == 3)
    $x += 84;

  // Check its within range
  if($x < 0 || $x > 0b01111111) return FALSE;

  if(!_lcd_set_mode(FALSE) ||
     !_lcd_send($x + 0b10000000))
    return FALSE;

  return TRUE;
}


/*----------------------------------------------------------------------------
  Executes a single or multiple commands
----------------------------------------------------------------------------*/
function lcd_command()
{
  // Get the commands
  $commmands = func_get_args();

  // Check we actually have some
  if(count($commmands) < 1) return FALSE;

  // Go into command mode
  if(!_lcd_set_mode(FALSE)) return FALSE;

  // Execute commands
  GLOBAL $LCD_COMMANDS;
  foreach($commmands as $command)
  {
    // Check command is valid
    if(!isset($LCD_COMMANDS[$command])) return FALSE;

    // Send the command
    if(!_lcd_send($LCD_COMMANDS[$command], 0)) return FALSE;

    if($command == 'clear')
      time_nanosleep(0, LCD_TIMING_CLEAR);
  }

  return TRUE;
}


/*----------------------------------------------------------------------------
  Send a direct value to the LCD
----------------------------------------------------------------------------*/
function _lcd_send($value)
{
  // Check for nonsense
  if(!is_numeric($value) || $value < 0 || $value > 255) return FALSE;

  // Set High Block
  if( !gpio_set_value(LCD_D4_GPIO, ($value & 0b00010000) > 0 ? 1 : 0) ||
      !gpio_set_value(LCD_D5_GPIO, ($value & 0b00100000) > 0 ? 1 : 0) ||
      !gpio_set_value(LCD_D6_GPIO, ($value & 0b01000000) > 0 ? 1 : 0) ||
      !gpio_set_value(LCD_D7_GPIO, ($value & 0b10000000) > 0 ? 1 : 0) )
    return FALSE;

  if(LCD_BITS == 4)
  {
    // Send block
    if( !gpio_set_value(LCD_ES_GPIO, 1)) return FALSE;
    time_nanosleep(0, LCD_TIMING_TW);
    if( !gpio_set_value(LCD_ES_GPIO, 0)) return FALSE;
    time_nanosleep(0, LCD_TIMING_TH2);
  }

  // Set Low Block
  if( !gpio_set_value(LCD_BITS == 4 ? LCD_D4_GPIO : LCD_D0_GPIO, ($value & 0b00000001) > 0 ? 1 : 0) ||
      !gpio_set_value(LCD_BITS == 4 ? LCD_D5_GPIO : LCD_D1_GPIO, ($value & 0b00000010) > 0 ? 1 : 0) ||
      !gpio_set_value(LCD_BITS == 4 ? LCD_D6_GPIO : LCD_D2_GPIO, ($value & 0b00000100) > 0 ? 1 : 0) ||
      !gpio_set_value(LCD_BITS == 4 ? LCD_D7_GPIO : LCD_D3_GPIO, ($value & 0b00001000) > 0 ? 1 : 0) )
    return FALSE;

  // Send block
  if( !gpio_set_value(LCD_ES_GPIO, 1)) return FALSE;
  time_nanosleep(0, LCD_TIMING_TW);
  if( !gpio_set_value(LCD_ES_GPIO, 0)) return FALSE;
  time_nanosleep(0, LCD_TIMING_TH2);

  return TRUE;
}


/*----------------------------------------------------------------------------
  Switch between character mode and command mode
----------------------------------------------------------------------------*/
function _lcd_set_mode($character_mode)
{
  // Make sure the enable line is low before we start
  if(!gpio_set_value(LCD_ES_GPIO, 0)) return FALSE;

  // Set Register Select to the correct mode mode
  if(!gpio_set_value(LCD_RS_GPIO, $character_mode ? 1 : 0)) return FALSE;
  time_nanosleep(0, LCD_TIMING_TSU1);

  return TRUE;
}
