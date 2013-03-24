
<script type="text/javascript">
  function updateGPIOValues()
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
        var pins = xmlhttp.responseText.split('\n');
        if(pins[0] == 'OK:')
        {
          for(pin in pins)
          {
            if(pin != 0 && pins[pin] != '')
            {
          	  pinInfo=pins[pin].split(',');
          	  document.getElementById('pin_'+pinInfo[0]+'_value').src='/images/gpio/value/'+pinInfo[2]+'.png';
            }
          }
        }
      }
    }
    xmlhttp.open('GET', '/api_command/gpio_status', true);
    xmlhttp.send();

    t=setTimeout(function(){updateGPIOValues()},<?=GPIO_UPDATE_INTERVAL?>);
  }

</script>
