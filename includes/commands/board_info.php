<?
/*------------------------------------------------------------------------------
  BerryIO CPU Status Command
------------------------------------------------------------------------------*/

// Load the cpu functions
require_once(FUNCTIONS.'board.php');

// Get the disk partition details
$page['information'] = system_get_revision();

// Display status page
$content .= view('pages/board_info', $page);

