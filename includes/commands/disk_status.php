<?
/*------------------------------------------------------------------------------
  BerryIO Disk Status Command
------------------------------------------------------------------------------*/

$title = 'Disk Status';

// Load the disk functions
require_once(FUNCTIONS.'disk.php');

// Get the disk partition details
$page['disk_partitions'] = disk_list();

// Display status page
require_once(FUNCTIONS.'graph.php');
$content .= view('pages/disk_status', $page);
