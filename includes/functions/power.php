<?
/*------------------------------------------------------------------------------
  BerryIO Power Functions
------------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------
  Shuts down the system
  Returns FALSE on failure or TRUE on success
----------------------------------------------------------------------------*/
function power_shutdown()
{
  exec('sudo /sbin/shutdown -h now', $output, $return_var);
  if($return_var) return FALSE;

  return TRUE;
}


/*----------------------------------------------------------------------------
  Reboots the system
  Returns FALSE on failure or TRUE on success
----------------------------------------------------------------------------*/
function power_reboot()
{
  exec('sudo /sbin/shutdown -r now', $output, $return_var);
  if($return_var) return FALSE;

  return TRUE;
}
