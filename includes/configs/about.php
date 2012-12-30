<?
/*------------------------------------------------------------------------------
  BerryIO About Information
------------------------------------------------------------------------------*/

// Contact Details
define('ABOUT_CONTACT', 'berryio@frozenmist.co.uk');
define('ABOUT_URL', 'http://frozenmist.co.uk/downloads/berryio/');

// Check version URL
define('ABOUT_VERSION_URL', 'http://frozenmist.co.uk/downloads/berryio/current_version.php');

// Version History
$GLOBALS['ABOUT_VERSION_HISTORY'] = array(
  array('1.0.0', '2012-09-19', array('Initial Release')),
  array('1.1.0', '2012-09-20', array('Changed default network manager from wicd to wpagui as shipped with 2012-09-18-wheezy-raspbian')),
  array('1.2.0', '2012-09-22', array('Added cpu/disk/memory usage information', 'Removed sudo requirement on some functions', 'Minor structural and cosmetic changes')),
  array('1.2.1', '2012-09-23', array('Removed percentage information where not applicable', 'Changed load average indication to inverse logarithmic', 'Clarified headings')),
  array('1.3.0', '2012-09-30', array('Added support for SPI ADC\'s and DAC\'s')),
  array('1.4.0', '2012-10-05', array('Added support for HDD44780 or KS0066U compatible LCD\'s', 'Changed internal command execution process and parameter passing to make clearer', 'General code cleanup')),
  array('1.4.1', '2012-10-10', array('Added lcd_position function', 'Added are you sure confirmation on GUI shutdown and reboot')),
  array('1.4.2', '2012-10-13', array('Improvements to LCD timing accuracy')),
  array('1.4.3', '2012-10-20', array('Improvements to GPIO file security handling', 'Added LCD clear delay to prevent corruption', 'Added option to run GPIO functions on all pins')),
  array('1.4.4', '2012-11-04', array('Changed initial install GPIO config file to use R2/512MB board pins (with option to change)', 'Added support in initial install GPIO config file for P5 header on R2 boards', 'Fixed a bug introduced in 1.4.3 with gpio_set_mode (first time always set to in mode)', 'Improved redirect efficiency')),
  array('1.4.5', '2012-11-24', array('Added port information to email and usage page links when ports other than 80 are used', 'Added more detailed information into installation instructions for webserver port changing')),
  array('1.5.0', '2012-12-30', array('Changed the file layout so everything is in /usr/share/berryio and can be synced with github', 'Changed install/upgrade scripts and instructions so application is retrieved from giuthub')),
);

// Version Numbering
define('ABOUT_VERSION_NO', 0);
define('ABOUT_VERSION_DATE', 1);
define('ABOUT_VERSION_DETAILS', 2);
$GLOBALS['ABOUT_VERSION_NO'] = $GLOBALS['ABOUT_VERSION_HISTORY'][count($GLOBALS['ABOUT_VERSION_HISTORY']) - 1][ABOUT_VERSION_NO];
$GLOBALS['ABOUT_VERSION_DATE'] = $GLOBALS['ABOUT_VERSION_HISTORY'][count($GLOBALS['ABOUT_VERSION_HISTORY']) - 1][ABOUT_VERSION_DATE];
