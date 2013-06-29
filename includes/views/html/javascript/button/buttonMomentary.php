
<script type="text/javascript">

  function updateButtonMomentary(event, id, value, set_function) {
    event.draggable = false;
    if(event.preventDefault) event.preventDefault();
    event.returnValue = false;

    var toggle = document.getElementById(id+'_img');
    toggle.src = '/images/layout/button/'+value+'.png';

    if(set_function != '') {
      window[set_function](id, value);
    }

    return false;
  }

</script>
