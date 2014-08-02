
<script type="text/javascript">

  function siUnit(value, power, mode, places) {

    // Defaults
    mode   = typeof mode   !== 'undefined' ? mode   : 1000;
    places = typeof places !== 'undefined' ? places : 2;

    symbols = {0:'', 1:'k', 2:'M', 3:'G', 4:'T', 5:'P', 6:'E', 7:'Z', 8:'Y'};

    // Find nearest mode^power if not specified
    if(typeof power != 'object')
      var power = {val:'X'};
    if(isNaN(parseFloat(power.val)) || !isFinite(power.val))
      power.val = value == 0 ? 0 :Math.floor(Math.log(value)/Math.log(mode));

    // Return formatted value
    value = (value/Math.pow(mode, Math.floor(power.val))).toFixed(places) + symbols[power.val];

    // Return formatted value
    return value;
  }

  function makeLink(string) {
    return string.toLowerCase().replace('&', 'and').replace(/([^0-9a-z])+/g, '_');
  }

</script>
