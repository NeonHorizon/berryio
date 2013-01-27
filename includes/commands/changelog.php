<?
/*------------------------------------------------------------------------------
  BerryIO Changelog Command
------------------------------------------------------------------------------*/

$title = 'Version History';

// Load the version information
require_once(CONFIGS.'version.php');

// Display the changelog information
$content .= view('pages/changelog');
