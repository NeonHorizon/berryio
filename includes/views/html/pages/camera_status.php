
<div class="panel">

  <h2>CAMERA SETTINGS</h2>

  <?=view('modules/camera/controls', array('type' => 'COMMON', 'control' => 'Settings'))?>
  <?=view('modules/camera/controls', array('type' => 'VIDEOS', 'control' => 'Video'))?>
  <?=view('modules/camera/controls', array('type' => 'IMAGES', 'control' => 'Images'))?>

</div>

<div class="panel">

  <h2>VIEWFINDER</h2>

  <div class="container camera_viewfinder" style="width: <?=$GLOBALS['CAMERA_VIEWFINDER']['X']?>px; height: <?=$GLOBALS['CAMERA_VIEWFINDER']['Y']?>px;">
    <img id="camera_viewfinder" src="/images/camera/default.jpg" alt="" title="" style="max-width: <?=$GLOBALS['CAMERA_VIEWFINDER']['X']?>px; max-height: <?=$GLOBALS['CAMERA_VIEWFINDER']['Y']?>px;" />
  </div><br />

  <?=button_momentary('Take Photo', 'camera_trigger', 'cameraTakeImage', TRUE)?>

</div>

<div class="panel">

  <h2>CAMERA PROCESSING</h2>

  <?=view('modules/camera/controls', array('type' => 'COMMON', 'control' => 'Processing'))?>
  <?=view('modules/camera/controls', array('type' => 'COMMON', 'control' => 'Orientation'))?>
  <?=view('modules/camera/controls', array('type' => 'COMMON', 'control' => 'Effects'))?>

</div>

<div>
  <div class="panel camera_thumbnails">

    <h2>IMAGES</h2>

    <div id="camera_images" style="height: <?=$GLOBALS['CAMERA_THUMBNAIL_SIZE']['IMAGES']['Y']?>px;">
      <? $i = 1; foreach($images as $thumb => $file):?>
        <div id="image_<?=$i?>" class="thumbnail">
          <img src="/camera_show/image_thumbnail/<?=h($thumb)?>" alt="<?=$file?>" title="<?=$file?>" onclick="cameraViewfinderSet('<?=$file?>')" />
          <img class="delete_button" src="/images/layout/delete.png" alt="delete" title="delete" onclick="cameraDelete('image', '<?=$i++?>', '<?=$file?>')" />
        </div>
      <? endforeach?>
    </div>

  </div>
</div>

<div>
  <div class="panel camera_thumbnails">

    <h2>VIDEOS</h2>

    <div id="camera_videos" style="height: <?=$GLOBALS['CAMERA_THUMBNAIL_SIZE']['IMAGES']['Y']?>px;">
      <? $i = 1; foreach($videos as $thumb => $file):?>
        <div id="video_<?=$i?>" class="thumbnail">
          <img src="/camera_show/video_thumbnail/<?=h($thumb)?>" alt="<?=$name?>" title="<?=$name?>" />
          <img class="delete_button" src="/images/layout/delete.png" alt="delete" title="delete" onclick="cameraDelete('video', '<?=$i++?>', '<?=$file?>')" />
        </div>
      <? endforeach?>
    </div>

  </div>
</div>

<div class="panel not_too_wide">

  <h2>HINTS AND TIPS</h2>

  <p class="left">
    <b>VIDEO NOT YET SUPPORTED (COMING SOON)</b>
  </p>

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
