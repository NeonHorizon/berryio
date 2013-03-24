<?
/*------------------------------------------------------------------------------
  BerryIO Shutdown Command
------------------------------------------------------------------------------*/

$title = 'Power Control';

// Load the power functions
require_once(FUNCTIONS.'power.php');

// Shutdown
if($GLOBALS['EXEC_MODE'] == 'html' && isset($_POST['no']))
  go_to('welcome');
elseif($GLOBALS['EXEC_MODE'] == 'html' && !isset($_POST['yes']))
  $content .= view('are_you_sure', array('description' => 'shutdown'));
elseif(power_shutdown() === FALSE)
{
  $content .= message('ERROR: Cannot shutdown the system', 'welcome');
  return FALSE;
}
elseif($GLOBALS['EXEC_MODE'] != 'api')
  $content .= message('goodbye...', 'welcome');
