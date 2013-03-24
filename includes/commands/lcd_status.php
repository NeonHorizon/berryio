<?
/*------------------------------------------------------------------------------
  BerryIO LCD Status Command
------------------------------------------------------------------------------*/

$title = 'LCD Control';

global $exec;
$page['berryio'] = EXEC_MODE == 'cli' ? basename($exec) : $exec;

// Display status page
$GLOBALS['JAVASCRIPT'][] = 'getScrollY';
$content .= view('pages/lcd_status', $page);
