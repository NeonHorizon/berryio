
HINTS AND TIPS:

  You can name and add/remove GPIO pins on by editing the file
  <?=SETTINGS?>gpio.php

  If you move your SD card between Pi models (for example from a
  B to a B+) you will need to edit this file to enable the extra
  GPIO pins.

  If you are using SPI, I2C or the UART serial port (for example
  with a console cable), its best to make sure the relevant GPIO
  pins are set to not_exported.

GPIO PINS:

<? foreach($gpio_modes as $pin => $mode):?>
<?=view('modules/gpio/pin', array('pin' => $pin, 'mode' => $mode, 'value' => $gpio_values[$pin]))?>
<? endforeach?>