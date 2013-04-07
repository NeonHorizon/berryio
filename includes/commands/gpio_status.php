<?
/*------------------------------------------------------------------------------
  BerryIO GPIO Status Command
------------------------------------------------------------------------------*/

$title = 'GPIO Control';

// Load the GPIO functions
require_once(FUNCTIONS.'gpio.php');

// Get the GPIO details
if(($page['gpio_modes'] = gpio_get_modes()) === FALSE)
{
  $content .= message('ERROR: Unable retrieve GPIO modes');
  return FALSE;
}

if(($page['gpio_values'] = gpio_get_values()) === FALSE)
{
  $content .= message('ERROR: Unable retrieve GPIO values');
  return FALSE;
}

// Display status page
$GLOBALS['JAVASCRIPT'][] = 'getScrollY';
$GLOBALS['JAVASCRIPT'][] = 'updateGPIO';
require_once(FUNCTIONS.'graph.php');
$content .= view('pages/gpio_status', $page);
