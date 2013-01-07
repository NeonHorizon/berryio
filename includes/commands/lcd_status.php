<?
/*------------------------------------------------------------------------------
  BerryIO LCD Status Command
------------------------------------------------------------------------------*/

// Load the LCD settings and config
settings('lcd');
require_once(CONFIGS.'lcd.php');

// Make a note of any passed values
$page['args'] = $args;

// Display status page
$GLOBALS['JAVASCRIPT'][] = 'getScrollY';
$content .= view('pages/lcd_status', $page);
