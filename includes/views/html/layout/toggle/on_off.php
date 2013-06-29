
<div class="toggle_<?=$type?>_on_off">
  <img id="<?=$id?>_img" src="/images/layout/toggle/<?=$type?>_on_off/<?=$value?>.png" alt="<?= $value ? 'on' : 'off'?>" title="<?= $value ? 'on' : 'off'?>" />
  <div class="off" onclick="updateToggleOnOff(event, '<?=$type?>', '<?=$id?>', 0, '<?=$set_function !== TRUE ? $set_function : ''?>')">&nbsp;</div>
  <div class="on"  onclick="updateToggleOnOff(event, '<?=$type?>', '<?=$id?>', 1, '<?=$set_function !== TRUE ? $set_function : ''?>')">&nbsp;</div>
</div>
