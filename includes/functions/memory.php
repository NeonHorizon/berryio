<?
/*------------------------------------------------------------------------------
  BerryIO Memory Functions
------------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------
  Fetch a list of memory locations and their details

  Output:

    array( [$location => $location_details] [, $location => $location_details] [, ...] );

    $location_details = array( [text => $parameter_value] |
                               [bool => TRUE|FALSE] |
                               [value => $parameter_value,
                                min => $parameter_min,
                                max => $parameter_max,
                                positive => TRUE|FALSE,
                                absolute => TRUE|FALSE (indicates if scale is just a guide or not)]
                             );

    ....or FALSE on failure

----------------------------------------------------------------------------*/
function memory_list()
{
  $locations = array();

  // Fetch location information from free command
  // Should probably rewrite this to cat /proc/meminfo
  $output = array();
  exec('/usr/bin/free --bytes --old', $output, $return_var);
  if($return_var) return FALSE;
  foreach($output as $line)
  {
    $columns = get_columns($line);

    // Only process 4 or more column rows
    // Ignore row with column titles
    if(count($columns) >= 4 && $columns[0] != 'total')
    {
      $location = rtrim($columns[0], ':');
      if($location == 'Mem')
      {
        $location = 'RAM'; // Tidyup abbreviations used in free command
        $locations[$location]['Virtual']['bool'] = FALSE;
      }
      else
        $locations[$location]['Virtual']['bool'] = TRUE;

      $locations[$location]['Memory Location']['text'] = $location;

      if(is_numeric($columns[1]) && is_numeric($columns[2]) && is_numeric($columns[3]))
      {
        // Reset the power unit so it is recalculated based on the size
        unset($power);

        $locations[$location]['Size']['text'] = si_unit($columns[1], $power, 1024, 1).'B';
        $locations[$location]['Free']['text'] = si_unit($columns[3], $power, 1024, 1).'B';
        $locations[$location]['Used']['text'] = si_unit($columns[2], $power, 1024, 1).'B';
        $locations[$location]['Used']['min'] = 0;
        $locations[$location]['Used']['max'] = $columns[1];
        $locations[$location]['Used']['value'] = $columns[2];
        $locations[$location]['Used']['positive'] = FALSE;
        $locations[$location]['Used']['absolute'] = TRUE;

        // If we know the buffers and the cache we can calculate the app
        if(isset($columns[5]) && is_numeric($columns[5]) && is_numeric($columns[6]) && is_numeric($columns[6]))
        {
          $apps = $columns[1] - $columns[3] - $columns[5] - $columns[6];
          $locations[$location.' (Apps)']['Virtual']['bool'] = FALSE;
          $locations[$location.' (Apps)']['Memory Location']['text'] = $location.' (Apps)';
          $locations[$location.' (Apps)']['Used']['text'] = si_unit($apps, $power, 1024, 1).'B';
          $locations[$location.' (Apps)']['Used']['min'] = 0;
          $locations[$location.' (Apps)']['Used']['max'] = $columns[3] + $apps;
          $locations[$location.' (Apps)']['Used']['value'] = $apps;
          $locations[$location.' (Apps)']['Used']['positive'] = FALSE;
          $locations[$location.' (Apps)']['Used']['absolute'] = FALSE;
        }

        // Buffer calulations
        if(isset($columns[5]) && is_numeric($columns[5]))
        {
          $locations[$location.' (Buffers)']['Virtual']['bool'] = FALSE;
          $locations[$location.' (Buffers)']['Memory Location']['text'] = $location.' (Buffers)';
          $locations[$location.' (Buffers)']['Used']['text'] = si_unit($columns[5], $power, 1024, 1).'B';
          $locations[$location.' (Buffers)']['Used']['min'] = 0;
          $locations[$location.' (Buffers)']['Used']['max'] = $columns[3] + $columns[5];
          $locations[$location.' (Buffers)']['Used']['value'] = $columns[5];
          $locations[$location.' (Buffers)']['Used']['positive'] = FALSE;
          $locations[$location.' (Buffers)']['Used']['absolute'] = FALSE;
        }
        elseif(isset($columns[5]))
          $locations[$location.' (Cache)']['Used']['text'] = $columns[5];

        // Cache calulations
        if(isset($columns[6]) && is_numeric($columns[6]))
        {
          $locations[$location.' (Cache)']['Virtual']['bool'] = FALSE;
          $locations[$location.' (Cache)']['Memory Location']['text'] = $location.' (Cache)';
          $locations[$location.' (Cache)']['Used']['text'] = si_unit($columns[6], $power, 1024, 1).'B';
          $locations[$location.' (Cache)']['Used']['min'] = 0;
          $locations[$location.' (Cache)']['Used']['max'] = $columns[3] + $columns[6];
          $locations[$location.' (Cache)']['Used']['value'] = $columns[6];
          $locations[$location.' (Cache)']['Used']['positive'] = FALSE;
          $locations[$location.' (Cache)']['Used']['absolute'] = FALSE;
        }
        elseif(isset($columns[6]))
          $locations[$location.' (Cache)']['Used']['text'] = $columns[6];
      }
      else
      {
        // Fallback if we don't get numerical values
        $locations[$location]['Size']['text'] = $columns[1];
        $locations[$location]['Used']['text'] = $columns[2];
        $locations[$location]['Free']['text'] = $columns[3];
      }

    }
  }

  return $locations;
}
