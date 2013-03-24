<?
/*------------------------------------------------------------------------------
  BerryIO Shutdown Command
------------------------------------------------------------------------------*/

$title = 'Power Control';

// Load the power functions
require_once(FUNCTIONS.'power.php');

// Shutdown
if(EXEC_MODE == 'html' && isset($_POST['no']))
  go_to('welcome');
elseif(EXEC_MODE == 'html' && !isset($_POST['yes']))
  $content .= view('are_you_sure', array('description' => 'shutdown'));
elseif(power_shutdown() !== FALSE)
  $content .= message('goodbye...', 'welcome');
else
{
  $content .= message('ERROR: Cannot shutdown the system', 'welcome');
  return FALSE;
}

