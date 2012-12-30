
PERMANENT DISK PARTITIONS:

  Mount                 Size        Used        Free  Usage
<? foreach($disk_partitions as $partition => $information):?>
<? if(isset($information['Temporary']['bool']) && !$information['Temporary']['bool'] && isset($information['Used']['value']) && isset($information['Used']['min']) && isset($information['Used']['max'])):?>
  <?=str_pad($partition, 14, ' ', STR_PAD_RIGHT)?>
  <?=str_pad($information['Size']['text'], 10, ' ', STR_PAD_LEFT)?>
  <?=str_pad($information['Used']['text'], 10, ' ', STR_PAD_LEFT)?>
  <?=str_pad($information['Free']['text'], 10, ' ', STR_PAD_LEFT)?>
  <?=graph_horizontal_bar($information['Used']['value'], $information['Used']['min'], $information['Used']['max'], isset($information['Used']['positive']) ? $information['Used']['positive'] : '')?>

<? endif?>
<? endforeach?>

TEMPORARY DISK PARTITIONS:

  Mount                 Size        Used        Free  Usage
<? foreach($disk_partitions as $partition => $information):?>
<? if(isset($information['Temporary']['bool']) && $information['Temporary']['bool'] && isset($information['Used']['value']) && isset($information['Used']['min']) && isset($information['Used']['max'])):?>
  <?=str_pad($partition, 14, ' ', STR_PAD_RIGHT)?>
  <?=str_pad($information['Size']['text'], 10, ' ', STR_PAD_LEFT)?>
  <?=str_pad($information['Used']['text'], 10, ' ', STR_PAD_LEFT)?>
  <?=str_pad($information['Free']['text'], 10, ' ', STR_PAD_LEFT)?>
  <?=graph_horizontal_bar($information['Used']['value'], $information['Used']['min'], $information['Used']['max'], isset($information['Used']['positive']) ? $information['Used']['positive'] : '')?>

<? endif?>
<? endforeach?>
