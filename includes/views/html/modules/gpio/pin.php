
<div class="group">

  <h2>
    GPIO-<?=h($pin)?></h2>
    <h3>&nbsp;<?=h($GLOBALS['GPIO_PINS'][$pin])?>&nbsp;</h3>


    <? if($value == 'not_exported'):?>
      <img id="pin_<?=$pin?>_value" class="gpio_value" src="/images/gpio/value/<?=$value?>.png" alt="" title="" />
    <? else:?>
      <img id="pin_<?=$pin?>_value" class="gpio_value" src="/images/gpio/value/<?=$value?>.png" alt="<?= $value ? 'on' : 'off'?>" title="<?= $value ? 'on' : 'off'?>" />
    <? endif?>

  <div class="gpio_mode">

    <img id="pin_<?=$pin?>_mode" src="/images/gpio/mode/<?=$mode?>.png" alt="<?=strtr($mode, array('_' => ' '))?>" title="<?=strtr($mode, array('_' => ' '))?>" />

    <? foreach($GLOBALS['GPIO_MODES'] as $new_mode):?>
      <div class="<?=$new_mode?>" onclick="setGPIOMode(<?=$pin?>, '<?=$new_mode?>')">&nbsp;;</div>
    <? endforeach?>
  </div>

  <div class="gpio_toggle">
    <? if($mode == 'out'):?>
      <img id="pin_<?=$pin?>_toggle" class="gpio_toggle" src="/images/gpio/toggle/<?=$value?>.png" alt="<?= $value ? 'on' : 'off'?>" title="<?= $value ? 'on' : 'off'?>" />
    <? else:?>
      <img id="pin_<?=$pin?>_toggle" class="gpio_toggle" src="/images/gpio/toggle/not_applicable.png" alt="" title="" />
    <? endif?>

    <? foreach($GLOBALS['GPIO_VALUES'] as $new_value):?>
      <div id="pin_<?=$pin?>_toggle_<?= $new_value ? 'on' : 'off'?>" class="<?= $new_value ? 'on' : 'off'?>" style="visibility: <?= $mode == 'out' ? 'visible' : 'hidden'?>" onclick="setGPIOValue(<?=$pin?>, '<?=$new_value?>')">&nbsp;</div>
    <? endforeach?>
  </div>

</div>
