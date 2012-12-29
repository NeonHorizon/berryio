<?
/*------------------------------------------------------------------------------
  BerryIO Network Status Command
------------------------------------------------------------------------------*/

// Load the network functions
require_once(FUNCTIONS.'network.php');

// Get the network device details
$page['network_interfaces'] = network_list();
unset($page['network_interfaces']['lo']);  // Ignore the loopback device

// Display status page
require_once(FUNCTIONS.'graph.php');
$content .= view('pages/network_status', $page);
