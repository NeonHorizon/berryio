<? foreach($memory_locations as $location => $information):?>
<? if(isset($information['Virtual']['bool']) && !$information['Virtual']['bool']):?>
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
<? foreach($memory_locations as $location => $information):?>
<? if(isset($information['Virtual']['bool']) && $information['Virtual']['bool'] && isset($information['Used']['value'])):?>
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
