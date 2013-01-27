<?
/*------------------------------------------------------------------------------
  BerryIO SPI Set DAC Value Command
------------------------------------------------------------------------------*/

// Load the SPI functions
require_once(FUNCTIONS.'spi.php');

// Set the SPI Value
if(count($args) != 3)
  $content .= usage('Please provide chip_select, channel and value information');
elseif(!spi_set_dac_value($args[0], $args[1], $args[2]))
  $content .= message('ERROR: Cannot set chip "'.$args[0].'" channel "'.$args[1].'" to values "'.$args[2].'", are the chip, channel and value valid?', 'spi_status');
else
  $content .= go_to('spi_status', $args[0], $args[1], $args[2]);
