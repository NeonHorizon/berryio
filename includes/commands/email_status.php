<?
/*------------------------------------------------------------------------------
  BerryIO Email Status Command
------------------------------------------------------------------------------*/

// Load the email settings
settings('email');

// Display status page
$content .= view('pages/email_status');
