<?
/*------------------------------------------------------------------------------
  BerryIO SPI Functions
------------------------------------------------------------------------------*/


/*------------------------------------------------------------------------------
  Load the SPI config and define some of our own
------------------------------------------------------------------------------*/
settings('spi');
$GLOBALS['SPI_CHIP_SELECTS'] = array(0 => 'CE0', 1 => 'CE1');
$GLOBALS['SPI_CHANNELS'] = array(0 => 'Ch0', 1 => 'Ch1');
$GLOBALS['SPI_DAC_MIN'] = 0;
$GLOBALS['SPI_DAC_MAX'] = 4095;


/*----------------------------------------------------------------------------
  Gets the current values from the ADC's
  If chip and channel are supplied it returns a single value
  If chip but not a channel are supplied it returns an array of channels
  If no chip and no channel supplied returns an array of chips with an array
  of channels
  Returns FALSE on failure
----------------------------------------------------------------------------*/
function spi_get_adc_values($chip_select = '', $channel = '')
{
  // Check the values are good
  global $SPI_CHIP_SELECTS, $SPI_CHANNELS;
  if($channel !== '' && (!is_numeric($channel) || !array_key_exists($channel, $SPI_CHANNELS))) return FALSE;
  if($channel !== '' && $chip_select === '') return FALSE;
  if($chip_select !== '' && (!is_numeric($chip_select) || !array_key_exists($chip_select, $SPI_CHIP_SELECTS))) return FALSE;

  // Execute the command and retrieve the values
  exec('sudo '.BINARIES.'berryio_spi_get_adc '.$chip_select.' '.$channel, $output, $return_var);
  if($return_var) return FALSE;
  if(count($output) != 1) return FALSE; // One line only please
  $data = explode(',', $output[0]);

  switch(count($data))
  {
    case '4':
      // All chips and all channels
      if($chip_select !== '' || $channel !== '') return FALSE;
      return array($SPI_CHIP_SELECTS[0] => array($SPI_CHANNELS[0] => $data[0], $SPI_CHANNELS[1] => $data[1]),
                   $SPI_CHIP_SELECTS[1] => array($SPI_CHANNELS[0] => $data[2], $SPI_CHANNELS[1] => $data[3]));

    case '2':
      // All all channels on one chip
      if($chip_select === '' || $channel !== '') return FALSE;
      return array($SPI_CHANNELS[0] => $data[0], $SPI_CHANNELS[1] => $data[1]);

    case '1':
      // One channel on one chip
      if($chip_select === '' || $channel === '' || !is_numeric($data[0])) return FALSE;
      return $data[0];

    default:
      return FALSE;
  }
}


/*----------------------------------------------------------------------------
  Sets a channels DAC value
  Returns FALSE on failure and TRUE on success
----------------------------------------------------------------------------*/
function spi_set_dac_value($chip_select, $channel, $value)
{
  // Check the values are good
  global $SPI_CHIP_SELECTS, $SPI_CHANNELS, $SPI_DAC_MIN, $SPI_DAC_MAX;
  if(!is_numeric($chip_select) || !array_key_exists($chip_select, $SPI_CHIP_SELECTS)) return FALSE;
  if(!is_numeric($channel) || !array_key_exists($channel, $SPI_CHANNELS)) return FALSE;
  if(!is_numeric($value) || $value < $SPI_DAC_MIN || $value > $SPI_DAC_MAX) return FALSE;

  // Execute the command and set the values
  exec('sudo '.BINARIES.'berryio_spi_set_dac '.$chip_select.' '.$channel.' '.$value.' 2>&1', $output, $return_var);
  if($return_var) return FALSE;
  if(count($output)) return FALSE; // If somethings returned it no doubt failed

  return TRUE;
}
