<?
/*------------------------------------------------------------------------------
  BerryIO Email Functions
------------------------------------------------------------------------------*/

/*------------------------------------------------------------------------------
 Load the email settings
------------------------------------------------------------------------------*/
settings('email');


/*----------------------------------------------------------------------------
  Send an email
  Returns FALSE on failure or TRUE on success
----------------------------------------------------------------------------*/
function email_view($subject, $view, $data = '', $to = EMAIL_TO, $from = EMAIL_FROM)
{
  // Generate content
  $content = view($view, $data, 'email');

  // Generate header
  $header = view('layout/header', array('from' => $from), 'email');

  // Send email
  return mail($to, $subject, $content, $header);
}
