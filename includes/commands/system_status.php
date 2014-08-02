<?
/*------------------------------------------------------------------------------
  BerryIO System Status Command
------------------------------------------------------------------------------*/

// Run the status commands which represent the Pi's resources
$content .= command('cpu_status');
$content .= command('memory_status');
$content .= command('disk_status');
$content .= command('board_status');
$content .= view('pages/system_status');

// Set the title last to override any previous set titles
$title = 'System Status';
