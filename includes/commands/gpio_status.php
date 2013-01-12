<?
/*------------------------------------------------------------------------------
  BerryIO GPIO Status Command
------------------------------------------------------------------------------*/

$title = 'GPIO Control';

// Load the GPIO functions
require_once(FUNCTIONS.'gpio.php');

// Get the GPIO details
$page['gpio_modes'] = gpio_get_modes();
$page['gpio_values'] = gpio_get_values();

// Display status page
$GLOBALS['JAVASCRIPT'][] = 'getScrollY';
$GLOBALS['JAVASCRIPT_RUN'][] = 'updateGPIOValues';
require_once(FUNCTIONS.'graph.php');
$content .= view('pages/gpio_status', $page);
