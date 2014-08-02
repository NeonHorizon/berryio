<?
/*------------------------------------------------------------------------------
  BerryIO SPI Settings
------------------------------------------------------------------------------*/

/*------------------------------------------------------------------------------
  BerryIO currently supports the MCP3002 Dual Channel ADC Converter
  and the MCP4802 Dual Channel 8-bit DAC. Others may also work
------------------------------------------------------------------------------*/

// You can rename your SPI channels here
// The first reference is 0 or 1 and is the chip to select,
// the Pi does this using the Chip Enable lines CE0 and CE1
// The second value is the ADC or DAC channel, this is also 0 or 1
$GLOBALS['SPI_CHANNELS'][0][0] = 'Ch0';
$GLOBALS['SPI_CHANNELS'][0][1] = 'Ch1';
$GLOBALS['SPI_CHANNELS'][1][0] = 'Ch0';
$GLOBALS['SPI_CHANNELS'][1][1] = 'Ch1';

// This value specifies the delay between updates of SPI information on the SPI
// Status web page. Making these intervals too small will create a high CPU load
// when viewing. It should be noted the updates only take place when someone is
// viewing the BerryIO SPI Status Page, your performance will be unaffected at
// other times.
// Update interval is in ms (1000ms = 1 second)
define('SPI_UPDATE_INTERVAL', 400);  // Update interval in ms


// Do not change below this line
define('SPI_SETTINGS_VERSION', '2');
