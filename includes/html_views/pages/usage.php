
<? if(isset($error) && $error != ''):?>

  <div>
    <div class="panel">
      <h2>ERROR</h2>
      <?=h($error)?>
    </div>
  </div>

<?endif?>

<div class="panel">

  <h2>
    <?=h(REAL_NAME)?> V<?=h($GLOBALS['ABOUT_VERSION_NO'])?>
    <br />
    <small>(<?=h($GLOBALS['ABOUT_VERSION_DATE'])?>)</small>
  </h2>

  <h3 class="left">
    Usage:
  </h3>

  <p class="left">http://<?=$berryio?>/&lt;command&gt;[/&lt;option&gt;][/&lt;option&gt;][....]</p>

  <br />

  <h3 class="left">
    Examples:
  </h3>

  <p class="left">
    <? foreach($GLOBALS['USAGE_COMMANDS'] as $command):?>
      <a href="http://<?=h($berryio)?>/<?=h(is_array($command) ?  implode('/', $command) : $command)?>">http://<?=h($berryio)?>/<?=h(is_array($command) ?  implode('/', $command) : $command)?></a><br />

    <? endforeach?>
  </p>

</div>
