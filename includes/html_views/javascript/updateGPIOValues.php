
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
        var pins = xmlhttp.responseText.split(',');
        for(pin in pins)
        {
          if(pins[pin] != '')
          {
        	  pinInfo=pins[pin].split(':');
        	  document.getElementById('pin_'+pinInfo[0]+'_value').src='/images/gpio/value/'+pinInfo[1]+'.png';
          }
        }
      }
    }
    xmlhttp.open('GET', '/gpio_get_values', true);
    xmlhttp.send();

    t=setTimeout(function(){updateGPIOValues()},<?=GPIO_UPDATE_INTERVAL?>);
  }

</script>
