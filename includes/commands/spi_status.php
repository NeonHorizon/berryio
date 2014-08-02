<?
/*------------------------------------------------------------------------------
  BerryIO SPI Status Command
------------------------------------------------------------------------------*/

$title = 'SPI Control';

// Load the SPI functions
require_once(FUNCTIONS.'spi.php');

// Get the SPI details
if(($page['spi_adc_values'] = spi_get_adc_values()) === FALSE)
{
  $content .= message('ERROR: Unable retrieve SPI values');
  return FALSE;
}

// Make a note of any passed values if this is in CLI mode to show the new DAC settings
if($GLOBALS['EXEC_MODE'] == 'cli' && count($args) == 3)
  $page['spi_dac_values'][$args[0]][$args[1]] = $args[2];

// Display status page
$GLOBALS['JAVASCRIPT']['updateSPI'] = 'updateSPI';
require_once(FUNCTIONS.'graph.php');
$content .= view('pages/spi_status', $page);
