<?
/*------------------------------------------------------------------------------
  BerryIO LCD Configuration
------------------------------------------------------------------------------*/

// Command list
$GLOBALS['LCD_COMMANDS'] = array(

  // Clear display
  'clear'                => 0b00000001,  // Clear the screen

  // Return home
  'home'                 => 0b00000010,  // Send the cursor home

  // Entry mode set
  'text_reverse'         => 0b00000100,  // Type right to left
  'text_reverse_scroll'  => 0b00000101,  // Type right to left and scroll
  'text_forwards'        => 0b00000110,  // Type left to right
  'text_forwards_scroll' => 0b00000111,  // Type left to right and scroll

  // Display ON/OFF control
  'off'                  => 0b00001000,  // Turn off the display
  'on_no_cursor'         => 0b00001100,  // Turn on the display no cursor
  'on_cursor'            => 0b00001110,  // Turn on the display + cursor
  'on_blink_cursor'      => 0b00001111,  // Turn on the display + blink cursor

  // Cursor or display shift
  'cursor_left'          => 0b00010000,  // Move the cursor left
  'cursor_right'         => 0b00010100,  // Move the cursor right
  'scroll_left'          => 0b00011000,  // Scroll left
  'scroll_right'         => 0b00011100,  // Scroll right

  // Function set
  '1_line_5x8'           => 0b00100000,  // 4bit, 1 line, 5x8 font
  '1_line_5x11'          => 0b00100100,  // 4bit, 1 line, 5x11 font
  '2_line_5x8'           => 0b00101000,  // 4bit, 2 line, 5x8 font
  '2_line_5x11'          => 0b00101100,  // 4bit, 2 line, 5x11 font
);


// Timings in ns
define('LCD_TIMING_TSU1',   100);
define('LCD_TIMING_TW',     300);
define('LCD_TIMING_TH2',    10);
define('LCD_TIMING_CLEAR',  50000);
