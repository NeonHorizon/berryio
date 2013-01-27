<?
/*------------------------------------------------------------------------------
  BerryIO Board Status Command
------------------------------------------------------------------------------*/

$title = 'Board Status';

// Load the board functions
require_once(FUNCTIONS.'board.php');

// Get the board details
$page['information'] = board_info();

// Display status page
$content .= view('pages/board_status', $page);
