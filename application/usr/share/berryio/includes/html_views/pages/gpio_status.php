
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

    <div class="container">
      <p>
        <a class="button" href="/gpio_set_value/all/0" onclick="this.href='/gpio_set_value/all/0?s=' + getScrollY()">Turn all outputs off</a>
        <a class="button" href="/gpio_set_mode/all/not_exported" onclick="this.href='/gpio_set_mode/all/not_exported?s=' + getScrollY()">Set all pins as unused</a>
        <a class="button" href="/gpio_set_value/all/1" onclick="this.href='/gpio_set_value/all/1?s=' + getScrollY()">Turn all outputs on</a>
      </p>
    </div>

  </div>
</div>
