<?
/*------------------------------------------------------------------------------
  BerryIO Network Status Command
------------------------------------------------------------------------------*/

$title = 'Network Status';

// Load the network functions
require_once(FUNCTIONS.'network.php');

// Get the network device details
if(($page['network_interfaces'] = network_list()) === FALSE)
{
  $content .= message('ERROR: Unable retrieve networking information');
  return FALSE;
}

unset($page['network_interfaces']['lo']);  // Ignore the loopback device

// Display status page
require_once(FUNCTIONS.'graph.php');
$content .= view('pages/network_status', $page);
