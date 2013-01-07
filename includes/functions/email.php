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
  $content = view($view, $data, EMAIL_VIEWS);

  // Generate header
  $header = view('layout/header', array('from' => $from), EMAIL_VIEWS);

  // Send email
  return mail($to, $subject, $content, $header);
}
