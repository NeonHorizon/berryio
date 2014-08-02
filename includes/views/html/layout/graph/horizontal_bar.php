
<div class="<?=$set_function ? 'clickable_' : ''?>horizontal_bar">
  <? if($show_percentage):?>
    <div class="horizontal_bar_value" <?=$id != '' ? 'id="'.$id.'_value"' : ''?>><?=$percentage === '' ? '&nbsp;' : h($percentage.'%')?></div>
  <? endif?>
  <div class="horizontal_bar_outline">
    <span class="horizontal_bar_fill" <?=$id != '' ? 'id="'.$id.'_bar"' : ''?> style="<?=$color?>width: <?=$percentage + 0?>%"></span>
    <? if($set_function):?>
      <img
        onmousemove="setGraphHorizontalBar(event, '<?=$id?>', '', '')"
        onmouseup="  setGraphHorizontalBar(event, '<?=$id?>', false, '<?=$set_function !== TRUE ? $set_function : ''?>')"
        onmouseout=" setGraphHorizontalBar(event, '<?=$id?>', false, '<?=$set_function !== TRUE ? $set_function : ''?>')"
        onmousedown="setGraphHorizontalBar(event, '<?=$id?>', true,  '<?=$set_function !== TRUE ? $set_function : ''?>')"
        class="horizontal_bar_slider"
        id="<?=$id?>_slider"
        style="left: <?=$percentage -25?>px"
        src="/images/layout/graph/slider.png"
        alt=""
        title="" />
    <? endif?>
  </div>
</div>
