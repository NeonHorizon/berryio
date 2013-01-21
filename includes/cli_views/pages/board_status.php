<? foreach($information as $section => $section_details):?>

<?=strtoupper($section)?> INFORMATION:

<? foreach($section_details as $name => $details):?>
<?=str_pad($name.':', 20)?> <?=$details?>

<? endforeach?>
<? endforeach?>