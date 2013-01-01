<?
/*------------------------------------------------------------------------------
  BerryIO Memory Status Command
------------------------------------------------------------------------------*/

// Load the memory functions
require_once(FUNCTIONS.'memory.php');

// Get the memory location details
$page['memory_locations'] = memory_list();

// Display status page
require_once(FUNCTIONS.'graph.php');
$content .= view('pages/memory_status', $page);
