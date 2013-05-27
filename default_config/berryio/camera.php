<?
/*------------------------------------------------------------------------------
  BerryIO Camera Settings
------------------------------------------------------------------------------*/

/*------------------------------------------------------------------------------
  BerryIO currently supports the Raspberry Pi Camera module only
------------------------------------------------------------------------------*/

// The locations to store images and videos
// If you change any of these please run sudo berryio camera_setup
// The setup program grants access to pi and the webserver on these folders
$GLOBALS['CAMERA_STORE']['IMAGES']['FILES']       = '/home/pi/berryio/images';
$GLOBALS['CAMERA_STORE']['IMAGES']['THUMBNAILS']  = '/home/pi/berryio/.thumbnails/images';
$GLOBALS['CAMERA_STORE']['VIDEOS']['FILES']       = '/home/pi/berryio/videos';
$GLOBALS['CAMERA_STORE']['VIDEOS']['THUMBNAILS']  = '/home/pi/berryio/.thumbnails/videos';

// Thumbnail Size (max x, max y)
// Images will be resized proportionally
// If you change this delete the contents of the thumbnail folders so the thumbs get recreated
$GLOBALS['CAMERA_THUMBNAIL_SIZE']['IMAGES'] = array('X' => 133, 'Y' => 100);
$GLOBALS['CAMERA_THUMBNAIL_SIZE']['VIDEOS'] = array('X' => 133, 'Y' => 100);

// Do not change below this line
define('CAMERA_SETTINGS_VERSION', '1');
