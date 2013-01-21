<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-GB">

  <head>
    <title><?=h(NAME)?></title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="author" content="<?=h(NAME)?>" />
    <meta name="copyright" content="<?=h(NAME)?>" />
    <meta name="language" content="en-GB" />
    <meta name="doc-type" content="Web Page" />
    <link rel="stylesheet" href="/css/main.css?3" type="text/css" />

    <? foreach($GLOBALS['JAVASCRIPT_RUN'] as $javascript):?>
      <?= view('javascript/'.$javascript)?>
    <? endforeach?>

    <? foreach($GLOBALS['JAVASCRIPT'] as $javascript):?>
      <?= view('javascript/'.$javascript)?>
    <? endforeach?>

  </head>

  <body onload="<?= isset($_GET['s']) && is_numeric($_GET['s']) ? 'window.scrollTo(0, '.($_GET['s'] + 0).');' : ''?><? foreach ($GLOBALS['JAVASCRIPT_RUN'] as $javascript):?><?= $javascript?>();<? endforeach?>">

    <div id="menu">
      <? foreach($GLOBALS['MENU'] as $link => $name):?>
        <? if($link == $selected):?>
          <a class="selected" href="/<?=$link?>"><?=$name?></a>
        <? else:?>
          <a href="/<?=$link?>"><?=$name?></a>
        <? endif?>
      <? endforeach?>
    </div>


    <div id="main">
      <? if($title !== FALSE):?>
        <h1 id="title"><?=h($title)?></h1>
      <? endif?>

      <?=$content?>

    </div>

  </body>

</html>
