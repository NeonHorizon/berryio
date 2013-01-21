<?
/*------------------------------------------------------------------------------
  BerryIO Board Functions
------------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------
  Fetch information about the board

  Output:

    array( [$title => $information] [, $title => $information] [, ...] );

----------------------------------------------------------------------------*/
function board_get_revision()
{
  exec('cat /proc/cpuinfo', $output);
  foreach($output as $line)
  {
    $columns = explode(':',$line);
    if($columns[0] != '')
      $boardInfo[trim($columns[0])] = trim($columns[1]);
  }

  return $boardInfo;
}
