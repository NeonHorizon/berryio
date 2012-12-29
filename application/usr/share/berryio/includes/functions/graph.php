<?
/*------------------------------------------------------------------------------
  BerryIO Graphing Functions
------------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------
  Outputs a horizontal bar graph suitable for displaying on a web page
  Positive indicates whether it flows from red to green or green to red
  $id is postfixed with _bar and _value for the bargraph width and
  percentage respectively
  $link is postfixed with /<click_value>
----------------------------------------------------------------------------*/
function graph_horizontal_bar($value, $min, $max, $positive = '', $show_percentage = TRUE, $id = '', $link = '')
{
  // Sanity checks
  if(!is_numeric($value) || !is_numeric($min) || !is_numeric($max))
    return EXEC_MODE == 'html' ? h($value) : $value;

  if($value > $max || $value < $min || $min >= $max)
    return EXEC_MODE == 'html' ? h($value) : $value;

  // Calculate the colour
  $offset = round((($value - $min) / ($max - $min)) * 255);
  if($positive === TRUE)
    $data['color'] = 'background-color: rgb('.(255 - $offset).', '.$offset.', 0);';
  elseif($positive === FALSE)
    $data['color'] = 'background-color: rgb('.$offset.', '.(255 - $offset).', 0);';
  else
    $data['color'] = '';

  $data['percentage'] = round((($value - $min) / ($max - $min)) * 100);
  $data['show_percentage'] = $show_percentage;
  $data['id'] = $id;
  $data['link'] = $link;
  return view('layout/graph/horizontal_bar', $data);
}

