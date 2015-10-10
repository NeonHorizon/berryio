<?
/*------------------------------------------------------------------------------
  BerryIO Updating and Version Control Functions
------------------------------------------------------------------------------*/

/*------------------------------------------------------------------------------
  Load the version information
------------------------------------------------------------------------------*/
require_once(CONFIGS.'version.php');


/*----------------------------------------------------------------------------
  Gets the latest release version number
  Returns the version number and date or FALSE on failure
----------------------------------------------------------------------------*/
function version_latest()
{
  // Fetch the current version
  if(($version_info = @file_get_contents(VERSION_URL)) === FALSE)
    return FALSE;

  $version_info = explode(',', $version_info);
  if(count($version_info) != 2)
    return FALSE;

  $version_info[VERSION_NO] = trim($version_info[VERSION_NO]);
  $version_info[VERSION_DATE] = trim($version_info[VERSION_DATE]);

  return $version_info;
}


/*----------------------------------------------------------------------------
  Updates to the latest version (Can only be run in CLI mode)
  Returns FALSE on failure or TRUE on success
  NOTE: Unlike other functions this outputs to the console realtime using
        echo. This is not ideal but it does mean the user can see whats
        going on realtime.
----------------------------------------------------------------------------*/
function version_upgrade()
{
  // Must be run in CLI mode
  if($GLOBALS['EXEC_MODE'] != 'cli')
    return FALSE;

  // Fetch the current version
  if(($latest_version = version_latest()) === FALSE)
  {
    echo 'Unable to fetch the latest version number at this time, are you connected to the Internet?';
    return FALSE;
  }

  // Introduction
  echo PHP_EOL;
  echo 'Current Version: '.$GLOBALS['VERSION_NO'].' ('.$GLOBALS['VERSION_DATE'].')'.PHP_EOL;
  echo 'Latest Version:  '.$latest_version[VERSION_NO].' ('.trim($latest_version[VERSION_DATE]).')'.PHP_EOL;
  echo PHP_EOL;

  // Version check
  if($latest_version[VERSION_NO] == $GLOBALS['VERSION_NO'] && $latest_version[VERSION_DATE] == $GLOBALS['VERSION_DATE'])
    echo 'Your version appears to be the latest.'.PHP_EOL.'We will sync anyway in case there are any minor updates....'.PHP_EOL.PHP_EOL;
  else
    echo 'Your current version appears to be different to the latest version.'.PHP_EOL.'Starting the upgrade process....'.PHP_EOL.PHP_EOL;

  // Sync with github
  echo 'Syncing the application files....'.PHP_EOL;
  exec('cd '.BASE.'; git pull origin master 2>&1', $output, $return_var);
  if($return_var != 0)
  {
    echo 'Failed to sync!'.PHP_EOL.PHP_EOL;
    echo 'The output was as follows:'.PHP_EOL;
    echo implode(PHP_EOL, $output);
    return FALSE;
  }

  // Rename the apache config file if required
  if(file_exists('/etc/apache2/sites-available/berryio'))
  {
    rename('/etc/apache2/sites-available/berryio', '/etc/apache2/sites-available/berryio.conf');
    exec('a2dissite berryio');
    exec('a2ensite berryio');
  }

  // Patch the apache site config file for the new GPIO location and new options line
  $patch_file = '/etc/apache2/sites-available/berryio.conf';
  $patch_example = '/usr/share/berryio/default_config/apache2/sites-available/';
  $patches = array(
    'php_admin_value open_basedir "/usr/share/berryio/:/etc/berryio/:/sys/class/gpio/:/sys/devices/virtual/gpio/"' => 'php_admin_value open_basedir "/usr/share/berryio/:/etc/berryio/:/sys/class/gpio/:/sys/devices/virtual/gpio/:/sys/devices/"',
    'Options Indexes None' => 'Options None'
  );
  if(!file_exists($patch_file))
  {
    echo 'WARNING:'.PHP_EOL.'Your Apache site config file cannot be found, you will need to perform any updates manually.'.PHP_EOL;
    echo 'An example can be found in '.$patch_example.PHP_EOL.PHP_EOL;
  }
  else
  {
    // Get the file
    $contents = file_get_contents($patch_file);

    // Apply the patches
    foreach($patches as $patch_before => $patch_after)
    {
      if(strpos($contents, $patch_before) !== FALSE)
      {
        echo 'Patching the Apache site config file....'.PHP_EOL;
        $contents = strtr($contents, array($patch_before => $patch_after));
        if(file_put_contents($patch_file, $contents) === FALSE)
        {
          echo 'WARNING:'.PHP_EOL.'Your Apache site config file could not be patched, you will need to perform the changes manually.'.PHP_EOL;
          echo 'An example can be found in '.$patch_example.PHP_EOL.PHP_EOL;
        }
      }
      elseif(strpos($contents, $patch_after) === FALSE)
      {
        echo 'WARNING:'.PHP_EOL.'Your Apache site config file is non standard, you will need to perform any updates manually.'.PHP_EOL;
        echo 'An example can be found in '.$patch_example.PHP_EOL.PHP_EOL;
      }
    }
  }


  // Restart apache
  echo 'Restarting Apache....'.PHP_EOL;
  exec('service apache2 restart 2>&1', $output, $return_var);
  if($return_var != 0)
  {
    echo 'Apache failed to restart!'.PHP_EOL.PHP_EOL;
    echo 'The output was as follows:'.PHP_EOL;
    echo implode(PHP_EOL, $output);
    return FALSE;
  }

  echo PHP_EOL.'Upgrade successful!'.PHP_EOL;
  return TRUE;
}
