
<script type="text/javascript">

  var cpuChangeInProgress = false;

  function updateCPUValues() {
    // Wait until we are not busy
    if(cpuChangeInProgress) {
      setTimeout(updateCPUValues, <?=CPU_UPDATE_INTERVAL?>);
      return;
    }

    cpuChangeInProgress = true;

    var updateHttp = new XMLHttpRequest();
    updateHttp.onreadystatechange = function() {
      if(updateHttp.readyState == 4) {
        if(updateHttp.status == 200) {
          var result = updateHttp.responseText.replace('\r', '').split('\n');
          if(result[0] == 'OK:') {
            for(line in result) {
              if(line != 0 && result[line] != '') {
                var cpuInfo = result[line].split(',');
                switch(cpuInfo[0]) {

                  case '1M':
                    document.getElementById('cpu_1m_num').innerHTML = cpuInfo[1];
                    updateGraphHorizontalBar('cpu_1m', 1 - Math.pow(<?=SYSTEM_LOAD_SENSITIVITY?>, -cpuInfo[1]), 0, 1, false, false);
                    break;

                  case '5M':
                    document.getElementById('cpu_5m_num').innerHTML = cpuInfo[1];
                    updateGraphHorizontalBar('cpu_5m', 1 - Math.pow(<?=SYSTEM_LOAD_SENSITIVITY?>, -cpuInfo[1]), 0, 1, false, false);
                    break;

                  case '15M':
                    document.getElementById('cpu_5m_num').innerHTML = cpuInfo[1];
                    updateGraphHorizontalBar('cpu_15m', 1 - Math.pow(<?=SYSTEM_LOAD_SENSITIVITY?>, -cpuInfo[1]), 0, 1, false, false);
                    break;

                  case 'temp':
                    document.getElementById('cpu_temp_num').innerHTML = cpuInfo[1] + '<sup>o</sup>C';
                    updateGraphHorizontalBar('cpu_temp', cpuInfo[1], <?=CPU_TEMP_MIN?>, <?=CPU_TEMP_MAX?>, true, false);
                    break;

                  case 'speed':
                    document.getElementById('cpu_speed_num').innerHTML = siUnit(cpuInfo[1], '', 1000, 0) + 'Hz';
                    updateGraphHorizontalBar('cpu_speed', cpuInfo[1], <?=CPU_SPEED_MIN?>, <?=CPU_SPEED_MAX?>, true, false);
                    break;

                  case 'volt':
                    document.getElementById('cpu_volt_num').innerHTML = cpuInfo[1] + 'V';
                    updateGraphHorizontalBar('cpu_volt', cpuInfo[1], cpuInfo[1] < <?=CPU_VOLT_MIN?> ? cpuInfo[1] : <?=CPU_VOLT_MIN?>, <?=CPU_VOLT_MAX?>, true, false);
                    break;

                }
              }
            }
          }
        }
        cpuChangeInProgress = false;
        var updater = setTimeout(updateCPUValues, <?=CPU_UPDATE_INTERVAL?>);
      }
    }
    updateHttp.open('GET', '/api_command/cpu_status', true);
    updateHttp.send();
  }


  var updater = setTimeout(updateCPUValues, <?=CPU_UPDATE_INTERVAL?>);

</script>
