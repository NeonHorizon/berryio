
<script type="text/javascript">

  function cameraTakeImage(id, value) {

    if(value == 1) {
      setTimeout(function(){updateButtonMomentary('', id, 2, 'cameraTakeImage')}, 1000);
    }
    if(value == 2) {
      setTimeout(function(){updateButtonMomentary('', id, 0, '')}, 1000);
    }


    return value;
  }

</script>
