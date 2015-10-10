<?
/*------------------------------------------------------------------------------
  BerryIO GPIO Settings
------------------------------------------------------------------------------*/

// Below is a list of different GPIO Pin configs for the different boards
//
// Uncomment the config you are using by removing the /* at the start
// and the */ at the end
//
// Comment out the config you are not using by adding /* at the start
// and */ at the end
//
// You can rename your pins here by changing the text on the right

// THIS FILE SHOULD CONTAIN THE CONFIGURATION FOR A COMPUTE MODULE BUT CURRENTLY
// ONLY CONTAINS THE A+/B+ CONFIGURATION. IF YOU OWN A COMPUTE MODULE PLEASE
// CONFIGURE THIS FILE CORRECTLY AND SUBMIT A PATCH. THANK YOU....


// Settings for original revision 1 board
/*
$GLOBALS['GPIO_PINS'] = array(
  0  => 'I2C SDA1',
  1  => 'I2C SCL1',
  4  => 'GPIO_GCLK',
  7  => 'SPI_CE1_N',
  8  => 'SPI_CE0_N',
  9  => 'SPI_MISO',
  10 => 'SPI_MOSI',
  11 => 'SPI_SCLK',
  14 => 'UART TXD0',
  15 => 'UART RXD0',
  17 => 'GPIO_GEN0',
  18 => 'PCM CLK',
  21 => 'PCM DOUT',
  22 => 'GPIO_GEN3',
  23 => 'GPIO_GEN4',
  24 => 'GPIO_GEN5',
  25 => 'GPIO_GEN6',
);
*/


// Settings for revision 2 board (including 512MB version but not A+ or B+)
/*
$GLOBALS['GPIO_PINS'] = array(
  2  => 'I2C SDA1',
  3  => 'I2C SCL1',
  4  => 'GPIO_GCLK',
  7  => 'SPI_CE1_N',
  8  => 'SPI_CE0_N',
  9  => 'SPI_MISO',
  10 => 'SPI_MOSI',
  11 => 'SPI_SCLK',
  14 => 'UART TXD0',
  15 => 'UART RXD0',
  17 => 'GPIO_GEN0',
  18 => 'PCM CLK',
  22 => 'GPIO_GEN3',
  23 => 'GPIO_GEN4',
  24 => 'GPIO_GEN5',
  25 => 'GPIO_GEN6',
  27 => 'GPIO_GEN2',
);
*/

// Extra GPIO Pins on the optional P5 header on the revision 2 board
/*
$GLOBALS['GPIO_PINS'] += array(
  28 => 'I2C SDA0',
  29 => 'I2C SCL0',
  30 => '',
  31 => '',
);
*/


// Settings for model A+, B+ and Pi 2 model B boards
$GLOBALS['GPIO_PINS'] = array(
  2  => 'I2C SDA1',
  3  => 'I2C SCL1',
  4  => 'GPIO_GCLK',
  5  => '',
  6  => '',
  7  => 'SPI_CE1_N',
  8  => 'SPI_CE0_N',
  9  => 'SPI_MISO',
  10 => 'SPI_MOSI',
  11 => 'SPI_SCLK',
  12  => '',
  13  => '',
  14 => 'UART TXD0',
  15 => 'UART RXD0',
  17 => 'GPIO_GEN0',
  18 => 'PCM CLK',
  19  => '',
  20  => '',
  21  => '',
  22 => 'GPIO_GEN3',
  23 => 'GPIO_GEN4',
  24 => 'GPIO_GEN5',
  25 => 'GPIO_GEN6',
  26 => '',
  27 => 'GPIO_GEN2',
);


define('GPIO_PINS_PER_ROW', 5);  // Change to fit your browser window

// This value specifies the delay between updates of the GPIO information on the
// GPIO Status web page. Making these intervals too small will create a high CPU
// load when viewing. It should be noted the updates only take place when
// someone is viewing the BerryIO GPIO Status Page, your performance will be
// unaffected at other times.
// Update interval is in ms (1000ms = 1 second)
define('GPIO_UPDATE_INTERVAL', 400);


// Do not change below this line
define('GPIO_SETTINGS_VERSION', '3');
