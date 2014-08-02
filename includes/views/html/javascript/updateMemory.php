
<script type="text/javascript">

  var memChangeInProgress = false;

  function updateMemValues() {
    // Wait until we are not busy
    if(memChangeInProgress) {
      setTimeout(updateMemValues, <?=MEMORY_UPDATE_INTERVAL?>);
      return;
    }

    memChangeInProgress = true;

    var updateHttp = new XMLHttpRequest();
    updateHttp.onreadystatechange = function() {
      if(updateHttp.readyState == 4) {
        if(updateHttp.status == 200) {
          var result = updateHttp.responseText.replace('\r', '').split('\n');
          if(result[0] == 'OK:') {
            for(line in result) {
              if(line != 0 && result[line] != '') {
                var memInfo = result[line].split(',');
                var id = 'mem_' + makeLink(memInfo[0]);
                var power = {val:''};

                switch(memInfo[0]) {
                  <? foreach($memory_locations as $location => $information):?>
                    <? $id = make_link('mem_'.$location)?>

                    case <?=json_encode($location)?>:
                      updateGraphHorizontalBar('<?=$id?>', memInfo[1], <?=$information['Used']['min']?>, memInfo[2], <?=json_encode(isset($information['Used']['positive']) ? $information['Used']['positive'] : '')?>, <?=json_encode(isset($information['Used']['absolute']) ? $information['Used']['absolute'] : '')?>);
                      document.getElementById('<?=$id?>_size').innerHTML = typeof memInfo[2] !== 'undefined' ? siUnit(memInfo[2], power, 1024, 1) + 'B' : '';
                      document.getElementById('<?=$id?>_used').innerHTML = typeof memInfo[1] !== 'undefined' ? siUnit(memInfo[1], power, 1024, 1) + 'B' : '';
                      document.getElementById('<?=$id?>_free').innerHTML = typeof memInfo[3] !== 'undefined' ? siUnit(memInfo[3], power, 1024, 1) + 'B' : '';
                      break;
                  <? endforeach?>

                }
              }
            }
          }
        }
        memChangeInProgress = false;
        var updater = setTimeout(updateMemValues, <?=MEMORY_UPDATE_INTERVAL?>);
      }
    }
    updateHttp.open('GET', '/api_command/memory_status', true);
    updateHttp.send();
  }


  var updater = setTimeout(updateMemValues, <?=MEMORY_UPDATE_INTERVAL?>);

</script>
