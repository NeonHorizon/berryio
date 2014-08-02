<?
/*------------------------------------------------------------------------------
  BerryIO Graphing Functions
------------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------
  Outputs a horizontal bar graph
  Positive indicates whether it flows from red to green or green to red
  $id is postfixed with _bar and _value for the bargraph width and
  percentage respectively
  $set_function, javascript to call with $id and $percentage, makes the graph interactive
  NOTE: There is also a javascript version of this function
----------------------------------------------------------------------------*/
function graph_horizontal_bar($value, $min, $max, $positive = '', $show_percentage = TRUE, $id = '', $set_function = '')
{
  // Load the javascript for setting the graph values if in HTML mode
  if($GLOBALS['EXEC_MODE'] == 'html')
    $GLOBALS['JAVASCRIPT']['graph/updateGraphHorizontalBar'] = 'graph/updateGraphHorizontalBar';

  // Sanity checks
  if((!is_numeric($value) && $value != '') || !is_numeric($min) || !is_numeric($max))
    return $GLOBALS['EXEC_MODE'] == 'html' ? h($value) : $value;

  if($value != '' && ($value > $max || $value < $min || $min >= $max))
    return $GLOBALS['EXEC_MODE'] == 'html' ? h($value) : $value;

  // Calculate and set the colour
  $offset = round((($value - $min) / ($max - $min)) * 255);
  if($positive === TRUE)
    $data['color'] = 'background-color: rgb('.(255 - $offset).', '.$offset.', 0);';
  elseif($positive === FALSE)
    $data['color'] = 'background-color: rgb('.$offset.', '.(255 - $offset).', 0);';
  else
    $data['color'] = '';

  // No functions if we dont have an id!
  $set_function = $id ? $set_function : '';

  // Load the javascript for interactive graphs if need be
  if($set_function)
    $GLOBALS['JAVASCRIPT']['graph/setGraphHorizontalBar'] = 'graph/setGraphHorizontalBar';

  $data['percentage'] = $value != '' ? round((($value - $min) / ($max - $min)) * 100) : '';
  $data['show_percentage'] = $show_percentage;
  $data['id'] = $id;
  $data['set_function'] = $set_function;
  return view('layout/graph/horizontal_bar', $data);
}

