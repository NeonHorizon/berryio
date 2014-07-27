<?
/*------------------------------------------------------------------------------
  BerryIO Memory Functions
------------------------------------------------------------------------------*/

/*------------------------------------------------------------------------------
 Load the CPU settings
------------------------------------------------------------------------------*/
require_once(CONFIGS.'cpu.php');


/*----------------------------------------------------------------------------
  Returns the CPU temp in degrees C or FALSE on failure
----------------------------------------------------------------------------*/
function cpu_get_temp()
{
  exec('sudo /usr/bin/vcgencmd measure_temp', $output, $return_var);
  if($return_var) return FALSE;
  foreach($output as $line)
    if(substr($line, 0, 5) == 'temp=')
      return substr($line, 5, -2);
}


/*----------------------------------------------------------------------------
  Returns the CPU clock speed in Hz or FALSE on failure
----------------------------------------------------------------------------*/
function cpu_get_speed()
{
  exec('sudo /usr/bin/vcgencmd measure_clock arm', $output, $return_var);
  if($return_var) return FALSE;
  foreach($output as $line)
    if(substr($line, 0, 14) == 'frequency(45)=')
      return substr($line, 14);
}


/*----------------------------------------------------------------------------
 Returns the CPU voltage or FALSE on failure
----------------------------------------------------------------------------*/
function cpu_get_volts()
{
  exec('sudo /usr/bin/vcgencmd measure_volts', $output, $return_var);
  if($return_var) return FALSE;
  foreach($output as $line)
    if(substr($line, 0, 5) == 'volt=')
      return substr($line, 5, -1);
}

