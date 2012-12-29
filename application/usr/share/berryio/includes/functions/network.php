<?
/*------------------------------------------------------------------------------
  BerryIO Networking Functions
------------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------
  Fetch a list of network devices and their details

  Output:

    array( [$device => $device_details] [, $device_name => $device_details] [, ...] );

    $device_details = array( [text => $parameter_value] |
                             [bool => TRUE|FALSE] |
                             [value => $parameter_value,
                              min => $parameter_min,
                              max => $parameter_max,
                              positive => TRUE|FALSE]
                           );

----------------------------------------------------------------------------*/
function network_list()
{
  $interfaces = array();

  // Fetch connectivity information from ip command
  $output = array();
  exec('/sbin/ip addr list', $output);
  foreach($output as $line)
  {
    $columns = get_columns($line);

    // Look for new device names
    if(is_numeric($line[0]) && isset($columns[1]))
    {
      // Get device name
      $interface = rtrim($columns[1], ':');

      // Set Defaults
      $interfaces[$interface]['Interface']['text']  = $interface;
      $interfaces[$interface]['Media']['text']      = 'Unknown';
      $interfaces[$interface]['Connected']['bool']  = FALSE;
      $interfaces[$interface]['Link']['bool']       = FALSE;
    }

    // Fetch Mac Address
    if(strpos($line, 'link') !== FALSE && isset($columns[1]))
      $interfaces[$interface]['Mac Address']['text'] = $columns[1];

    // Fetch IP Address (also used to determine if interface is connected)
    if(strpos($line, 'inet') !== FALSE  && isset($columns[1]))
    {
      list($interfaces[$interface]['IP Address']['text']) = explode('/', $columns[1]);
      $interfaces[$interface]['Connected']['bool'] = TRUE;
    }
  }

  // Fetch connectivity information on wireless devices from iwconfig command
  // Should really use iw here but it doesn't work with some cards
  // The reason for the redirect is to ignore non wireless cards
  $output = array();
  exec('/sbin/iwconfig 2>/dev/null', $output);
  foreach($output as $line)
  {
    // Explode out the columns
    $columns = get_columns($line);

    // Look for new device name
    if(isset($line[0]) && $line[0] != ' ')
    {
      // Get device name
      $interface = $columns[0];

      // Set Defaults
      $interfaces[$interface]['Interface']['text'] = $interface;
      $interfaces[$interface]['Media']['text']     = 'Wireless';
    }

    // Fetch Access Point Mac Address
    if(strpos($line, 'Access Point:') !== FALSE)
      $interfaces[$interface]['Link']['bool'] = (strpos($line, 'Not-Associated') === FALSE);

    // Fetch ESSID
    if(strpos($line, 'ESSID') !== FALSE && isset($columns[3]))
      $interfaces[$interface]['ESSID']['text'] = substr($columns[3], 7, -1);

    // Fetch Bit Rate
    if(strpos($line, 'Bit Rate') !== FALSE && isset($columns[1]) && isset($columns[2]))
      $interfaces[$interface]['Bit Rate']['text'] = substr($columns[1], 5).$columns[2];

    // Fetch Link Quality
    if(strpos($line, 'Link Quality') !== FALSE && isset($columns[1]))
    {
      // Is it a ratio?
      if(strpos(substr($columns[1], 8), '/') !== FALSE)
      {
        $interfaces[$interface]['Quality']['text'] = substr($columns[1], 8);
        $interfaces[$interface]['Quality']['min'] = 0;
        $interfaces[$interface]['Quality']['positive'] = TRUE;
        list($interfaces[$interface]['Quality']['value'], $interfaces[$interface]['Quality']['max']) = explode('/', $interfaces[$interface]['Quality']['text']);
      }
      // Do we just have a number? Maybe we are missing the postfix
      elseif(is_numeric(substr($columns[1], 8)))
        $interfaces[$interface]['Quality']['text'] = substr($columns[1], 8).$columns[2];
      else
        $interfaces[$interface]['Quality']['text'] = substr($columns[1], 8);
    }

    // Fetch Signal Level
    if(strpos($line, 'Signal level') !== FALSE && isset($columns[3]))
    {

      // Is it a ratio?
      if(strpos(substr($columns[3], 6), '/') !== FALSE)
      {
        $interfaces[$interface]['Signal']['text'] = substr($columns[3], 6);
        $interfaces[$interface]['Signal']['min'] = 0;
        $interfaces[$interface]['Signal']['positive'] = TRUE;
        list($interfaces[$interface]['Signal']['value'], $interfaces[$interface]['Signal']['max']) = explode('/', $interfaces[$interface]['Signal']['text']);
      }
      // Do we just have a number? Maybe we are missing the postfix
      elseif(is_numeric(substr($columns[3], 6)))
        $interfaces[$interface]['Signal']['text'] = substr($columns[3], 6).$columns[4];
      else
        $interfaces[$interface]['Signal']['text'] = substr($columns[3], 6);

    }

    // Fetch Noise Level
    if(strpos($line, 'Noise level') !== FALSE && isset($columns[5]))
    {
      // Is it a ratio?
      if(strpos(substr($columns[5], 6), '/') !== FALSE)
      {
        $interfaces[$interface]['Noise']['text'] = substr($columns[5], 6);
        $interfaces[$interface]['Noise']['min'] = 0;
        $interfaces[$interface]['Noise']['positive'] = FALSE;
        list($interfaces[$interface]['Noise']['value'], $interfaces[$interface]['Noise']['max']) = explode('/', $interfaces[$interface]['Noise']['text']);
      }
      // Do we just have a number? Maybe we are missing the postfix
      elseif(is_numeric(substr($columns[5], 6)))
        $interfaces[$interface]['Noise']['text'] = substr($columns[5], 6).$columns[6];
      else
        $interfaces[$interface]['Signal']['text'] = substr($columns[3], 6);
    }
  }

  // Fetch connectivity information on wired devices from ethtool command
  foreach($interfaces as $interface => $details)
    // Ignore wireless connections
    if($details['Media']['text'] != 'Wireless')
    {
      $output = array();
      exec('sudo /sbin/ethtool '.$interface, $output);

      foreach($output as $line)
      {
        // Explode out the columns
        $columns = get_columns($line);

        // Fetch Speed
        if(strpos($line, 'Speed') !== FALSE && isset($columns[1]))
        {
          $interfaces[$interface]['Media']['text']    = 'Wired';
          $interfaces[$interface]['Bit Rate']['text'] = $columns[1];
        }

        // Fetch Duplex
        if(strpos($line, 'Duplex') !== FALSE && isset($columns[1]))
        {
          $interfaces[$interface]['Media']['text']  = 'Wired';
          $interfaces[$interface]['Duplex']['text'] = $columns[1];
        }

        // Fetch Link
        if(strpos($line, 'Link') !== FALSE && isset($columns[2]))
        {
          $interfaces[$interface]['Media']['text'] = 'Wired';
          $interfaces[$interface]['Link']['bool']  = ($columns[2] == 'yes');
        }
      }
    }

  // Remove any garbage information
  foreach($interfaces as $interface => $details)
  {
    if(!$interfaces[$interface]['Link']['bool'])
    {
      unset($interfaces[$interface]['Duplex']);
      unset($interfaces[$interface]['Bit Rate']);
      unset($interfaces[$interface]['ESSID']);
      unset($interfaces[$interface]['Quality']);
      unset($interfaces[$interface]['Noise']);
      unset($interfaces[$interface]['Signal']);
    }

    if(!$interfaces[$interface]['Connected']['bool'])
      unset($interfaces[$interface]['IP Address']);
  }

  return $interfaces;
}

