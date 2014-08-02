
<script type="text/javascript">

  var diskChangeInProgress = false;

  function updateDiskValues() {
    // Wait until we are not busy
    if(diskChangeInProgress) {
      setTimeout(updateDiskValues, <?=DISK_UPDATE_INTERVAL?>);
      return;
    }

    diskChangeInProgress = true;

    var updateHttp = new XMLHttpRequest();
    updateHttp.onreadystatechange = function() {
      if(updateHttp.readyState == 4) {
        if(updateHttp.status == 200) {
          var result = updateHttp.responseText.replace('\r', '').split('\n');
          if(result[0] == 'OK:') {
            for(line in result) {
              if(line != 0 && result[line] != '') {
                var diskInfo = result[line].split(',');
                var id = 'disk_' + makeLink(diskInfo[0]);
                var power = {val:''};

                switch(diskInfo[0]) {
                  <? foreach($disk_partitions as $partition => $information):?>
                    <? $id = make_link('disk_'.$partition)?>

                    case <?=json_encode($partition)?>:
                      updateGraphHorizontalBar('<?=$id?>', diskInfo[1], <?=$information['Used']['min']?>, diskInfo[2], <?=json_encode(isset($information['Used']['positive']) ? $information['Used']['positive'] : '')?>, true);
                      document.getElementById('<?=$id?>_size').innerHTML = typeof diskInfo[2] !== 'undefined' ? siUnit(diskInfo[2], power, 1024, 1) + 'B' : '';
                      document.getElementById('<?=$id?>_used').innerHTML = typeof diskInfo[1] !== 'undefined' ? siUnit(diskInfo[1], power, 1024, 1) + 'B' : '';
                      document.getElementById('<?=$id?>_free').innerHTML = typeof diskInfo[3] !== 'undefined' ? siUnit(diskInfo[3], power, 1024, 1) + 'B' : '';
                      break;
                  <? endforeach?>

                }
              }
            }
          }
        }
        diskChangeInProgress = false;
        var updater = setTimeout(updateDiskValues, <?=DISK_UPDATE_INTERVAL?>);
      }
    }
    updateHttp.open('GET', '/api_command/disk_status', true);
    updateHttp.send();
  }


  var updater = setTimeout(updateDiskValues, <?=DISK_UPDATE_INTERVAL?>);

</script>
