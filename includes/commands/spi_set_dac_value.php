<?
/*------------------------------------------------------------------------------
  BerryIO SPI Set DAC Value Command
------------------------------------------------------------------------------*/

$title = 'SPI Control';

// Load the SPI functions
require_once(FUNCTIONS.'spi.php');

// Check the args
if(count($args) != 3)
{
  $content .= usage('Please provide chip_select, channel and value information');
  return FALSE;
}

// Set the SPI Value
if(spi_set_dac_value($args[0], $args[1], $args[2]) === FALSE)
{
  $content .= message('ERROR: Cannot set chip "'.$args[0].'" channel "'.$args[1].'" to values "'.$args[2].'", are the chip, channel and value valid?', 'spi_status');
  return FALSE;
}

if($GLOBALS['EXEC_MODE'] == 'cli')
  $content .= go_to('spi_status', $args[0], $args[1], $args[2]);
elseif($GLOBALS['EXEC_MODE'] == 'html')
  $content .= go_to('spi_status');