
HINTS AND TIPS:

  Refer to the config file <?=SETTINGS?>spi.php
  for details on supported ADC and DAC chips.

  To avoid conflicts its best to make sure the GPIO pins used
  by the SPI bus are set to not_exported. Those are GPIO-7,
  GPIO-8, GPIO-9, GPIO-10 and GPIO-11.

SPI ADC VALUES:

<? foreach($spi_adc_values as $chip_select => $channels):?>
<? foreach($channels as $channel => $value):?>
  <?=$GLOBALS['SPI_CHIP_SELECTS'][$chip_select]?> <?=str_pad($GLOBALS['SPI_CHANNELS'][$chip_select][$channel], 10, ' ',  STR_PAD_LEFT)?> <?=str_pad($value, 4, ' ', STR_PAD_LEFT)?>  <?=graph_horizontal_bar($value, 0, 1023)?>

<? endforeach?>
<? endforeach?>

SPI DAC SETTINGS:

<? foreach($GLOBALS['SPI_CHANNELS'] as $chip_select => $channels):?>
<? foreach($channels as $channel => $channel_name):?>
<? if(isset($spi_dac_values[$chip_select][$channel])):?>
  <?=$GLOBALS['SPI_CHIP_SELECTS'][$chip_select]?> <?=str_pad($channel_name, 10, ' ',  STR_PAD_LEFT)?> <?=str_pad($spi_dac_values[$chip_select][$channel], 4, ' ', STR_PAD_LEFT)?>  <?=graph_horizontal_bar($spi_dac_values[$chip_select][$channel], 0, 4095)?>

<? endif?>
<? endforeach?>
<? endforeach?>
