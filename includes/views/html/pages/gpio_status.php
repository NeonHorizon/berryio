
<div class="panel">

  <h2>GPIO PINS</h2>

  <div class="container gpio_pins">

    <? $count = 0; foreach($gpio_modes as $pin => $mode):?>
      <? if($count >= GPIO_PINS_PER_ROW):?>
        </div>
        <div class="stacked_container gpio_pins">
      <? $count = 0; endif ?>
      <?=view('modules/gpio/pin', array('pin' => $pin, 'mode' => $mode, 'value' => $gpio_values[$pin]))?>
    <? $count++; endforeach?>

  </div>
</div>

<div>
  <div class="panel">

    <h2>GLOBAL FUNCTIONS</h2>
    <p>
      <a class="button" href="/gpio_set_value/all/0" onclick="this.href='/gpio_set_value/all/0?s=' + getScrollY()">Turn all outputs off</a>
      <a class="button" href="/gpio_set_mode/all/not_exported" onclick="this.href='/gpio_set_mode/all/not_exported?s=' + getScrollY()">Set all pins as unused</a>
      <a class="button" href="/gpio_set_value/all/1" onclick="this.href='/gpio_set_value/all/1?s=' + getScrollY()">Turn all outputs on</a>
    </p>

  </div>
</div>

<div class="panel not_too_wide">

  <h2>HINTS AND TIPS</h2>

  <p class="left">
    If you are using SPI, I<sup>2</sup>C or the serial port (for example with a console cable), its best to make sure the relevant GPIO pins are set to "not in use".
  </p>

  <p class="left">
    The pins are as follows...
  </p>

  <p class="left">
    <b>SPI:</b> GPIO-7, GPIO-8, GPIO-9, GPIO-10 and GPIO-11
  </p>

  <p class="left">
    <b>I<sup>2</sup>C:</b> GPIO-0, GPIO-1, GPIO-2 and GPIO-3<br />
    <i>(Depending on which revision board you have, those GPIO pins may be on the P5 header)</i>
  </p>

  <p class="left">
    <b>UART (serial):</b> GPIO-14 and GPIO-15
  </p>

</div>
