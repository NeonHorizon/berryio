
<script type="text/javascript">

  function cameraImagesAdd(file, thumb) {
    var images = document.getElementById('camera_images');
    id = new Date().getTime();
    images.innerHTML +=
      '<div id="image_'+id+'" class="thumbnail">' +
      '  <img id="image_thumbnail_'+id+'" src="/camera_show/image_thumbnail/'+thumb+'" alt="'+file+'" title="'+file+'" onclick="cameraViewfinderSet(\''+file+'\')" />' +
      '  <img class="delete_button" src="/images/layout/delete.png" alt="delete" title="delete" onclick="cameraDelete(\'image\', \''+id+'\', \''+file+'\')" /> ' +
      '</div>';

    var file_thumbnail = document.getElementById('image_thumbnail_'+id);
    file_thumbnail.onload = function() {
      cursorNormal()
    };
  }

  function cameraViewfinderSet(file, button) {
    var viewfinder = document.getElementById('camera_viewfinder');
    viewfinder.src = '/camera_show/image/'+file;
    viewfinder.onload = function() {
      updateButtonMomentary('', button, 0, '')
    };
  }

  function cameraDelete(type, id, file) {

    if(confirm('Are you sure you want to delete '+file+' ?')) {
      updateHttp = new XMLHttpRequest();
      updateHttp.onreadystatechange = function() {
        if(updateHttp.readyState == 4) {
          if(updateHttp.status == 200) {
            var result = updateHttp.responseText.split('\n');
            if(result[0] == 'OK:') {
              var file = document.getElementById(type+'_'+id);
              file.parentNode.removeChild(file);
            }
            else {
              window.location = '/camera_delete/'+type+'/'+file;
            }
          }
        }
      }
      updateHttp.open('POST', '/api_command/camera_delete/'+type+'/'+file, true);
      updateHttp.send();
    }
  }

  function cameraTakeImage(button, value) {

    cursorBusy();

    if(value == 1) {
      updateHttp = new XMLHttpRequest();
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
              window.location = '/camera_take_image';
            }
          }
        }
      }
      updateHttp.open('POST', '/api_command/camera_take_image', true);
      updateHttp.send();
    }

  }


</script>
