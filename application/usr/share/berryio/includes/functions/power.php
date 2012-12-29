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
  exec('sudo /sbin/shutdown -h now');

  // TO DO - check if this executed successfully
  return TRUE;
}


/*----------------------------------------------------------------------------
  Reboots the system
  Returns FALSE on failure or TRUE on success
----------------------------------------------------------------------------*/
function power_reboot()
{
  exec('sudo /sbin/shutdown -r now');

  // TO DO - check if this executed successfully
  return TRUE;
}
