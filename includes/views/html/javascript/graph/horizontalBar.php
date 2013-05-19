
<script type="text/javascript">

  var mouseStatus = false;
  document.onmouseup = function() {
    mouseStatus = false;
  };

  function updateGraphHorizontalBar(event, id, mouseDown, set_function) {    
    event.draggable = false;
    if(event.preventDefault) event.preventDefault();
    event.returnValue = false;

    if(mouseStatus || mouseDown)
    {
      var percentage = document.getElementById(id + '_slider').offsetLeft +  event.offsetX;

      if( percentage > 100 ) percentage = 100;
      if( percentage < 0 ) percentage = 0;

      document.getElementById(id + '_slider').style.left = (percentage - 25) + 'px';
      document.getElementById(id + '_value').innerHTML = percentage + '%';

      if(set_function) {             
        document.getElementById(id + '_bar').style.width = percentage + 'px';
        window[set_function](id, percentage);
      }
    }

    if(mouseDown === true || mouseDown === false) { mouseStatus = mouseDown; }

    return false;
  }

</script>