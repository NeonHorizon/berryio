<?
/*------------------------------------------------------------------------------
  BerryIO CPU Status Command
------------------------------------------------------------------------------*/

// Load the network functions
require_once(FUNCTIONS.'cpu.php');

// Get the disk partition details
$page['temperature'] = cpu_get_temp();
$page['speed'] = cpu_get_speed();
$page['voltage'] = cpu_get_volts();
$page['load_average'] = sys_getloadavg();

// Display status page
require_once(FUNCTIONS.'graph.php');
$content .= view('pages/cpu_status', $page);
