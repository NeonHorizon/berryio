<?
/*------------------------------------------------------------------------------
  BerryIO LCD Settings
------------------------------------------------------------------------------*/

/*------------------------------------------------------------------------------
  5v HDD44780 or KS0066U Compatible LCD Connection Instructions

  LCD Pin  What it is       What it is connected to         Pi Pin
  1        Ground           Ground                          6
  2        Power            5v                              2
  3        Contrast         Adjusted between 0v and 5v    (see below)
  4        Register Select  GPIO 17*                        11*
  5        Read/Write       Must be grounded!               6
  6        Enable Signal    GPIO 18*                        12*
  7        Data Bus 0       Ground                          6
  8        Data Bus 1       Ground                          6
  9        Data Bus 2       Ground                          6
  10       Data Bus 3       Ground                          6
  11       Data Bus 4       GPIO 22*                        15*
  12       Data Bus 5       GPIO 23*                        16*
  13       Data Bus 6       GPIO 24*                        18*
  14       Data Bus 7       GPIO 25*                        22*
  15       LED Power        5v                              2
  16       LED Ground       Ground                          6

  Contrast adjustment:
  Fit a 10k pot with one end on ground and the other end on 5v
  then connect the centre pin of the pot to the LCD contrast pin 3.

  * GPIO pins can be changed using the config settings below
------------------------------------------------------------------------------*/

define('LCD_RS_GPIO', 17);  // Register select
define('LCD_ES_GPIO', 18);  // Enable Signal

define('LCD_D4_GPIO', 22);  // Data Bus 4
define('LCD_D5_GPIO', 23);  // Data Bus 5
define('LCD_D6_GPIO', 24);  // Data Bus 6
define('LCD_D7_GPIO', 25);  // Data Bus 7
