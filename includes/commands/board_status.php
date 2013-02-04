<?
/*------------------------------------------------------------------------------
  BerryIO Board Status Command
------------------------------------------------------------------------------*/

$title = 'Board Status';

// Load the board functions
require_once(FUNCTIONS.'board.php');

// Get the board details
if(($page['information'] = board_info()) === FALSE)
{
  $content .= message('ERROR: Unable retrieve information from your board');
  return FALSE;
}

// Display status page
$content .= view('pages/board_status', $page);
