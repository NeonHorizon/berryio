
HINTS AND TIPS:

  Refer to the config file <?=SETTINGS?>lcd.php for
  instructions on wiring a HDD44780 or KS0066U compatible
  LCD display. This file also includes options for
  changing the number of characters on the display and
  which GPIO ports you wish to connect the display to.

  Always initialise the display before use with:
  sudo <?=$GLOBALS['EXEC']?> lcd_initialise
