
  Interface:     <?=$details['Interface']['text']?>

<? if(isset($details['Link']['bool']) && isset($details['Connected']['bool']) && $details['Link']['bool'] && $details['Connected']['bool']):?>
  Status:        Connected and working!
<? elseif(isset($details['Link']['bool']) && $details['Link']['bool']):?>
  Status:        Connected but idle
<? elseif(isset($details['Connected']['bool']) && $details['Connected']['bool']):?>
  Status:        Connected but idle
<? else:?>
  Status:        Not connected
<? endif?>
<? foreach($details as $name => $information):?>
<? if(isset($information['value']) && isset($information['min']) && isset($information['max'])):?>
  <?=str_pad($name.':', 15)?><?=graph_horizontal_bar($information['value'], $information['min'], $information['max'], isset($information['positive']) ? $information['positive'] : '')?>

<? elseif($name != 'Interface' && isset($information['text'])):?>
  <?=str_pad($name.':', 15)?><?=$information['text']?>

<? endif?>
<? endforeach?>
