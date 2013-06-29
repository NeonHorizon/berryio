
<div class="panel">

  <h2>CAMERA SETTINGS</h2>

  <?=view('modules/camera/controls', array('type' => 'COMMON', 'control' => 'Settings'))?>
  <?=view('modules/camera/controls', array('type' => 'VIDEOS', 'control' => 'Video'))?>
  <?=view('modules/camera/controls', array('type' => 'IMAGES', 'control' => 'Images'))?>

</div>

<div class="panel">

  <h2>VIEWFINDER</h2>

  <div class="container camera_viewfinder">
    <img id="camera_viewfinder" src="/images/camera/default.jpg" alt="" title="" style="width: <?=$GLOBALS['CAMERA_VIEWFINDER']['X']?>px; height: <?=$GLOBALS['CAMERA_VIEWFINDER']['Y']?>px;" />
  </div><br />

  <?=button_momentary('Take Photo', 'camera_trigger', 'cameraTakeImage', TRUE)?>

</div>

<div class="panel">

  <h2>CAMERA PROCESSING</h2>

  <?=view('modules/camera/controls', array('type' => 'COMMON', 'control' => 'Processing', 'blanks' => 2))?>
  <?=view('modules/camera/controls', array('type' => 'COMMON', 'control' => 'Orientation'))?>
  <?=view('modules/camera/controls', array('type' => 'COMMON', 'control' => 'Effects'))?>

</div>

<div>
  <div class="panel camera_thumbnails">

    <h2>IMAGES</h2>

    <div id="camera_images" style="height: <?=$GLOBALS['CAMERA_THUMBNAIL_SIZE']['IMAGES']['Y']?>px;">
      <? foreach($images as $name => $file):?>
        <img src="/camera_show/image_thumbnail/<?=h($name)?>.png" alt="<?=$name?>" title="<?=$name?>" />
      <? endforeach?>
    </div>

  </div>
</div>

<div>
  <div class="panel camera_thumbnails">

    <h2>VIDEOS</h2>

    <div id="camera_videos" style="height: <?=$GLOBALS['CAMERA_THUMBNAIL_SIZE']['IMAGES']['Y']?>px;">
      <? foreach($videos as $name => $file):?>
        <img src="/camera_show/image_thumbnail/<?=h($name)?>.png" alt="<?=$name?>" title="<?=$name?>" />
      <? endforeach?>
    </div>

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