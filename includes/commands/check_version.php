<?
/*------------------------------------------------------------------------------
  BerryIO Check Version Command
------------------------------------------------------------------------------*/

$title = 'Version Check';

// Load the version control functions
require_once(FUNCTIONS.'version.php');

// Fetch the current version
if(($latest_version = version_latest()) === FALSE)
{
  $content .= message('ERROR: Unable to fetch the latest version number at this time, are you connected to the Internet?');
  return FALSE;
}

if($latest_version[VERSION_NO] == $GLOBALS['VERSION_NO'] && $latest_version[VERSION_DATE] == $GLOBALS['VERSION_DATE'])
  $content .= message(REAL_NAME.' is up to date'.PHP_EOL.'V'.$GLOBALS['VERSION_NO'].' is the current version', 'about');
else
{
  // Find out the command line executable if this is not running on the command line we are going to need to guess
  $berryio = $GLOBALS['EXEC_MODE'] != 'cli' ? 'berryio' : $GLOBALS['EXEC'];

  $title = 'An upgrade is available!';
  $content .= view('pages/upgrade_available', array('berryio' => $berryio, 'version_number' => $latest_version[VERSION_NO], 'version_date' => $latest_version[VERSION_DATE]));
}
