<?
/*------------------------------------------------------------------------------
  BerryIO Button Functions
------------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------
  Outputs a momentary button
  $id is postfixed with _img for the image
  $set_function, javascript to call with $id and $value, makes the toggle interactive
  $latch_forever should only be used when the buttons status light will be set by another application
----------------------------------------------------------------------------*/
function button_momentary($name, $id = '', $set_function = '', $latch_forever = FALSE)
{
  // No functions if we dont have an id!
  $set_function = $id ? $set_function : '';

  // Load the javascript for interactive toggles if need be
  if($set_function)
    $GLOBALS['JAVASCRIPT']['button/buttonMomentary'] = 'button/buttonMomentary';

  $data['id'] = $id;
  $data['set_function'] = $set_function;
  $data['name'] = $name;
  $data['latch_forever'] = $latch_forever;
  return view('layout/button/momentary', $data);
}

