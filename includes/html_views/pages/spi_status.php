
<div>
  <div class="panel">

    <h2>SPI ADC VALUES</h2>

    <? foreach($spi_adc_values as $chip_select => $channels):?>

      <div class="container spi_analogue">
        <h2><?=h($GLOBALS['SPI_CHIP_SELECTS'][$chip_select])?></h2>
        <table>

          <? foreach($channels as $channel => $value):?>
            <tr>
              <th><?=h($GLOBALS['SPI_CHANNELS'][$chip_select][$channel])?></th>
              <td class="code"><?=graph_horizontal_bar($value, 0, 1023, '', TRUE, 'spi_adc_'.$chip_select.'_'.$channel)?></td>
            </tr>
          <? endforeach?>

        </table>

      </div>

    <? endforeach?>

  </div>
</div>

<div>
  <div class="panel">

    <h2>SPI DAC SETTINGS</h2>

    <? foreach($GLOBALS['SPI_CHANNELS'] as $chip_select => $channels):?>

      <div class="container spi_analogue">
        <h2><?=h($GLOBALS['SPI_CHIP_SELECTS'][$chip_select])?></h2>
        <table>

        <? foreach($channels as $channel => $channel_name):?>
          <tr>
            <th><?=h($channel_name)?></th>
            <td class="code"><?=graph_horizontal_bar(isset($spi_dac_values[$chip_select][$channel]) ? $spi_dac_values[$chip_select][$channel] : 0, 0, 4095, '', isset($spi_dac_values[$chip_select][$channel]), 'spi_dac_'.$chip_select.'_'.$channel, '/spi_set_dac_value/'.$chip_select.'/'.$channel)?></td>
          </tr>
        <? endforeach?>

        </table>

      </div>

    <? endforeach?>

  </div>
</div>

<div class="panel not_too_wide">

  <h2>HINTS AND TIPS</h2>

  <p class="left">
    Refer to the config file <?=h(SETTINGS)?>spi.php for details on supported ADC and DAC chips.
  </p>

  <p class="left">
    If you are going to use SPI, to avoid conflicts its best to make sure the GPIO pins used by the SPI bus are set to "not in use" on the <a href="/gpio_status">GPIO</a> tab.
    Those are GPIO-7, GPIO-8, GPIO-9, GPIO-10 and GPIO-11.
  </p>

</div>
