
GPIO PINS:

<? foreach($gpio_modes as $pin => $mode):?>
<?=view('modules/gpio/pin', array('pin' => $pin, 'mode' => $mode, 'value' => $gpio_values[$pin]))?>
<? endforeach?>