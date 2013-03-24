<?=REAL_NAME?> V<?=$GLOBALS['VERSION_NO']?> (<?=$GLOBALS['VERSION_DATE']?>)

<? if(isset($error) && $error != ''):?>ERROR:

  <?=$error?>


<?endif?>
USAGE:

  sudo <?=$berryio?> <command> [<option>] [<option>] [....]
<? foreach($GLOBALS['USAGE_COMMANDS'] as $group => $commands):?>

<?=strtoupper($group)?> COMMANDS:

<? foreach($commands as $command):?>
<? if( (is_array($command) && in_array($command[0], $GLOBALS['NEED_SUDO'])) || (!is_array($command) && in_array($command, $GLOBALS['NEED_SUDO'])) ):?>
  sudo <?=$berryio?> <?=is_array($command) ?  implode(' ', $command) : $command?>
<? else:?>
       <?=$berryio?> <?=is_array($command) ?  implode(' ', $command) : $command?>
<? endif?>

<? endforeach?>
<? endforeach?>