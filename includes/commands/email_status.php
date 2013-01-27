<?
/*------------------------------------------------------------------------------
  BerryIO Email Status Command
------------------------------------------------------------------------------*/

$title = 'Email Status';

// Load the email settings
settings('email');

// Display status page
$content .= view('pages/email_status');
