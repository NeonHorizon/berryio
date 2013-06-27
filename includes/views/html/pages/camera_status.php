
<div>
  <div class="panel camera_thumbnails">

    <h2>IMAGES</h2>

    <? if(count($images) < 1):?>
      No images have been taken yet...
    <? else:?>

      <? foreach($images as $name => $file):?>
        <img src="/camera_show/image_thumbnail/<?=h($name)?>.png" alt="<?=$name?>" title="<?=$name?>" />
      <? endforeach?>

    <? endif?>

  </div>
</div>

<div>
  <div class="panel camera_thumbnails">

    <h2>VIDEOS</h2>

    <? if(count($videos) < 1):?>
      No videos have been taken yet...
    <? else:?>

      <? foreach($videos as $name => $file):?>
        <img src="/camera_show/image_thumbnail/<?=h($name)?>.png" alt="<?=$name?>" title="<?=$name?>" />
      <? endforeach?>

    <? endif?>

  </div>
</div>

<div class="panel not_too_wide">

  <h2>HINTS AND TIPS</h2>

  <p class="left">
    The image and video folder locations are set in the file<br />
    <?=h(SETTINGS)?>camera.php
  </p>
  <p class="left">
    The current folder locations are:<br />
    Images: <?=h($GLOBALS['CAMERA_STORE']['IMAGES']['FILES'])?><br />
    Videos: <?=h($GLOBALS['CAMERA_STORE']['VIDEOS']['FILES'])?><br />
  </p>

</div>