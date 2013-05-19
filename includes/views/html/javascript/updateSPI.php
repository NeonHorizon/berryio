
<script type="text/javascript">

  var changeInProgress = false;

  function updateSPIValues() {
    // Wait until we are not busy
    if(changeInProgress) {
      setTimeout(updateSPIValues, <?=SPI_UPDATE_INTERVAL?>);
      return;
    }

    changeInProgress = true;

    updateHttp = new XMLHttpRequest();
    updateHttp.onreadystatechange = function() {
      if(updateHttp.readyState == 4) {
        if(updateHttp.status == 200) {
          var result = updateHttp.responseText.split('\n');
          if(result[0] == 'OK:') {
            for(line in result) {
              if(line != 0 && result[line] != '') {
                var channelInfo = result[line].split(',');
                value = Math.round(channelInfo[2] / 10.23);
                document.getElementById('spi_adc_'+channelInfo[0]+'_'+channelInfo[1]+'_bar').style.width = value + 'px';
                document.getElementById('spi_adc_'+channelInfo[0]+'_'+channelInfo[1]+'_value').innerHTML = value + '%';
              }
            }
          }
        }
        changeInProgress = false;
        updater = setTimeout(updateSPIValues, <?=SPI_UPDATE_INTERVAL?>);
      }
    }
    updateHttp.open('GET', '/api_command/spi_status', true);
    updateHttp.send();
  }


  function setSPIValue(id, percentage) {
	    // Wait until we are not busy
	    if(changeInProgress) {
	      setTimeout(function(){setSPIValue(id, percentage)}, 50);
	      return;
	    }

	    changeInProgress = true;
      var channelInfo = id.split('_');

	    changeHttp = new XMLHttpRequest();
	    changeHttp.onreadystatechange = function() {
	      if(changeHttp.readyState == 4) {
	        if(changeHttp.status == 200) {
	          var result = changeHttp.responseText.split('\n');
	          if(result[0] == 'OK:') {

	          }
	        }
	        changeInProgress = false;
	      }
	    }
	    changeHttp.open('POST', '/api_command/spi_set_dac_value/' + channelInfo[2] + '/' + channelInfo[3] + '/' + Math.round(percentage * 40.95), true);
	    changeHttp.send();
  }


  updater = setTimeout(updateSPIValues, <?=SPI_UPDATE_INTERVAL?>);

</script>
