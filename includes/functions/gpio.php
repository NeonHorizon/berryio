<?
/*------------------------------------------------------------------------------
  BerryIO GPIO Functions
------------------------------------------------------------------------------*/

/*------------------------------------------------------------------------------
  Load the GPIO settings and define some of our own
------------------------------------------------------------------------------*/
settings('gpio', 2);
$GLOBALS['GPIO_MODES'] = array('in', 'out', 'not_exported');
$GLOBALS['GPIO_VALUES'] = array(0, 1);


/*----------------------------------------------------------------------------
  Get the current value from a GPIO pin
  Can be used no matter what mode the pin is in
  Returns FALSE on failure and "not_exported", "1" or "0" on success
----------------------------------------------------------------------------*/
function gpio_get_value($pin)
{
  // Check pin number is good and get the current mode
  if(($mode = gpio_get_mode($pin)) === FALSE) return FALSE;

  // Check its exported
  if($mode == 'not_exported') return 'not_exported';

  // There are situations where the GPIO system thinks its in input mode
  // and it isn't because a lower level application has accessed the pin.
  // To make sure thats not the case we need to reset the mode to make sure
  // it really is in input mode. However there is unfortunately a delay
  // between when this is done and when 'value' updates, so this function
  // will return the wrong value first run. But since there appears to be
  // no way to detect if something else was using the pin and we really dont
  // want to slow this function down 'just in case' its simply going to have
  // to return the wrong value the first time
  if($mode == 'in') @file_put_contents('/sys/class/gpio/gpio'.($pin + 0).'/direction', trim($mode));

  // Get and return the value
  if(($value = file_get_contents('/sys/class/gpio/gpio'.($pin + 0).'/value')) === FALSE) return FALSE;
  return trim($value);
}


/*----------------------------------------------------------------------------
  Get the current value from all GPIO pins
  Returns an array with the pin number as the key and the value as the value
  or FALSE on failure
  See above for values
----------------------------------------------------------------------------*/
function gpio_get_values()
{
  foreach($GLOBALS['GPIO_PINS'] as $pin => $name)
    if(($values[$pin] = gpio_get_value($pin)) === FALSE)
      return FALSE;

  return $values;
}


/*----------------------------------------------------------------------------
  Set the given value on a GPIO pin
  Returns FALSE on failure or if the pin is not in out mode, and TRUE on success
----------------------------------------------------------------------------*/
function gpio_set_value($pin, $value)
{
  // Check the value is good
  if(!is_numeric($value) || !in_array($value, $GLOBALS['GPIO_VALUES'])) return FALSE;

  // Trap for all function
  if($pin === 'all')
  {
    $status = TRUE;
    foreach($GLOBALS['GPIO_PINS'] as $pin => $name)
      $status = gpio_set_value($pin, $value) || $status;

    return $status;
  }

  // Check pin number is good and check the current mode is "out"
  if(gpio_get_mode($pin) != 'out') return FALSE;

  // Set the value
  if(@file_put_contents('/sys/class/gpio/gpio'.($pin + 0).'/value', $value) === FALSE)
  {
    // It failed and we are root? Give up...
    if(posix_getuid() == 0) return FALSE;

    // Set the GPIO device file permissions and get ready to try again
    exec('sudo '.SCRIPTS.'gpio_set_device_permissions.sh');
  }

  // There are situations where the GPIO system thinks its in output mode
  // and it isn't because a lower level application has accessed the pin.
  // To make sure thats not the case we are going to check the value was
  // actually written
  $actual = @file_get_contents('/sys/class/gpio/gpio'.($pin + 0).'/value');

  // If fetching the value didn't fail and it matches what we set then we're done
  if($actual !== FALSE && trim($actual) == $value)
    return TRUE;

  // Otherwise reset the direction
  @file_put_contents('/sys/class/gpio/gpio'.($pin + 0).'/direction', 'out');

  // Try again
  return file_put_contents('/sys/class/gpio/gpio'.($pin + 0).'/value', $value) !== FALSE;
}


