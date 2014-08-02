OK:
<? foreach($disk_partitions as $location => $information):?>
<? if(isset($information['Temporary']['bool']) && !$information['Temporary']['bool']):?>
<?=$location?>
<? if(isset($information['Used']['value'])):?>
,<?=$information['Used']['value']?>
<? endif?>
<? if(isset($information['Size']['value'])):?>
,<?=$information['Size']['value']?>
<? endif?>
<? if(isset($information['Free']['value'])):?>
,<?=$information['Free']['value']?>
<? endif?>

<? endif?>
<? endforeach?>
<? foreach($disk_partitions as $location => $information):?>
<? if(isset($information['Temporary']['bool']) && $information['Temporary']['bool'] && isset($information['Used']['value'])):?>
<?=$location?>
<? if(isset($information['Used']['value'])):?>
,<?=$information['Used']['value']?>
<? endif?>
<? if(isset($information['Size']['value'])):?>
,<?=$information['Size']['value']?>
<? endif?>
<? if(isset($information['Free']['value'])):?>
,<?=$information['Free']['value']?>
<? endif?>

<? endif?>
<? endforeach?>
