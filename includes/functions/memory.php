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
                               [text => $parameter_value,
                                value => $parameter_value,
                                min => $parameter_min,
                                max => $parameter_max,
                                positive => TRUE|FALSE (indicates if the scale should go from good to bad or bad to good),
                                virtual => TRUE|FALSE (indicates if its virtual or memory or not),
                                absolute => TRUE|FALSE (indicates if scale is just a guide or an absolute percentage)]
                             );

    ....or FALSE on failure

----------------------------------------------------------------------------*/
function memory_list()
{
  // Fixed memory amounts
  $memory_cpu = memory_cpu();
  $memory_gpu = memory_gpu();

  $locations = array();

  // Fetch location information from free command
  // Should probably rewrite this to cat /proc/meminfo
  $output = array();
  exec('/usr/bin/free --bytes', $output, $return_var);
  if($return_var) return FALSE;

  foreach($output as $line)
  {
    $columns = get_columns($line);

    // Only process 4 or more column rows
    // Ignore row with column titles
    if(count($columns) >= 4 && $columns[0] != 'total' && $columns[0] != '-/+')
    {
      $location = rtrim($columns[0], ':');

      // Tidyup abbreviations used in free command
      if($location == 'Mem') $location = 'RAM';

      if(is_numeric($columns[1]) && is_numeric($columns[2]) && is_numeric($columns[3]))
      {
        // Reset the power unit so it is recalculated based on the size
        unset($power);

        // Include onboard GPU memory
        if($memory_cpu && $memory_gpu && $location == 'RAM')
        {
          $reserved = $memory_cpu - $columns[1];
          $used = $columns[2] + $memory_gpu + $reserved;


          // RAM (Total)
          $locations[$location]['Virtual']['bool'] = !($location == 'RAM');
          $locations[$location]['Type']['text'] = $location;

          $locations[$location]['Size']['value'] = $memory_cpu + $memory_gpu;
          $locations[$location]['Size']['text'] = si_unit($memory_cpu + $memory_gpu, $power, 1024, 1).'B';

          $locations[$location]['Free']['value'] = $columns[3];
          $locations[$location]['Free']['text'] = si_unit($columns[3], $power, 1024, 1).'B';

          $locations[$location]['Used']['value'] = $used;
          $locations[$location]['Used']['text'] = si_unit($used, $power, 1024, 1).'B';
          $locations[$location]['Used']['min'] = 0;
          $locations[$location]['Used']['max'] = $memory_cpu + $memory_gpu;
          $locations[$location]['Used']['positive'] = FALSE;
          $locations[$location]['Used']['absolute'] = TRUE;


          // RAM (GPU)
          $locations[$location.' (GPU)']['Virtual']['bool'] = !($location == 'RAM');
          $locations[$location.' (GPU)']['Type']['text'] = $location.' (GPU)';

          $locations[$location.' (GPU)']['Used']['value'] = $memory_gpu;
          $locations[$location.' (GPU)']['Used']['text'] = si_unit($memory_gpu, $power, 1024, 1).'B';
          $locations[$location.' (GPU)']['Used']['min'] = 0;
          $locations[$location.' (GPU)']['Used']['max'] = $columns[3] + $memory_gpu;
          $locations[$location.' (GPU)']['Used']['positive'] = FALSE;
          $locations[$location.' (GPU)']['Used']['absolute'] = FALSE;


          // RAM (Reserved)
          $locations[$location.' (Reserved)']['Virtual']['bool'] = !($location == 'RAM');
          $locations[$location.' (Reserved)']['Type']['text'] = $location.' (Reserved)';

          $locations[$location.' (Reserved)']['Used']['value'] = $reserved;
          $locations[$location.' (Reserved)']['Used']['text'] = si_unit($reserved, $power, 1024, 1).'B';
          $locations[$location.' (Reserved)']['Used']['min'] = 0;
          $locations[$location.' (Reserved)']['Used']['max'] = $columns[3] + $reserved;
          $locations[$location.' (Reserved)']['Used']['positive'] = FALSE;
          $locations[$location.' (Reserved)']['Used']['absolute'] = FALSE;
        }
        else
        {
          $locations[$location]['Virtual']['bool'] = !($location == 'RAM');
          $locations[$location]['Type']['text'] = $location;

          $locations[$location]['Size']['value'] = $columns[1];
          $locations[$location]['Size']['text'] = si_unit($columns[1], $power, 1024, 1).'B';

          $locations[$location]['Free']['value'] = $columns[3];
          $locations[$location]['Free']['text'] = si_unit($columns[3], $power, 1024, 1).'B';

          $locations[$location]['Used']['value'] = $columns[2];
          $locations[$location]['Used']['text'] = si_unit($columns[2], $power, 1024, 1).'B';
          $locations[$location]['Used']['min'] = 0;
          $locations[$location]['Used']['max'] = $columns[1];
          $locations[$location]['Used']['positive'] = FALSE;
          $locations[$location]['Used']['absolute'] = TRUE;
        }

        // If we know the buffers and the cache we can calculate the app
        if(isset($columns[5]) && is_numeric($columns[5]))
        {
          $apps = $columns[1] - $columns[3] - $columns[5];
          $locations[$location.' (Apps)']['Virtual']['bool'] = !($location == 'RAM');
          $locations[$location.' (Apps)']['Type']['text'] = $location.' (Apps)';

          $locations[$location.' (Apps)']['Used']['value'] = $apps;
          $locations[$location.' (Apps)']['Used']['text'] = si_unit($apps, $power, 1024, 1).'B';
          $locations[$location.' (Apps)']['Used']['min'] = 0;
          $locations[$location.' (Apps)']['Used']['max'] = $columns[3] + $apps;
          $locations[$location.' (Apps)']['Used']['positive'] = FALSE;
          $locations[$location.' (Apps)']['Used']['absolute'] = FALSE;
        }

        // Buffer calulations
        if(isset($columns[5]) && is_numeric($columns[5]))
        {
          $locations[$location.' (Buff/Cache)']['Virtual']['bool'] = !($location == 'RAM');
          $locations[$location.' (Buff/Cache)']['Type']['text'] = $location.' (Buffers)';

          $locations[$location.' (Buff/Cache)']['Used']['value'] = $columns[5];
          $locations[$location.' (Buff/Cache)']['Used']['text'] = si_unit($columns[5], $power, 1024, 1).'B';
          $locations[$location.' (Buff/Cache)']['Used']['min'] = 0;
          $locations[$location.' (Buff/Cache)']['Used']['max'] = $columns[3] + $columns[5];
          $locations[$location.' (Buff/Cache)']['Used']['positive'] = FALSE;
          $locations[$location.' (Buff/Cache)']['Used']['absolute'] = FALSE;
        }
        elseif(isset($columns[5]))
          $locations[$location.' (Buff/Cache)']['Used']['text'] = $columns[5];
      }
      else
      {
        // Fallback if we don't get numerical values
        $locations[$location]['Virtual']['bool'] = !($location == 'RAM');
        $locations[$location]['Type']['text'] = $location;

        $locations[$location]['Size']['text'] = $columns[1];
        $locations[$location]['Used']['text'] = $columns[2];
        $locations[$location]['Free']['text'] = $columns[3];
      }

    }
  }

  return $locations;
}


/*----------------------------------------------------------------------------
  Return the memory available to the CPU in bytes or FALSE
----------------------------------------------------------------------------*/
function memory_cpu()
{
  exec('sudo /usr/bin/vcgencmd get_mem arm', $output, $return_var);
  if($return_var) return FALSE;

  foreach($output as $line)
    if(substr($line, 0, 4) == 'arm=' && substr($line, -1) == 'M')
      return substr($line, 4, -1) * 1024 * 1024;

  return FALSE;
}


/*----------------------------------------------------------------------------
  Return the memory available to the GPU in bytes or FALSE
----------------------------------------------------------------------------*/
function memory_gpu()
{
  exec('sudo /usr/bin/vcgencmd get_mem gpu', $output, $return_var);
  if($return_var) return FALSE;

  foreach($output as $line)
    if(substr($line, 0, 4) == 'gpu=' && substr($line, -1) == 'M')
      return substr($line, 4, -1) * 1024 * 1024;

  return FALSE;
}
