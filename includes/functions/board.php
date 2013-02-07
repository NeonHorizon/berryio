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
  '0002' => array('Model' => 'B', 'Revision' => '1.0', 'Memory' => '256MB', 'Manufacturer' => 'Egoman (?)', 'Notes' => '', ),
  '0003' => array('Model' => 'B', 'Revision' => '1.0', 'Memory' => '256MB', 'Manufacturer' => 'Egoman (?)', 'Notes' => 'Fuses mod and D14 removed', ),
  '0004' => array('Model' => 'B', 'Revision' => '2.0', 'Memory' => '256MB', 'Manufacturer' => 'Sony',       'Notes' => '', ),
  '0005' => array('Model' => 'B', 'Revision' => '2.0', 'Memory' => '256MB', 'Manufacturer' => 'Qisda',      'Notes' => '', ),
  '0006' => array('Model' => 'B', 'Revision' => '2.0', 'Memory' => '256MB', 'Manufacturer' => 'Egoman',     'Notes' => '', ),
  '0007' => array('Model' => 'A', 'Revision' => '2.0', 'Memory' => '256MB', 'Manufacturer' => 'Egoman',     'Notes' => '', ),
  '0008' => array('Model' => 'A', 'Revision' => '2.0', 'Memory' => '256MB', 'Manufacturer' => 'Sony',       'Notes' => '', ),
  '0009' => array('Model' => 'A', 'Revision' => '2.0', 'Memory' => '256MB', 'Manufacturer' => 'Qisda',      'Notes' => '', ),
  '000d' => array('Model' => 'B', 'Revision' => '2.0', 'Memory' => '512MB', 'Manufacturer' => 'Egoman',     'Notes' => '', ),
  '000e' => array('Model' => 'B', 'Revision' => '2.0', 'Memory' => '512MB', 'Manufacturer' => 'Sony',       'Notes' => '', ),
  '000f' => array('Model' => 'B', 'Revision' => '2.0', 'Memory' => '512MB', 'Manufacturer' => 'Qisda',      'Notes' => '', ),
);


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
    $pi_info['Raspberry Pi'] = $GLOBALS['BOARD_PI_REVISIONS'][$board_info['Hardware']['Revision']];

    // This is to make sure its at the start
    $board_info = array_merge_recursive($pi_info, $board_info);
  }

  return $board_info;
}
