<?
/*------------------------------------------------------------------------------
  BerryIO GPIO Settings
------------------------------------------------------------------------------*/

// Settings for original revision 1 board
//$GLOBALS['GPIO_PINS'] = array(0, 1, 4, 7, 8, 9, 10, 11, 14, 15, 17, 18, 21, 22, 23, 24, 25);

// Settings for revision 2 board (including 512MB version)
$GLOBALS['GPIO_PINS'] = array(2, 3, 4, 7, 8, 9, 10, 11, 14, 15, 17, 18, 22, 23, 24, 25, 27);

// Extra GPIO Pins if you have fitted the optional P5 header on the revision 2 board
//$GLOBALS['GPIO_PINS'] += array(28, 29, 30, 31);

define('GPIO_PINS_PER_ROW', 6);  // Change to fit your browser window
define('GPIO_UPDATE_INTERVAL', 400);  // Update interval in ms
