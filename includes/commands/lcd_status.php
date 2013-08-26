<?
/*------------------------------------------------------------------------------
  BerryIO LCD Status Command
------------------------------------------------------------------------------*/

$title = 'LCD Control';

// Load the LCD functions
require_once(FUNCTIONS.'lcd.php');

// Display status page
$GLOBALS['JAVASCRIPT'][] = 'getScrollY';
$content .= view('pages/lcd_status');
