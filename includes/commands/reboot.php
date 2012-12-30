<?
/*------------------------------------------------------------------------------
  BerryIO Reboot Command
------------------------------------------------------------------------------*/

// Load the power functions
require_once(FUNCTIONS.'power.php');

// Reboot
if(EXEC_MODE == 'html' && isset($_POST['no']))
  go_to('welcome');
elseif(EXEC_MODE == 'html' && !isset($_POST['yes']))
  $content .= view('are_you_sure', array('description' => 'reboot'));
elseif(power_reboot())
  $content .= message('See you again shortly!', 'welcome');
else
  $content .= message('ERROR: Cannot reboot the system', 'welcome');