/*----------------------------------------------------------------------------
  Set the given values to the GPIO pins where the values are in an array
  with the pin number as the key
  Returns the number of pins successfully set
----------------------------------------------------------------------------*/
function gpio_set_values($values)
{
  $count = 0;
  foreach($values as $pin => $value)
    if(gpio_set_value($pin, $value))
      $count++;

  return $count;
}


/*----------------------------------------------------------------------------
  Gets the current mode of a GPIO Pin
  Returns FALSE on failure and "not_exported", "in" or "out" on success
----------------------------------------------------------------------------*/
function gpio_get_mode($pin)
{
  // Check pin number is good
  if(!is_numeric($pin) || !array_key_exists($pin, $GLOBALS['GPIO_PINS'])) return FALSE;

  // Check to see if its not exported
  if(!file_exists('/sys/class/gpio/gpio'.($pin + 0))) return 'not_exported';

  // Get the mode
  if(($mode = file_get_contents('/sys/class/gpio/gpio'.($pin + 0).'/direction')) === FALSE) return FALSE;

  return trim($mode);
}


/*----------------------------------------------------------------------------
  Get the current mode for all GPIO pins
  Returns an array with the pin number as the key and the value as the value
  or FALSE on failure
  See above for values
----------------------------------------------------------------------------*/
function gpio_get_modes()
{
  foreach($GLOBALS['GPIO_PINS'] as $pin => $name)
    if(($modes[$pin] = gpio_get_mode($pin)) === FALSE)
      return FALSE;

  return $modes;
}


/*----------------------------------------------------------------------------
  Sets the mode of a GPIO Pin
  Returns FALSE on failure or TRUE on success
----------------------------------------------------------------------------*/
function gpio_set_mode($pin, $new_mode)
{
  // Trap for all function
  if($pin === 'all')
  {
    // Check the mode is good
    if(!in_array($new_mode, $GLOBALS['GPIO_MODES'])) return FALSE;

    $status = TRUE;

    foreach($GLOBALS['GPIO_PINS'] as $pin => $name)
      $status = gpio_set_mode($pin, $new_mode) && $status;

    return $status;
  }

  // Check pin number is good and get the current mode
  if(($old_mode = gpio_get_mode($pin)) === FALSE) return FALSE;

  // Nothing to do?
  if($new_mode == $old_mode) return TRUE;

  switch($new_mode)
  {
    case 'not_exported':
      // Unexport the pin
      if(@file_put_contents('/sys/class/gpio/unexport', $pin + 0) !== FALSE) return TRUE;

      // It failed and we are root? Give up...
      if(posix_getuid() == 0) return FALSE;

      // Set the GPIO unexport file permissions
      exec('sudo '.SCRIPTS.'gpio_set_export_permissions.sh');

      // Try again
      return file_put_contents('/sys/class/gpio/unexport', $pin + 0) !== FALSE;

    case 'in':
    case 'out':
      // Export if needed
      if($old_mode == 'not_exported')
        // Export the pin
        if(@file_put_contents('/sys/class/gpio/export', $pin + 0) === FALSE)
        {
          // It failed and we are root? Give up...
          if(posix_getuid() == 0) return FALSE;

          // Set the GPIO export file permissions
          exec('sudo '.SCRIPTS.'gpio_set_export_permissions.sh');

          // Try again
          if(file_put_contents('/sys/class/gpio/export', $pin + 0) === FALSE) return FALSE;
        }

      // Set the GPIO device file permissions if required
      if(posix_getuid() != 0) exec('sudo '.SCRIPTS.'gpio_set_device_permissions.sh');

      // Set direction
      return file_put_contents('/sys/class/gpio/gpio'.($pin + 0).'/direction', $new_mode) !== FALSE;

    default:
      return FALSE;
  }
}


/*----------------------------------------------------------------------------
  Set the given modes to the GPIO pins where the modes are in an array
  with the pin number as the key
  Returns the number of pins successfully set
----------------------------------------------------------------------------*/
function gpio_set_modes($modes)
{
  $count = 0;
  foreach($modes as $pin => $mode)
    if(gpio_set_mode($pin, $mode))
      $count++;

  return $count;
}
