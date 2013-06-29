
<img id="<?=$id?>_img" src="/images/layout/button/0.png" alt="<?=$name?>" title="<?=$name?>"
  onmouseup="  updateButtonMomentary(event, '<?=$id?>', 0, '<?=$set_function !== TRUE ? $set_function : ''?>')"
  onmouseout=" updateButtonMomentary(event, '<?=$id?>', 0, '<?=$set_function !== TRUE ? $set_function : ''?>')"
  onmousedown="updateButtonMomentary(event, '<?=$id?>', 1, '<?=$set_function !== TRUE ? $set_function : ''?>')"
 />
