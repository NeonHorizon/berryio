<?
/*------------------------------------------------------------------------------
  BerryIO SPI Get SPI Values Command
  This command would not normally be used by a user and is there to support
  refreshing on the web interface
------------------------------------------------------------------------------*/

// Load the SPI functions
require_once(FUNCTIONS.'spi.php');

// Get the SPI ADC values and output them
$values = spi_get_adc_values();
foreach($values as $chip_select => $channels)
  foreach($channels as $channel => $value)
    echo $chip_select.':'.$channel.':'.$value.',';

// Don't render the HTML page as this doesn't display one it just outputs values
exit();
