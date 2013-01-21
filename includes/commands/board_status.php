<?
/*------------------------------------------------------------------------------
  BerryIO Board Status Command
------------------------------------------------------------------------------*/

// Load the board functions
require_once(FUNCTIONS.'board.php');

// Get the disk partition details
$page['information'] = board_get_revision();

// Display status page
$content .= view('pages/board_status', $page);

