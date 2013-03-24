<?
/*------------------------------------------------------------------------------
  BerryIO LCD Status Command
------------------------------------------------------------------------------*/

$title = 'LCD Control';

// Display status page
$GLOBALS['JAVASCRIPT'][] = 'getScrollY';
$content .= view('pages/lcd_status');
