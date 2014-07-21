<?
/*------------------------------------------------------------------------------
  BerryIO Board Configuration
------------------------------------------------------------------------------*/

// Determines which fields from /proc/cpuinfo should go in the hardware section
$GLOBALS['BOARD_SECTIONS'] = array(
  'Hardware' => 'Hardware',
  'Revision' => 'Hardware',
  'Serial'   => 'Hardware',
);

// Pi revision information based on the /proc/cpuinfo revision information
$GLOBALS['BOARD_PI_REVISIONS'] = array(
  '0002' => array('Model' => 'B',  'Revision' => '1.0', 'Memory' => '256MB', 'Manufacturer' => 'Egoman (?)', 'Notes' => '', ),
  '0003' => array('Model' => 'B',  'Revision' => '1.0', 'Memory' => '256MB', 'Manufacturer' => 'Egoman (?)', 'Notes' => 'Fuses mod and D14 removed', ),
  '0004' => array('Model' => 'B',  'Revision' => '2.0', 'Memory' => '256MB', 'Manufacturer' => 'Sony',       'Notes' => '', ),
  '0005' => array('Model' => 'B',  'Revision' => '2.0', 'Memory' => '256MB', 'Manufacturer' => 'Qisda',      'Notes' => '', ),
  '0006' => array('Model' => 'B',  'Revision' => '2.0', 'Memory' => '256MB', 'Manufacturer' => 'Egoman',     'Notes' => '', ),
  '0007' => array('Model' => 'A',  'Revision' => '2.0', 'Memory' => '256MB', 'Manufacturer' => 'Egoman',     'Notes' => '', ),
  '0008' => array('Model' => 'A',  'Revision' => '2.0', 'Memory' => '256MB', 'Manufacturer' => 'Sony',       'Notes' => '', ),
  '0009' => array('Model' => 'A',  'Revision' => '2.0', 'Memory' => '256MB', 'Manufacturer' => 'Qisda',      'Notes' => '', ),
  '000d' => array('Model' => 'B',  'Revision' => '2.0', 'Memory' => '512MB', 'Manufacturer' => 'Egoman',     'Notes' => '', ),
  '000e' => array('Model' => 'B',  'Revision' => '2.0', 'Memory' => '512MB', 'Manufacturer' => 'Sony',       'Notes' => '', ),
  '000f' => array('Model' => 'B',  'Revision' => '2.0', 'Memory' => '512MB', 'Manufacturer' => 'Qisda',      'Notes' => '', ),
  '0010' => array('Model' => 'B+', 'Revision' => '1.0', 'Memory' => '512MB', 'Manufacturer' => 'Sony',       'Notes' => '', ),  
);
