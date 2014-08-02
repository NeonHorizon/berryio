<?
/*------------------------------------------------------------------------------
  BerryIO System Status Settings
------------------------------------------------------------------------------*/

// This value specifies the delay between updates of the CPU, Memory and disk
// information on the System Status web page. Making these intervals too small
// will create a high CPU load when viewing. It should be noted the updates
// only take place when someone is viewing the BerryIO System Status Page, your
// performance will be unaffected at other times.
// Update intervals are in ms (1000ms = 1 second)
define('CPU_UPDATE_INTERVAL', 3100);
define('MEMORY_UPDATE_INTERVAL', 5300);
define('DISK_UPDATE_INTERVAL', 8300);

// This value adjusts the sensitivity of the System Load logarithmic bar-graph.
// Lower values make the bargraph more sensitive, higher values less sensitive.
// The actual numeric value shown is unaffected, just the bar graph itself.
// This is really just a cosmetic adjustment. BerryIO versions 1.2.1 through
// to 1.12.0 used a value of 3 whilst 1.12.0 and later use a value of 5.
define('SYSTEM_LOAD_SENSITIVITY', 5);


// Do not change below this line
define('SYSTEM_SETTINGS_VERSION', '1');
