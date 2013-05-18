
<script type="text/javascript">

  var mouseStatus = false;

  document.onmousedown = mouseDown;
  document.onmouseup = mouseUp;

  function mouseDown() {
    mouseStatus = true;
  };
  function mouseUp() {
    mouseStatus = false;
  };

  function updateGraphHorizontalBar(event, id) {

    var percentage = event.layerX ? event.layerX - 1 : event.offsetX - document.getElementById(id + '_bar').offsetLeft;

    if( percentage > 100 ) percentage = 100;
    if( percentage < 0 ) percentage = 0;

    document.getElementById(id + '_bar').style.width = percentage + '%';
    document.getElementById(id + '_value').innerHTML = percentage + '%';
  }

</script>