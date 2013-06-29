
<img id="<?=$id?>_img" src="/images/layout/button/0.png" alt="<?=$name?>" title="<?=$name?>"
  <? if(!$latch_forever):?>
    onmouseup="  updateButtonMomentary(event, '<?=$id?>', 0, '<?=$set_function !== TRUE ? $set_function : ''?>')"
    onmouseout=" updateButtonMomentary(event, '<?=$id?>', 0, '<?=$set_function !== TRUE ? $set_function : ''?>')"
  <? endif?>
  onmousedown="updateButtonMomentary(event, '<?=$id?>', 1, '<?=$set_function !== TRUE ? $set_function : ''?>')"
 />
