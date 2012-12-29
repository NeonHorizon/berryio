<?
/*------------------------------------------------------------------------------
  BerryIO Email Status Command
------------------------------------------------------------------------------*/

// Load the email settings
require_once(SETTINGS.'email.php');

// Display status page
$content .= view('pages/email_status');
