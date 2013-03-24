<?
/*------------------------------------------------------------------------------
  BerryIO About Command
------------------------------------------------------------------------------*/

$title = NAME.' Version';

// Load the version information
require_once(CONFIGS.'version.php');

// Display about information
$content .= view('pages/version');
