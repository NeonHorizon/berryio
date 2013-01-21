<?
/*------------------------------------------------------------------------------
  BerryIO Board Functions
------------------------------------------------------------------------------*/

/*------------------------------------------------------------------------------
  Board settings
------------------------------------------------------------------------------*/
$GLOBALS['BOARD_SECTIONS'] = array(
  'Hardware' => 'Hardware',
  'Revision' => 'Hardware',
  'Serial'   => 'Hardware',
);
$GLOBALS['BOARD_PI_REVISIONS'] = array(
  '0002' => 'Model B Revision 1.0',
  '0003' => 'Model B Revision 1.0 + Fuses mod and D14 removed',
  '0004' => 'Model B Revision 2.0 256MB',
  '0005' => 'Model B Revision 2.0 256MB',
  '0006' => 'Model B Revision 2.0 256MB',
  '000f' => 'Model B Revision 2.0 512MB',
);


/*----------------------------------------------------------------------------
  Fetch information about the board

  Output:

    array( [$section => $section_details] [, $section => $section_details] [, ...] );

    $section_details = array( [$title => $information] [, $title => $information] [, ...] );

----------------------------------------------------------------------------*/
function board_info()
{
  exec('cat /proc/cpuinfo', $output);
  foreach($output as $line)
  {
    $columns = explode(':', $line);
    if($columns[0] != '')
    {
      $title = trim($columns[0]);
      if(array_key_exists($title, $GLOBALS['BOARD_SECTIONS']))
        $board_info[$GLOBALS['BOARD_SECTIONS'][$title]][$title] = trim($columns[1]);
      else
        $board_info['CPU'][$title] = trim($columns[1]);
    }
  }

  // Calculate Raspberry Pi Revisions
  if(isset($board_info['Hardware']['Revision']) && array_key_exists($board_info['Hardware']['Revision'], $GLOBALS['BOARD_PI_REVISIONS']))
  {
    $pi_info['Hardware']['Raspberry Pi'] = $GLOBALS['BOARD_PI_REVISIONS'][$board_info['Hardware']['Revision']];

    // This is to make it at the start
    $board_info = array_merge_recursive($pi_info, $board_info);
  }

  return $board_info;
}
