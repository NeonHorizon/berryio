<?=REAL_NAME?> V<?=$GLOBALS['VERSION_NO']?> (<?=$GLOBALS['VERSION_DATE']?>)

<? if(isset($error) && $error != ''):?>ERROR:

  <?=$error?>


<?endif?>
USAGE:

  sudo <?=$berryio?> <command> [<option>] [<option>] [....]

EXAMPLES:

<? foreach($GLOBALS['USAGE_COMMANDS'] as $command):?>
<? if( (is_array($command) && !in_array($command[0], $GLOBALS['NO_SUDO'])) || (!is_array($command) && !in_array($command, $GLOBALS['NO_SUDO'])) ):?>
  sudo <?=$berryio?> <?=is_array($command) ?  implode(' ', $command) : $command?>
<? else:?>
       <?=$berryio?> <?=is_array($command) ?  implode(' ', $command) : $command?>
<? endif?>

<? endforeach?>
