
<script type="text/javascript">


  function cameraImagesAdd(thumb, file) {
    var images = document.getElementById('camera_images');
    images.innerHTML += '<img src="/camera_show/image_thumbnail/'+thumb+'" alt="'+file+'" title="'+file+'" onclick="cameraViewfinderSet(\''+file+'\')" />';
  }


  function cameraViewfinderSet(file) {
    var viewfinder = document.getElementById('camera_viewfinder');
    viewfinder.src = '/camera_show/image/'+file;
  }


  function cameraTakeImage(id, value) {

    if(value == 1) {
      updateHttp = new XMLHttpRequest();
      updateHttp.onreadystatechange = function() {
        if(updateHttp.readyState == 4) {
          if(updateHttp.status == 200) {
            var result = updateHttp.responseText.split('\n');
            if(result[0] == 'OK:') {
              updateButtonMomentary('', id, 2, '');
              cameraViewfinderSet(result[1]);
              cameraImagesAdd(result[1], result[2]);
              setTimeout(function(){updateButtonMomentary('', id, 0, '')}, 5000);
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
