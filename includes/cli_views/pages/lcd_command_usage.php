<?=REAL_NAME?> V<?=$GLOBALS['VERSION_NO']?> (<?=$GLOBALS['VERSION_DATE']?>)

<? if(isset($error) && $error != ''):?>ERROR:

  <?=$error?>


<?endif?>
LCD COMMAND USAGE:

  sudo <?=$berryio?> lcd_command <command> [<command>] [<command>] [....]

LCD COMMANDS:

  sudo <?=$berryio?> lcd_command help
<? foreach($GLOBALS['LCD_COMMANDS'] as $command => $ref):?>
  sudo <?=$berryio?> lcd_command <?=is_array($command) ?  implode(' ', $command) : $command?>

<? endforeach?>
