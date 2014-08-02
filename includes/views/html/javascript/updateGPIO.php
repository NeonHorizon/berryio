
<script type="text/javascript">

  var GPIOChangeInProgress = false;

  function updateGPIOPins() {
    // Wait until we are not busy
    if(GPIOChangeInProgress) {
      setTimeout(updateGPIOPins, <?=GPIO_UPDATE_INTERVAL?>);
      return;
    }

    var updateHttp = new XMLHttpRequest();
    updateHttp.onreadystatechange = function() {
      if(updateHttp.readyState == 4) {
        if(updateHttp.status == 200) {
          var result = updateHttp.responseText.replace('\r', '').split('\n');
          if(result[0] == 'OK:') {
            for(line in result) {
              if(line != 0 && result[line] != '') {
                var pinInfo = result[line].split(',');
                updateGPIOPin(pinInfo[0], pinInfo[1], pinInfo[2]);
              }
            }
          }
        }
        updater = setTimeout(updateGPIOPins, <?=GPIO_UPDATE_INTERVAL?>);
      }
    }
    updateHttp.open('POST', '/api_command/gpio_status', true);
    updateHttp.send();
  }


  function updateGPIOPin(pin, mode, value)
  {
    // Mode switch
    var modeIndicator = document.getElementById('pin_'+pin+'_mode');
    modeIndicator.src = '/images/gpio/mode/'+mode+'.png';
    modeIndicator.title =  mode.replace('_', ' ');
    modeIndicator.alt = modeIndicator.title;

    // Indicator light
    var valueIndicator = document.getElementById('pin_'+pin+'_value');
    valueIndicator.src = '/images/layout/indicator/'+value+'.png';
    valueIndicator.title = value.replace('0', 'off').replace('1', 'on').replace('not_exported', '');
    valueIndicator.alt = valueIndicator.title;

    // Toggle
    var toggleIndicator = document.getElementById('pin_'+pin+'_toggle');
    var toggleOn = document.getElementById('pin_'+pin+'_toggle_on');
    var toggleOff = document.getElementById('pin_'+pin+'_toggle_off');
    if(mode != 'out' || value == 'not_exported') {
      toggleIndicator.src = '/images/layout/toggle/vertical_on_off/not_applicable.png';
      toggleIndicator.title = '';
      toggleOn.style.visibility = 'hidden';
      toggleOff.style.visibility = 'hidden';
    }
    else {
      toggleIndicator.src = '/images/layout/toggle/vertical_on_off/'+value+'.png';
      toggleIndicator.title = valueIndicator.title;
      toggleOn.style.visibility = 'visible';
      toggleOff.style.visibility = 'visible';
    }
    toggleIndicator.alt = toggleIndicator.title;
  }

  function setGPIOMode(pin, mode) {
    // Wait until we are not busy
    if(GPIOChangeInProgress) {
      setTimeout(function(){setGPIOMode(pin, mode)}, 50);
      return;
    }

    GPIOChangeInProgress = true;
    var updateHttp = new XMLHttpRequest();
    updateHttp.onreadystatechange = function() {
      if(updateHttp.readyState == 4) {
        if(updateHttp.status == 200) {
          var result = updateHttp.responseText.replace('\r', '').split('\n');
          if(result[0] == 'OK:') {
            updateGPIOPin(pin, mode, 'not_exported');
          }
        }
        GPIOChangeInProgress = false;
      }
    }
    updateHttp.open('POST', '/api_command/gpio_set_mode/'+pin+'/'+mode, true);
    updateHttp.send();
  }

  function setGPIOValue(pin, value) {
    // Wait until we are not busy
    if(GPIOChangeInProgress) {
      setTimeout(function(){setGPIOValue(pin, value)}, 50);
      return;
    }

    GPIOChangeInProgress = true;
    var updateHttp = new XMLHttpRequest();
    updateHttp.onreadystatechange = function() {
      if(updateHttp.readyState == 4) {
        if(updateHttp.status == 200) {
          var result = updateHttp.responseText.replace('\r', '').split('\n');
          if(result[0] == 'OK:') {
            updateGPIOPin(pin, 'out', value);
          }
        }
        GPIOChangeInProgress = false;
      }
    }
    updateHttp.open('POST', '/api_command/gpio_set_value/'+pin+'/'+value, true);
    updateHttp.send();
  }

  updater = setTimeout(updateGPIOPins, <?=GPIO_UPDATE_INTERVAL?>);

</script>
