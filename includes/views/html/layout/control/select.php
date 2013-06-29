
<select class="select" id="<?=$id?>">
  <? foreach($options as $value => $name):?>
    <option value="<?=$value?>"<?= $value == $default ? ' selected="selected"' : ''?>><?=$name?></option>
  <? endforeach?>
</select>
