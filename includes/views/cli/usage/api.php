<?=REAL_NAME?> V<?=$GLOBALS['VERSION_NO']?> (<?=$GLOBALS['VERSION_DATE']?>)

<? if(isset($error) && $error != ''):?>ERROR:

  <?=$error?>


<?endif?>
API USAGE:

  sudo <?=$GLOBALS['EXEC']?> api_command <command> [<option>] [<option>] ....

API COMMANDS:

<? foreach($GLOBALS['USAGE_COMMANDS'] as $group => $commands):?>
<? foreach($commands as $command):?>
<? if( (is_array($command) && in_array($command[0], $GLOBALS['API_COMMANDS'])) || (!is_array($command) && in_array($command, $GLOBALS['API_COMMANDS'])) ):?>
<? if( (is_array($command) && in_array($command[0], $GLOBALS['NEED_SUDO'])) || (!is_array($command) && in_array($command, $GLOBALS['NEED_SUDO'])) ):?>
  sudo <?=$GLOBALS['EXEC']?> api_command <?=is_array($command) ?  implode(' ', $command) : $command?>
<? else:?>
       <?=$GLOBALS['EXEC']?> api_command <?=is_array($command) ?  implode(' ', $command) : $command?>
<? endif?>

<? endif?>
<? endforeach?>
<? endforeach?>
