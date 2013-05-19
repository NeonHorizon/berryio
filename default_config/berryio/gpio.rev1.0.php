<?
/*------------------------------------------------------------------------------
  BerryIO GPIO Settings
------------------------------------------------------------------------------*/

// Settings for original revision 1 board
// Uncomment if this is the board you have by removing the /* at the start
// and the */ at the end
// You can rename your pins here if you use this board
$GLOBALS['GPIO_PINS'] = array(
  0  => 'I2C SDA0',
  1  => 'I2C SCL0',
  4  => 'GPCLK0',
  7  => 'SPI CE1',
  8  => 'SPI CE0',
  9  => 'SPI MISO',
  10 => 'SPI MOSI',
  11 => 'SPI SCKL',
  14 => 'UART TXD',
  15 => 'UART RXD',
  17 => '',
  18 => 'PCM CLK',
  21 => 'PCM DOUT',
  22 => '',
  23 => '',
  24 => '',
  25 => '',
);

// Settings for revision 2 board (including 512MB version)
// Comment out if you dont have this board by adding /* at the start
// and */ at the end
// You can rename your pins here if you use this board
/*
$GLOBALS['GPIO_PINS'] = array(
  2  => 'I2C SDA1',
  3  => 'I2C SCL1',
  4  => 'GPCLK0',
  7  => 'SPI CE1',
  8  => 'SPI CE0',
  9  => 'SPI MISO',
  10 => 'SPI MOSI',
  11 => 'SPI SCKL',
  14 => 'UART TXD',
  15 => 'UART RXD',
  17 => '',
  18 => 'PCM CLK',
  22 => '',
  23 => '',
  24 => '',
  25 => '',
  27 => '',
);
*/

// Extra GPIO Pins
// Uncomment if you have fitted the optional P5 header on the revision 2 board
// by removing the /* at the start and the */ at the end
// You can rename your pins here if you use this board
/*
$GLOBALS['GPIO_PINS'] += array(
  28 => 'I2C SDA0',
  29 => 'I2C SCL0',
  30 => '',
  31 => '',
);
*/

define('GPIO_PINS_PER_ROW', 6);  // Change to fit your browser window
define('GPIO_UPDATE_INTERVAL', 400);  // Update interval in ms

// Do not change below this line
define('GPIO_SETTINGS_VERSION', '2');
