
<script type="text/javascript">

  function updateGraphHorizontalBar(id, value, min, max, positive, show_percentage) {

    // Defaults
    positive = typeof positive !== 'undefined' ? positive : '';
    show_percentage = typeof show_percentage !== 'undefined' ? show_percentage : true;

    // Get elements
    var element_bar = document.getElementById(id + '_bar');
    var element_value = document.getElementById(id + '_value');

    // Sanity checks
    value = parseFloat(value);
    if(isNaN(value) || value > max || value < min) {
      element_bar.style.width = '0px';
      element_value.innerHTML = '?';
      return false; }

    // Calculate and set the colour
    var offset = Math.round(((value - min) / (max - min)) * 255);
    if(positive === true) {
      element_bar.style.backgroundColor = 'rgb(' + (255 - offset) + ',' + offset + ',0)'; }
    else if(positive === false) {
      element_bar.style.backgroundColor = 'rgb(' + offset + ',' + (255 - offset) + ',0)'; }
    else {
      element_bar.style.backgroundColor = '#0000ff'; }

    // Calculate and set the percentage
    value = Math.round(((value - min) / (max - min)) * 100);
    element_bar.style.width = value + 'px';
    if(show_percentage) {
      element_value.innerHTML = value + '%'; }
  }


</script>
