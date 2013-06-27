
HINTS AND TIPS:

  The image and video folder locations are set in the file
  <?=SETTINGS?>camera.php

  The current folder locations are:
  Images: <?=$GLOBALS['CAMERA_STORE']['IMAGES']['FILES']?>

  Videos: <?=$GLOBALS['CAMERA_STORE']['VIDEOS']['FILES']?>


IMAGES:<? if(count($images) > 0):?>
  (<?=count($images)?> taken)

<? else:?>


  No images have been taken yet...
<? endif?>
<? foreach($images as $name => $file):?>
  <?=$file?>

<? endforeach?>

VIDEOS:<? if(count($videos) > 0):?>
  <?=count($videos)?> taken)

<? else:?>


  No videos have been taken yet...
<? endif?>
<? foreach($videos as $name => $file):?>
  <?=$file?>

<? endforeach?>