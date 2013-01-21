<?
/*------------------------------------------------------------------------------
  BerryIO GPIO System Status Command
------------------------------------------------------------------------------*/

// Done last to overide any titles previously set
$title = 'System Status';

// Run the status commands which represent the Pi's resources
$cpu_status    = command('cpu_status');
$memory_status = command('memory_status');
$disk_status   = command('disk_status');
$board_info    = command('board_info');


$content = $cpu_status['content'].$memory_status['content'].$disk_status['content'].$board_info['content'];
