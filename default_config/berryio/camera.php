<?
/*------------------------------------------------------------------------------
  BerryIO Camera Settings
------------------------------------------------------------------------------*/

/*------------------------------------------------------------------------------
  BerryIO currently only supports the Raspberry Pi Camera module
------------------------------------------------------------------------------*/

// These are the locations to store images and videos
// If you change any of them please re-run sudo berryio camera_setup
// The setup program will grant access to the pi login and the webserver
// (www-data) on any new folders it creates. If you use something other than
// the defaults you need to make sure that any existing folders in the paths
// also allow these users access. Be sure to keep the two thumbnail folders
// seperate
$GLOBALS['CAMERA_STORE']['IMAGES']['FILES']       = '/home/pi/berryio/images';
$GLOBALS['CAMERA_STORE']['IMAGES']['THUMBNAILS']  = '/home/pi/berryio/.thumbnails/images';
$GLOBALS['CAMERA_STORE']['VIDEOS']['FILES']       = '/home/pi/berryio/videos';
$GLOBALS['CAMERA_STORE']['VIDEOS']['THUMBNAILS']  = '/home/pi/berryio/.thumbnails/videos';

// Thumbnail Size (max x, max y)
// Images will be resized proportionally
// If you change this delete the contents of the thumbnail folders so the thumbs get recreated
$GLOBALS['CAMERA_THUMBNAIL_SIZE']['IMAGES'] = array('X' => 133, 'Y' => 100);
$GLOBALS['CAMERA_THUMBNAIL_SIZE']['VIDEOS'] = array('X' => 133, 'Y' => 100);

// Size of the image veiwing window in the web interface
$GLOBALS['CAMERA_VIEWFINDER'] = array('X' => 432, 'Y' => 324);


// Do not change below this line
define('CAMERA_SETTINGS_VERSION', '1');
