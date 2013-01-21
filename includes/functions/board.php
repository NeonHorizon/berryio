<?
/*------------------------------------------------------------------------------
  BerryIO Systen Functions
------------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------
  Fetch information about the board

  Output:

    array( [$title => $information] [, $title => $information] [, ...] );

----------------------------------------------------------------------------*/
function system_get_revision()
{
  exec('cat /proc/cpuinfo', $output);
  foreach ($output as $line) {
    $columns = explode(':',$line);
    if($columns[0]!="")
      $boardInfo[$columns[0]] = $columns[1];
  }
  return $boardInfo;
}
