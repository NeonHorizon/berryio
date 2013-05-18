<?
/*------------------------------------------------------------------------------
  BerryIO Graphing Functions
------------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------
  Outputs a horizontal bar graph suitable for displaying on a web page
  Positive indicates whether it flows from red to green or green to red
  $id is postfixed with _bar and _value for the bargraph width and
  percentage respectively
  $onclick makes the graph interactive and requires an $id
----------------------------------------------------------------------------*/
function graph_horizontal_bar($value, $min, $max, $positive = '', $show_percentage = TRUE, $id = '', $onclick = '')
{
  // Sanity checks
  if((!is_numeric($value) && $value != '') || !is_numeric($min) || !is_numeric($max))
    return $GLOBALS['EXEC_MODE'] == 'html' ? h($value) : $value;

  if($value != '' && ($value > $max || $value < $min || $min >= $max))
    return $GLOBALS['EXEC_MODE'] == 'html' ? h($value) : $value;

  // Calculate the colour
  $offset = round((($value - $min) / ($max - $min)) * 255);
  if($positive === TRUE)
    $data['color'] = 'background-color: rgb('.(255 - $offset).', '.$offset.', 0);';
  elseif($positive === FALSE)
    $data['color'] = 'background-color: rgb('.$offset.', '.(255 - $offset).', 0);';
  else
    $data['color'] = '';

  // Load the javascript for interactive graphs if need be
  if($onclick) $GLOBALS['JAVASCRIPT']['graph/horizontalBar'] = 'graph/horizontalBar';

  $data['percentage'] = $value != '' ? round((($value - $min) / ($max - $min)) * 100) : '';
  $data['show_percentage'] = $show_percentage;
  $data['id'] = $id;
  $data['onclick'] = $onclick;
  return view('layout/graph/horizontal_bar', $data);
}

