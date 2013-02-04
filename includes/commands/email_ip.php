<?
/*------------------------------------------------------------------------------
  BerryIO Email IP Command
------------------------------------------------------------------------------*/

// Load the network functions
require_once(FUNCTIONS.'network.php');

// Get the network device details
if(($interfaces = network_list()) === FALSE)
{
  $content .= message('ERROR: Unable retrieve networking information');
  return FALSE;
}

// Remove the loopback device and any disconnected devices or devices without IP's
unset($interfaces['lo']);
foreach($interfaces as $interface => $details)
  if(!isset($details['Connected']['bool']) || !$details['Connected']['bool'] || !isset($details['IP Address']['text']))
    unset($interfaces[$interface]);

// Calculate the webserver port
$port = 80;
if(isset($_SERVER['SERVER_PORT']))
  // If this has been triggered by a web page
  $port = $_SERVER['SERVER_PORT'];
else
{
  // If this has been triggered by the CLI
  exec('/usr/sbin/apache2ctl -S 2>/dev/null', $output);
  global $exec;
  $filename = basename($exec);
  foreach($output as $line)
    if(strpos($line, 'port') !== FALSE && strpos($line, $filename) !== FALSE)
    {
      $cols = get_columns($line);
      if(count($cols) >= 2)
        $port = $cols[1];
    }
}
$port = $port == 80 ? '' : ':'.$port;

// Load the email functions
require_once(FUNCTIONS.'email.php');

// Send email
if(count($interfaces) < 1)
  $content .= message('No IP address to email at this time');
elseif(email_view(NAME.' IP Address', 'ip', array('interfaces' => $interfaces, 'port' => $port)))
  $content .= message(EMAIL_TO.' has been notified of the '.NAME.' IP address', 'email_status');
else
{
  $content .= message('ERROR: Email could not be sent, please check your logs', 'email_status');
  return FALSE;
}
