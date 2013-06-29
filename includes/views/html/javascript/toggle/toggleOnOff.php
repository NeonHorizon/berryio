
<script type="text/javascript">

  function updateToggleOnOff(event, type, id, value, set_function) {
    var toggle = document.getElementById(id+'_img');
    toggle.src = '/images/layout/toggle/'+type+'_on_off/'+value+'.png';
    if( value == 0 ) { toggle.title = 'off'; }
    if( value == 1 ) { toggle.title = 'on';  }
    if( value == 'not_applicable' ) { toggle.title = 'not applicable'; }
    toggle.alt = toggle.title;

    if(set_function != '') {
      window[set_function](id, value);
    }
  }

</script>
