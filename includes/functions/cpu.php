<?
/*------------------------------------------------------------------------------
  BerryIO Memory Functions
------------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------
  Returns the CPU temp in degrees C
----------------------------------------------------------------------------*/
function cpu_get_temp()
{
  exec('sudo /usr/bin/vcgencmd measure_temp', $output);
  foreach($output as $line)
    if(substr($line, 0, 5) == 'temp=')
      return substr($line, 5, -2);
}


/*----------------------------------------------------------------------------
  Returns the CPU clock speed in Hz
----------------------------------------------------------------------------*/
function cpu_get_speed()
{
  exec('sudo /usr/bin/vcgencmd measure_clock arm', $output);
  foreach($output as $line)
    if(substr($line, 0, 14) == 'frequency(45)=')
      return substr($line, 14);
}


/*----------------------------------------------------------------------------
 Returns the CPU voltage
----------------------------------------------------------------------------*/
function cpu_get_volts()
{
  exec('sudo /usr/bin/vcgencmd measure_volts', $output);
  foreach($output as $line)
    if(substr($line, 0, 5) == 'volt=')
      return substr($line, 5, -1);
}

