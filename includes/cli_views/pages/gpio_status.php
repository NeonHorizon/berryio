
HINTS AND TIPS:

  If you are using SPI, I2C or the serial port (for example with a
  console cable), its best to make sure the relevant GPIO pins are
  set to not_exported.

GPIO PINS:

<? foreach($gpio_modes as $pin => $mode):?>
<?=view('modules/gpio/pin', array('pin' => $pin, 'mode' => $mode, 'value' => $gpio_values[$pin]))?>
<? endforeach?>