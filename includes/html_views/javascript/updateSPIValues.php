
<script type="text/javascript">
  function updateSPIValues()
  {
    if(window.XMLHttpRequest)
    { // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    }
    else
    { // code for IE6, IE5
      xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
    }
    xmlhttp.onreadystatechange=function()
    {
      if(xmlhttp.readyState==4 && xmlhttp.status==200)
      {
        var channels = xmlhttp.responseText.split(',');
        for(channel in channels)
        {
          if(channels[channel] != '')
          {
        	  channelInfo=channels[channel].split(':');
        	  value = Math.round(channelInfo[2] / 10.23);
        	  document.getElementById('spi_adc_'+channelInfo[0]+'_'+channelInfo[1]+'_bar').style.width=value+'px';
        	  document.getElementById('spi_adc_'+channelInfo[0]+'_'+channelInfo[1]+'_value').innerHTML=value+'%';
          }
        }
      }
    }
    xmlhttp.open('GET', '/spi_get_values', true);
    xmlhttp.send();

    t=setTimeout(function(){updateSPIValues()},<?=SPI_UPDATE_INTERVAL?>);
  }

</script>
