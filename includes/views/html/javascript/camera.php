
<script type="text/javascript">

  function cameraImagesAdd(file, thumb) {
    cursorBusy();
    var images = document.getElementById('camera_images');
    var id = new Date().getTime();
    images.innerHTML +=
      '<div id="image_' + id + '" class="thumbnail">' +
      '  <img id="image_thumbnail_' + id + '" src="/camera_show/image_thumbnail/' + thumb + '" alt="' + file + '" title="' + file + '" onclick="cameraViewfinderSet(\'' + file + '\')" />' +
      '  <img class="delete_button" src="/images/layout/delete.png" alt="delete" title="delete" onclick="cameraDelete(\'image\', \'' + id + '\', \'' + file + '\')" /> ' +
      '</div>';

    var file_thumbnail = document.getElementById('image_thumbnail_' + id);
    file_thumbnail.onload = function() {
      cursorNormal();
    };
  }


  function cameraViewfinderSet(file, button) {
    if(typeof button === 'undefined') {
      cursorBusy();
    }
    var viewfinder = document.getElementById('camera_viewfinder');
    viewfinder.src = '/camera_show/image/' + file;
    viewfinder.onload = function() {
      if(typeof button === 'undefined') {
        cursorNormal();
      }
      else {
        updateButtonMomentary('', button, 0, '');
      }
    };
  }

  function cameraDelete(type, id, file) {

    if(confirm('Are you sure you want to delete ' + file + ' ?')) {
      var updateHttp = new XMLHttpRequest();
      updateHttp.onreadystatechange = function() {
        if(updateHttp.readyState == 4) {
          if(updateHttp.status == 200) {
            var result = updateHttp.responseText.split('\n');
            if(result[0] == 'OK:') {
              var file = document.getElementById(type + '_' + id);
              file.parentNode.removeChild(file);
            }
            else {
              window.location = '/camera_delete/' + type + '/' + file;
            }
          }
        }
      }
      updateHttp.open('POST', '/api_command/camera_delete/' + type + '/' + file, true);
      updateHttp.send();
    }
  }

  function cameraTakeImage(button, value) {

    cursorBusy();

    var url = '/camera_take_image';
    var optionValue = '';
    var optionControl = '';

    <? foreach($GLOBALS['CAMERA_OPTIONS']['IMAGES'] + $GLOBALS['CAMERA_OPTIONS']['COMMON'] as $group):?>
      <? foreach($group as $option => $details):?>

        <? if($details['type'] == 'percent'):?>
          optionControl = document.getElementById('control_<?=$option?>_value');
          optionValue   = Math.round(optionControl.innerHTML.slice(0, -1) * <?=$details['multiply']?> + <?=$details['offset']?>);
        <? endif?>

        <? if($details['type'] == 'select'):?>
          optionControl = document.getElementById('control_<?=$option?>');
          optionValue   = optionControl.options[optionControl.selectedIndex].value;
        <? endif?>

        <? if($details['type'] == 'on_off'):?>
          optionControl = document.getElementById('control_<?=$option?>_img');
          optionValue = optionControl.title;
        <? endif?>

        url = url + '/-<?=$option?>/' + optionValue;

      <? endforeach?>
    <? endforeach?>

    if(value == 1) {
      var updateHttp = new XMLHttpRequest();
      updateHttp.onreadystatechange = function() {
        if(updateHttp.readyState == 4) {
          if(updateHttp.status == 200) {
            var result = updateHttp.responseText.split('\n');
            if(result[0] == 'OK:') {
              updateButtonMomentary('', button, 2, '');
              cameraViewfinderSet(result[1], button);
              cameraImagesAdd(result[1], result[2]);
            }
            else {
              window.location = url;
            }
          }
        }
      }
      updateHttp.open('POST', '/api_command' + url, true);
      updateHttp.send();
    }

  }


</script>
