<?
/*------------------------------------------------------------------------------
  BerryIO Changelog Command
------------------------------------------------------------------------------*/

$title = 'Version History';

// Load the version information
require_once(CONFIGS.'version.php');

// Display about information
$content .= view('pages/changelog');
