
<script type="text/javascript">

  function updateToggle(event, id, value, set_function) {
    var toggle = document.getElementById(id+'_img');
    toggle.src = '/images/layout/toggle/horizontal_on_off/'+value+'.png';
    if( value == 0 ) { toggle.title = 'off'; }
    if( value == 1 ) { toggle.title = 'on';  }
    if( value == 'not_applicable' ) { toggle.title = 'not applicable'; }
    toggle.alt = toggle.title;
  }

</script>