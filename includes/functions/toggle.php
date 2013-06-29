<?
/*------------------------------------------------------------------------------
  BerryIO Toggle Functions
------------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------
  Outputs a on/off toggle
  Positive indicates whether it flows from red to green or green to red
  $id is postfixed with _img for the image
  $set_function, javascript to call with $id and $value, makes the toggle interactive
----------------------------------------------------------------------------*/
function toggle($type, $value, $id = '', $set_function = '')
{
  // Sanity checks
  $value = $value === '' ? $value = 'not_applicable' : $value;
  if($value !== 0 && $value !== 1 && $value !== 'not_applicable')
    return $GLOBALS['EXEC_MODE'] == 'html' ? h($value) : $value;

  // No functions if we dont have an id!
  $set_function = $id ? $set_function : '';

  // Load the javascript for interactive toggles if need be
  if($set_function)
    $GLOBALS['JAVASCRIPT']['graph/toggle/'.$type] = 'toggle/'.$type;

  $data['id'] = $id;
  $data['set_function'] = $set_function;
  $data['value'] = $value;
  return view('layout/toggle/'.$type, $data);
}

