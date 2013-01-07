
HINTS AND TIPS:

  To avoid conflicts its best to make sure the GPIO pins used by the SPI bus are set to not_exported.

SPI ADC VALUES:

<? foreach($spi_adc_values as $chip_select => $channels):?>
<? foreach($channels as $channel => $value):?>
  <?=$chip_select?> <?=$channel?> <?=str_pad($value, 4, ' ', STR_PAD_LEFT)?>  <?=graph_horizontal_bar($value, 0, 1023)?>

<? endforeach?>
<? endforeach?>

SPI DAC SETTINGS:

<? foreach($GLOBALS['SPI_CHIP_SELECTS'] as $chip_select => $chip_select_name):?>
<? foreach($GLOBALS['SPI_CHANNELS'] as $channel => $channel_name):?>
<? if(isset($spi_dac_values[$chip_select][$channel])):?>
  <?=$chip_select_name?> <?=$channel_name?> <?=str_pad($spi_dac_values[$chip_select][$channel], 4, ' ', STR_PAD_LEFT)?>  <?=graph_horizontal_bar($spi_dac_values[$chip_select][$channel], 0, 4095)?>

<? endif?>
<? endforeach?>
<? endforeach?>
