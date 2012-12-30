
<div class="group">

  <h2>Pin <?=h($pin)?></h2>

  <? if($value == 'not_exported'):?>
      <img id="pin_<?=$pin?>_value" class="gpio_value" src="/images/gpio/value/<?=$value?>.png" alt="" title="" />
  <? else:?>
      <img id="pin_<?=$pin?>_value" class="gpio_value" src="/images/gpio/value/<?=$value?>.png" alt="<?= $value ? 'on' : 'off'?>" title="<?= $value ? 'on' : 'off'?>" />
  <? endif?>

  <div class="gpio_mode">

    <img src="/images/gpio/mode/<?=$mode?>.png" alt="<?=strtr($mode, array('_' => ' '))?>" title="<?=strtr($mode, array('_' => ' '))?>" />

    <? foreach($GLOBALS['GPIO_MODES'] as $new_mode):?>
      <a class="<?=$new_mode?>" href="/gpio_set_mode/<?=$pin?>/<?=$new_mode?>" onclick="this.href='/gpio_set_mode/<?=$pin?>/<?=$new_mode?>?s=' + getScrollY()"> </a>
    <? endforeach?>

  </div>

  <? if($mode == 'out'):?>
    <a href="/gpio_set_value/<?=$pin?>/<?=(!$value + 0)?>" onclick="this.href='/gpio_set_value/<?=$pin?>/<?=(!$value + 0)?>?s=' + getScrollY()">
      <img class="gpio_toggle" src="/images/gpio/toggle/<?=$value?>.png" alt="<?= $value ? 'on' : 'off'?>" title="<?= $value ? 'on' : 'off'?>" />
    </a>
  <? else:?>
    <img class="gpio_toggle" src="/images/gpio/toggle/not_applicable.png" alt="" title="" />
  <? endif?>

</div>
