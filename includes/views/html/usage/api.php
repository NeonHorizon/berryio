
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
    API Usage:
  </h3>

  <p class="left">http://<?=$GLOBALS['EXEC']?>/api_command/&lt;command&gt;[/&lt;command&gt;][/&lt;command&gt;][....]</p>

  <br />

  <h3 class="left">
    API Commands:
  </h3>

  <p class="left">
    <? foreach($GLOBALS['USAGE_COMMANDS'] as $group => $commands):?>
      <? foreach($commands as $command):?>
        <? if( (is_array($command) && in_array($command[0], $GLOBALS['API_COMMANDS'])) || (!is_array($command) && in_array($command, $GLOBALS['API_COMMANDS'])) ):?>
          <a href="http://<?=h($GLOBALS['EXEC'])?>/api_command/<?=h(is_array($command) ?  implode('/', $command) : $command)?>">http://<?=h($GLOBALS['EXEC'])?>/api_command/<?=h(is_array($command) ?  implode('/', $command) : $command)?></a><br />

        <? endif?>
      <? endforeach?>
    <? endforeach?>
  </p>

</div>
