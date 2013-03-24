<?
/*------------------------------------------------------------------------------
  BerryIO Reboot Command
------------------------------------------------------------------------------*/

$title = 'Power Control';

// Load the power functions
require_once(FUNCTIONS.'power.php');

// Reboot
if($GLOBALS['EXEC_MODE'] == 'html' && isset($_POST['no']))
  go_to('welcome');
elseif($GLOBALS['EXEC_MODE'] == 'html' && !isset($_POST['yes']))
  $content .= view('are_you_sure', array('description' => 'reboot'));
elseif(power_reboot() === FALSE)
{
  $content .= message('ERROR: Cannot reboot the system', 'welcome');
  return FALSE;
}
elseif($GLOBALS['EXEC_MODE'] != 'api')
  $content .= message('See you again shortly!', 'welcome');
