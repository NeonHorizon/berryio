
PHYSICAL MEMORY:

  Type                    Size        Used        Free  Usage
<? foreach($memory_locations as $location => $information):?>
<? if(isset($information['Virtual']['bool']) && !$information['Virtual']['bool'] && isset($information['Used']['value']) && isset($information['Used']['min']) && isset($information['Used']['max'])):?>
  <?=str_pad($location, 16, ' ', STR_PAD_RIGHT)?>
  <?=str_pad(isset($information['Size']['text']) ? $information['Size']['text'] : '', 10, ' ', STR_PAD_LEFT)?>
  <?=str_pad(isset($information['Used']['text']) ? $information['Used']['text'] : '', 10, ' ', STR_PAD_LEFT)?>
  <?=str_pad(isset($information['Free']['text']) ? $information['Free']['text'] : '', 10, ' ', STR_PAD_LEFT)?>
  <?=graph_horizontal_bar($information['Used']['value'], $information['Used']['min'], $information['Used']['max'], isset($information['Used']['positive']) ? $information['Used']['positive'] : '', isset($information['Used']['absolute']) && $information['Used']['absolute'])?>

<? endif?>
<? endforeach?>

VIRTUAL MEMORY:

  Type                    Size        Used        Free  Usage
<? foreach($memory_locations as $location => $information):?>
<? if(isset($information['Virtual']['bool']) && $information['Virtual']['bool'] && isset($information['Used']['value']) && isset($information['Used']['min']) && isset($information['Used']['max'])):?>
  <?=str_pad($location, 16, ' ', STR_PAD_RIGHT)?>
  <?=str_pad(isset($information['Size']['text']) ? $information['Size']['text'] : '', 10, ' ', STR_PAD_LEFT)?>
  <?=str_pad(isset($information['Used']['text']) ? $information['Used']['text'] : '', 10, ' ', STR_PAD_LEFT)?>
  <?=str_pad(isset($information['Free']['text']) ? $information['Free']['text'] : '', 10, ' ', STR_PAD_LEFT)?>
  <?=graph_horizontal_bar($information['Used']['value'], $information['Used']['min'], $information['Used']['max'], isset($information['Used']['positive']) ? $information['Used']['positive'] : '', isset($information['Used']['absolute']) && $information['Used']['absolute'])?>

<? endif?>
<? endforeach?>
