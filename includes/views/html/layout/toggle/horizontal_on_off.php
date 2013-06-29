
<div class="toggle_horizontal_on_off">
  <img id="<?=$id?>_img" src="/images/layout/toggle/horizontal_on_off/<?=$value?>.png" alt="<?= $value ? 'on' : 'off'?>" title="<?= $value ? 'on' : 'off'?>" />
  <div class="off" onclick="updateToggle(event, '<?=$id?>', 0, '<?=$set_function !== TRUE ? $set_function : ''?>')">&nbsp;</div>
  <div class="on"  onclick="updateToggle(event, '<?=$id?>', 1, '<?=$set_function !== TRUE ? $set_function : ''?>')">&nbsp;</div>
</div>
