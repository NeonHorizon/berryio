<?
/*------------------------------------------------------------------------------
  BerryIO Check Version Command
------------------------------------------------------------------------------*/

// Load about information
require_once(CONFIGS.'about.php');

// Fetch the current version
if(($version_info = @file_get_contents(ABOUT_VERSION_URL)) === FALSE)
{
  $content .= message('Unable to check the version number at this time, are you connected to the Internet?');
  return;
}

$version_info = explode(',', $version_info);
if(count($version_info) != 3)
{
  $content .= message('Unable read the version information file?');
  return;
}

list($version_number, $version_date, $version_download) = $version_info;
if($version_number == $GLOBALS['ABOUT_VERSION_NO'] && $version_date == $GLOBALS['ABOUT_VERSION_DATE'])
  $content .= message(REAL_NAME.' is up to date'.PHP_EOL.'V'.$GLOBALS['ABOUT_VERSION_NO'].' is the current version', 'about');
else
  $content .= view('pages/upgrade_available', array('version_number' => $version_number, 'version_date' => $version_date, 'version_download' => $version_download));
