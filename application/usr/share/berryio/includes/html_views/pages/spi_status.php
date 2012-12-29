
<div>
  <div class="panel">

    <h2>SPI ADC VALUES</h2>

    <? foreach($spi_adc_values as $chip_select => $channels):?>

      <div class="container spi_analogue">
        <h2><?=h($chip_select)?></h2>
        <table>

          <? foreach($channels as $channel => $value):?>
            <tr>
              <th><?=h($channel)?></th>
              <td class="code"><?=graph_horizontal_bar($value, 0, 1023, '', TRUE, 'spi_adc_'.$chip_select.'_'.$channel)?></td>
            </tr>
          <? endforeach?>

        </table>

      </div>

    <? endforeach?>

  </div>
</div>

<div class="panel">

  <h2>SPI DAC SETTINGS</h2>

  <? foreach($GLOBALS['SPI_CHIP_SELECTS'] as $chip_select => $chip_select_name):?>

    <div class="container spi_analogue">
      <h2><?=h($chip_select_name)?></h2>
      <table>

      <? foreach($GLOBALS['SPI_CHANNELS'] as $channel => $channel_name):?>
        <tr>
          <th><?=h($channel_name)?></th>
          <td class="code"><?=graph_horizontal_bar(isset($spi_dac_values[$chip_select][$channel]) ? $spi_dac_values[$chip_select][$channel] : 0, 0, 4095, '', isset($spi_dac_values[$chip_select][$channel]), 'spi_dac_'.$chip_select.'_'.$channel, '/spi_set_dac_value/'.$chip_select.'/'.$channel)?></td>
        </tr>
      <? endforeach?>

      </table>

    </div>

  <? endforeach?>

</div>
