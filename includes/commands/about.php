<?
/*------------------------------------------------------------------------------
  BerryIO About Command
------------------------------------------------------------------------------*/

// Version information
$content .= command('version');

// About information
require_once(CONFIGS.'about.php');
$content .= view('pages/about');

// Set the title last to override any previous set titles
$title = 'About '.NAME;
