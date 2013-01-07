
HINTS AND TIPS:

  Refer to the config file <?=SETTINGS?>lcd.php for instructions on wiring a HDD44780 or KS0066U compatible LCD display.
  This includes options for changing which GPIO pins you wish to connect the display to.

LCD COMMANDS:

<? foreach($GLOBALS['LCD_COMMANDS'] as $command => $ref):?>
  <?=$command?>

<? endforeach?>
