<?
/*------------------------------------------------------------------------------
  BerryIO Version Information
------------------------------------------------------------------------------*/

// Check version URL
define('VERSION_URL', 'https://raw.github.com/NeonHorizon/berryio/master/VERSION.txt');

// Version History
$GLOBALS['VERSION_HISTORY'] = array(
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
  array('1.5.0', '2012-12-30', array('Changed the file layout so everything is in /usr/share/berryio and can be synced with github', 'Changed install/upgrade scripts and instructions so application is retrieved from github')),
  array('1.5.1', '2013-01-01', array('Changed location BerryIO checks its version against to github', 'Implimented upgrade command')),
  array('1.6.0', '2013-01-07', array('Added fix to cope with incorrect GPIO mode information from the system', 'Added the ability to name GPIO pins', 'Hints and Tips', 'Moved check for updates button', 'CSS fix for IE', 'Added settings check')),
  array('1.6.1', '2013-01-12', array('Changes to prevent IPV6 addresses being mistaken for MAC or IPV4 addresses', 'Improvements to installation instructions', 'Fixed bug in settings loader when checking the version', 'Improved GPIO error handling when addressing all pins')),
  array('1.6.2', '2013-01-12', array('Added IPv6 Support', 'Improved formatting on CLI hints and tips', 'Moved changelog to a different function')),
  array('1.6.3', '2013-01-21', array('Added main board information')),
  array('1.6.3', '2013-01-21', array('Added information on Raspberry Pi revision')),
);

// Version Numbering
define('VERSION_NO', 0);
define('VERSION_DATE', 1);
define('VERSION_DETAILS', 2);
$GLOBALS['VERSION_NO'] = $GLOBALS['VERSION_HISTORY'][count($GLOBALS['VERSION_HISTORY']) - 1][VERSION_NO];
$GLOBALS['VERSION_DATE'] = $GLOBALS['VERSION_HISTORY'][count($GLOBALS['VERSION_HISTORY']) - 1][VERSION_DATE];
