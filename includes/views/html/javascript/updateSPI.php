
<script type="text/javascript">

  var SPIChangeInProgress = false;

  function updateSPIValues() {
    // Wait until we are not busy
    if(SPIChangeInProgress) {
      setTimeout(updateSPIValues, <?=SPI_UPDATE_INTERVAL?>);
      return;
    }

    SPIChangeInProgress = true;

    var updateHttp = new XMLHttpRequest();
    updateHttp.onreadystatechange = function() {
      if(updateHttp.readyState == 4) {
        if(updateHttp.status == 200) {
          var result = updateHttp.responseText.replace('\r', '').split('\n');
          if(result[0] == 'OK:') {
            for(line in result) {
              if(line != 0 && result[line] != '') {
                var channelInfo = result[line].split(',');
                updateGraphHorizontalBar('spi_adc_' + channelInfo[0] + '_' + channelInfo[1], channelInfo[2], 0, 1023, '', true);
              }
            }
          }
        }
        SPIChangeInProgress = false;
        var updater = setTimeout(updateSPIValues, <?=SPI_UPDATE_INTERVAL?>);
      }
    }
    updateHttp.open('GET', '/api_command/spi_status', true);
    updateHttp.send();
  }


  function setSPIValue(id, percentage) {
	    // Wait until we are not busy
	    if(SPIChangeInProgress) {
	      setTimeout(function(){setSPIValue(id, percentage)}, 50);
	      return;
	    }

	    SPIChangeInProgress = true;
      var channelInfo = id.split('_');

	    var updateHttp = new XMLHttpRequest();
	    updateHttp.onreadystatechange = function() {
	      if(updateHttp.readyState == 4) {
	        if(updateHttp.status == 200) {
	          var result = updateHttp.responseText.replace('\r', '').split('\n');
	          if(result[0] == 'OK:') {

	          }
	        }
	        SPIChangeInProgress = false;
	      }
	    }
	    updateHttp.open('POST', '/api_command/spi_set_dac_value/' + channelInfo[2] + '/' + channelInfo[3] + '/' + Math.round(percentage * 40.95), true);
	    updateHttp.send();
  }


  var updater = setTimeout(updateSPIValues, <?=SPI_UPDATE_INTERVAL?>);

</script>
