
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
    Usage:
  </h3>

  <p class="left">http://<?=$GLOBALS['EXEC']?>/&lt;command&gt;[/&lt;option&gt;][/&lt;option&gt;][....]</p>

  <? foreach($GLOBALS['USAGE_COMMANDS'] as $group => $commands):?>
    <div class="stacked_container">

      <h3 class="left">
        <?=h($group)?> Commands
      </h3>

      <p class="left">
        <? foreach($commands as $command):?>
          <a href="http://<?=h($GLOBALS['EXEC'])?>/<?=h(is_array($command) ?  implode('/', $command) : $command)?>">http://<?=h($GLOBALS['EXEC'])?>/<?=h(is_array($command) ?  implode('/', $command) : $command)?></a><br />

        <? endforeach?>
      </p>

    </div>

  <? endforeach?>

</div>
