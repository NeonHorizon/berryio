<?
/*------------------------------------------------------------------------------
  BerryIO Disk Status Command
------------------------------------------------------------------------------*/

$title = 'Disk Status';

// Load the disk functions
require_once(FUNCTIONS.'disk.php');

// Load the system settings
settings('system', 1);

// Get the disk partition details
if(($page['disk_partitions'] = disk_list()) === FALSE)
{
  $content .= message('ERROR: Unable retrieve information on your disks');
  return FALSE;
}

// Display status page
$GLOBALS['JAVASCRIPT']['common'] = 'common';
$GLOBALS['JAVASCRIPT']['updateDisk'] = 'updateDisk';
$GLOBALS['JAVASCRIPT_DATA']['updateDisk'] = $page;
require_once(FUNCTIONS.'graph.php');
$content .= view('pages/disk_status', $page);
