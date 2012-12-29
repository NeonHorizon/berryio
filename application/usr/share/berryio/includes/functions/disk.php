<?
/*------------------------------------------------------------------------------
  BerryIO Disk Functions
------------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------
  Fetch a list of disk partitions and their details

  Output:

    array( [$parition_path => $partition_details] [, $partition_path => $partition_details] [, ...] );

    $partition_details = array( [text => $parameter_value] |
                                [bool => TRUE|FALSE] |
                                [value => $parameter_value,
                                 min => $parameter_min,
                                 max => $parameter_max,
                                 positive => TRUE|FALSE]
                              );

----------------------------------------------------------------------------*/
function disk_list()
{
  $partitions = array();

  // Fetch partition information from df command
  // I would have used disk_free_space() and disk_total_space() here but
  // there appears to be no way to get a list of partitions in PHP?
  $output = array();
  exec('/bin/df --block-size=1', $output);
  foreach($output as $line)
  {
    $columns = get_columns($line);

    // Only process 6 column rows
    // (This has the bonus of ignoring the first row which is 7)
    if(count($columns) == 6)
    {
      $partition = $columns[5];
      $partitions[$partition]['Partition']['text'] = $partition;
      $partitions[$partition]['FileSystem']['text'] = $columns[0];
      $partitions[$partition]['Temporary']['bool'] = in_array($columns[0], array('tmpfs', 'devtmpfs'));

      if(is_numeric($columns[1]) && is_numeric($columns[2]) && is_numeric($columns[3]))
      {
        // Reset the power unit so it is recalculated based on the size
        unset($power);

        $partitions[$partition]['Size']['text'] = si_unit($columns[1], $power, 1024, 1).'B';
        $partitions[$partition]['Free']['text'] = si_unit($columns[3], $power, 1024, 1).'B';

        $partitions[$partition]['Used']['text'] = si_unit($columns[2], $power, 1024, 1).'B';
        $partitions[$partition]['Used']['min'] = 0;
        $partitions[$partition]['Used']['max'] = $columns[1];
        $partitions[$partition]['Used']['value'] = $columns[2];
        $partitions[$partition]['Used']['positive'] = FALSE;
      }
      else
      {
        // Fallback if we don't get numerical values
        $partitions[$partition]['Size']['text'] = $columns[1];
        $partitions[$partition]['Used']['text'] = $columns[2];
        $partitions[$partition]['Free']['text'] = $columns[3];
      }
    }
  }

  return $partitions;
}
