OK:
<? foreach($gpio_modes as $pin => $mode):?>
<?=$pin?>,<?=$mode?>,<?=$gpio_values[$pin]?>

<? endforeach?>