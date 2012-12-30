<?
/*------------------------------------------------------------------------------
  BerryIO GPIO System Status Command
------------------------------------------------------------------------------*/

// Run the status commands which represent the Pi's resources
$content .= command('cpu_status');
$content .= command('memory_status');
$content .= command('disk_status');
