OK:
<? foreach($spi_adc_values as $chip_select => $channels):?>
<? foreach($channels as $channel => $value):?>
<?=$chip_select?>,<?=$channel?>,<?=$value?>

<? endforeach?>
<? endforeach?>