<?
/*------------------------------------------------------------------------------
  BerryIO Board Functions
------------------------------------------------------------------------------*/

/*------------------------------------------------------------------------------
  Board settings
------------------------------------------------------------------------------*/
require_once(CONFIGS.'board.php');


/*----------------------------------------------------------------------------
  Fetch information about the board

  Output:

    array( [$section => $section_details] [, $section => $section_details] [, ...] );

    $section_details = array( [$title => $information] [, $title => $information] [, ...] );

    ....or FALSE on failure

----------------------------------------------------------------------------*/
function board_info()
{
  exec('cat /proc/cpuinfo', $output, $return_var);
  if($return_var) return FALSE;

  foreach($output as $line)
  {
    $columns = explode(':', $line);
    if($columns[0] != '' && isset($columns[1]))
    {
      $title = ucwords(trim($columns[0]));
      if(array_key_exists($title, $GLOBALS['BOARD_SECTIONS']))
        $board_info[$GLOBALS['BOARD_SECTIONS'][$title]][$title] = trim($columns[1]);
      else
        $board_info['CPU'][$title] = trim($columns[1]);
    }
  }

  // Calculate Raspberry Pi Revisions
  if(isset($board_info['Hardware']['Revision']) && array_key_exists($board_info['Hardware']['Revision'], $GLOBALS['BOARD_PI_REVISIONS']))
  {
    $pi_info['Raspberry Pi'] = $GLOBALS['BOARD_PI_REVISIONS'][$board_info['Hardware']['Revision']];

    // This is to make sure its at the start
    $board_info = array_merge_recursive($pi_info, $board_info);
  }


  // Get the Firmware information
  unset($output);
  exec('sudo /usr/bin/vcgencmd version', $output, $return_var);
  if(!$return_var)
    $board_info['Firmware'][''] = implode(PHP_EOL, $output);

  return $board_info;
}

