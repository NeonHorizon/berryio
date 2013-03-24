
<? if(isset($error) && $error != ''):?>

  <div>
    <div class="panel">
      <h2>ERROR</h2>
      <?=h($error)?>
    </div>
  </div>

<?endif?>

<div class="panel not_too_wide">

  <h2>
    HELP
  </h2>

  <h3 class="left">
    LCD Command Usage:
  </h3>

  <p class="left">http://<?=$berryio?>/lcd_command/&lt;command&gt;[/&lt;command&gt;][/&lt;command&gt;][....]</p>

  <br />

  <h3 class="left">
    LCD Commands:
  </h3>

  <p class="left">
      <a href="http://<?=h($berryio)?>/lcd_command/help">http://<?=h($berryio)?>/lcd_command/help</a><br />
    <? foreach($GLOBALS['LCD_COMMANDS'] as $command => $ref):?>
      <a href="http://<?=h($berryio)?>/lcd_command/<?=h(is_array($command) ?  implode('/', $command) : $command)?>">http://<?=h($berryio)?>/lcd_command/<?=h(is_array($command) ?  implode('/', $command) : $command)?></a><br />

    <? endforeach?>
  </p>

</div>
