<?
/*------------------------------------------------------------------------------
  BerryIO Camera Functions
------------------------------------------------------------------------------*/

/*------------------------------------------------------------------------------
 Load the camera settings
------------------------------------------------------------------------------*/
settings('camera', '1');


/*----------------------------------------------------------------------------
  Check the camera is installed properly and create the image/video folders
----------------------------------------------------------------------------*/
function camera_setup()
{
  // Must be run in CLI mode
  if($GLOBALS['EXEC_MODE'] != 'cli')
    return FALSE;

  echo PHP_EOL;
  echo 'BerryIO Camera Setup'.PHP_EOL;
  echo '--------------------'.PHP_EOL;
  echo PHP_EOL;


  // First check Raspbian has the required pre-requisites
  echo 'Checking for camera support...'.PHP_EOL;
  if(!is_file('/usr/bin/raspistill') || !is_file('/usr/bin/raspivid'))
  {
    echo PHP_EOL;
    echo 'The raspistill and raspivid binaries are missing.'.PHP_EOL;
    echo 'This is most likely because your Raspbian install is out of date.'.PHP_EOL;
    echo PHP_EOL;
    echo 'Please run:'.PHP_EOL;
    echo 'sudo apt-get update'.PHP_EOL;
    echo 'sudo apt-get upgrade'.PHP_EOL;
    echo PHP_EOL;
    echo '...and try again.'.PHP_EOL;
    echo PHP_EOL;
    echo 'If that doesn\'t work try:'.PHP_EOL;
    echo 'sudo apt-get dist-upgrade'.PHP_EOL;
    return FALSE;
  }
  echo 'Success!'.PHP_EOL;

  echo PHP_EOL;


  // Do a test photo
  echo 'Please wait, testing the camera can take stills.... (no photos are kept)'.PHP_EOL;
  exec('raspistill -t 0 -o /dev/null 2>&1', $output, $return_var);
  // Because raspistill doesn't return the correct exit code we have to manually test the output for content
  if(trim(implode('', $output)) != '')
  {
    echo PHP_EOL;
    echo 'An error occured when trying to take a photo.'.PHP_EOL;
    echo 'This could be because your camera is not connected properly,'.PHP_EOL;
    echo 'or it may simply be that you have not yet turned on the camera with raspi-config.'.PHP_EOL;
    echo PHP_EOL;
    echo 'The error returned was as follows:'.PHP_EOL;
    echo implode(PHP_EOL, $output);
    return FALSE;
  }
  echo 'Success!'.PHP_EOL;

  echo PHP_EOL;


  // Do a test video
  echo 'Please wait, testing the camera can take video.... (no video is kept)'.PHP_EOL;
  exec('raspivid -t 1000 -o /dev/null 2>&1', $output, $return_var);
  // Because raspistill doesn't return the correct exit code we have to manually test the output for content
  if(trim(implode('', $output)) != '')
  {
    echo PHP_EOL;
    echo 'An error occured when trying to take video.'.PHP_EOL;
    echo PHP_EOL;
    echo 'The error returned was as follows:'.PHP_EOL;
    echo implode(PHP_EOL, $output);
    return FALSE;
  }
  echo 'Success!'.PHP_EOL;

  echo PHP_EOL;


  // Check GD-Lib is installed
  echo 'Checking support for PHP GD Libraries....'.PHP_EOL;
  $success = FALSE;
  if(!function_exists('imagetypes'))
  {
    echo 'Installing PHP GD Libraries.... (this may take a while)'.PHP_EOL;
    exec('apt-get -y install php5-gd 2>&1', $output, $return_var);
    if($return_var != 0)
    {
      echo PHP_EOL;
      echo 'An error occured when trying to install the package php5-gd.'.PHP_EOL;
      echo PHP_EOL;
      echo 'The error returned was as follows:'.PHP_EOL;
      echo implode(PHP_EOL, $output);
      echo PHP_EOL;
      echo PHP_EOL;
      echo 'Please install it manually and try again'.PHP_EOL;
      return FALSE;
    }
  }
  echo 'Success!'.PHP_EOL;

  echo PHP_EOL;


  // Create the folders required to store the images, videos and thumbnails
  echo 'Creating the folders to store your images and videos....'.PHP_EOL;
  if(!_camera_setup_check_folder($GLOBALS['CAMERA_STORE']['IMAGES']['FILES'], 'images')) return FALSE;
  if(!_camera_setup_check_folder($GLOBALS['CAMERA_STORE']['IMAGES']['THUMBNAILS'], 'image thumbnails')) return FALSE;
  if(!_camera_setup_check_folder($GLOBALS['CAMERA_STORE']['VIDEOS']['FILES'], 'videos')) return FALSE;
  if(!_camera_setup_check_folder($GLOBALS['CAMERA_STORE']['VIDEOS']['THUMBNAILS'], 'video thumbnails')) return FALSE;

  echo PHP_EOL;
  echo 'All your new folders have been successfuly set up.'.PHP_EOL;
  echo 'You can change these at any time by editing '.SETTINGS.'camera.php'.PHP_EOL;
  echo 'and re-running this script.'.PHP_EOL;
  echo PHP_EOL;


  // Modify apache site file
  echo 'Modifying the Apache site configuration....'.PHP_EOL;
  $success = FALSE;
  if(is_file('/etc/apache2/sites-available/berryio'))
    if(($lines = @file('/etc/apache2/sites-available/berryio')) !== FALSE)
      foreach($lines as $line_number => $line)
        if(substr(trim($line), 0, 107) == 'php_admin_value open_basedir "/usr/share/berryio/:/etc/berryio/:/sys/class/gpio/:/sys/devices/virtual/gpio/')
        {
          $lines[$line_number] = '    php_admin_value open_basedir "/usr/share/berryio/:/etc/berryio/:/sys/class/gpio/:/sys/devices/virtual/gpio/';
          $lines[$line_number] .= ':'.$GLOBALS['CAMERA_STORE']['IMAGES']['FILES'].'/';
          $lines[$line_number] .= ':'.$GLOBALS['CAMERA_STORE']['IMAGES']['THUMBNAILS'].'/';
          $lines[$line_number] .= ':'.$GLOBALS['CAMERA_STORE']['VIDEOS']['FILES'].'/';
          $lines[$line_number] .= ':'.$GLOBALS['CAMERA_STORE']['VIDEOS']['THUMBNAILS'].'/';
          $lines[$line_number] .= '"'.PHP_EOL;

          $success = $success == FALSE ? TRUE : FALSE;
        }
  if($success)
    $success = file_put_contents('/etc/apache2/sites-available/berryio', $lines);
  if(!$success)
  {
    echo PHP_EOL;
    echo 'An error occured when trying to modify /etc/apache2/site-available/berryio.'.PHP_EOL;
    echo 'Please add the paths to your image and video folders into the'.PHP_EOL;
    echo 'php_admin_value open_basedir line manually and restart apache'.PHP_EOL;
    return FALSE;
  }
  echo 'Success!'.PHP_EOL;

  echo PHP_EOL;


  // Restart apache
  echo 'Restarting Apache....'.PHP_EOL;
  exec('service apache2 restart 2>&1', $output, $return_var);
  if($return_var != 0)
  {
    echo PHP_EOL;
    echo 'Apache failed to restart!'.PHP_EOL;
    echo PHP_EOL;
    echo 'The output was as follows:'.PHP_EOL;
    echo implode(PHP_EOL, $output);
    return FALSE;
  }
  echo 'Success!'.PHP_EOL;
}


function _camera_setup_check_folder($folder, $purpose)
{
  if(is_dir($folder))
  {
    echo 'Using the existing directory '.$folder.' to store your '.$purpose.'.'.PHP_EOL;
    return TRUE;
  }

  // Check it starts at slash
  if(!isset($folder[0]) || $folder[0] != '/')
  {
    echo PHP_EOL;
    echo 'Your '.$purpose.' folder appears to be invalid?'.PHP_EOL;
    echo 'Please check '.SETTINGS.'camera.php for any mistakes and try again.'.PHP_EOL;
    return FALSE;
  }

  $path = '';
  foreach(explode('/', $folder) as $directory)
    if($directory != '')
    {
      $path .= '/'.$directory;

      // If the folder doesnt exist, create it
      if(!is_dir($path))
        if(!@mkdir($path, 0770) || !chmod($path, 0770)  || !chown($path, 'pi') || !chgrp($path, 'www-data'))
        {
          echo PHP_EOL;
          echo 'An error occured when trying to create the folder:'.PHP_EOL;
          echo $folder.PHP_EOL;
          echo PHP_EOL;
          echo 'Please check '.SETTINGS.'camera.php for any mistakes and try again.'.PHP_EOL;
          return FALSE;
        }
    }

  echo 'Successfuly created the folder: '.$folder.'.'.PHP_EOL;

  return TRUE;
}


/*----------------------------------------------------------------------------
  Get a list of images
  Returns FALSE on failure or
  array( [$file => $thumbnail] [, $file => $thumbnail] [, ...] )
----------------------------------------------------------------------------*/
function camera_images()
{
  return _camera_scan_directory($GLOBALS['CAMERA_STORE']['IMAGES']['FILES'], $GLOBALS['CAMERA_STORE']['IMAGES']['THUMBNAILS'], $GLOBALS['CAMERA_THUMBNAIL_SIZE']['IMAGES']);
}


/*----------------------------------------------------------------------------
  Get a list of videos
  Returns FALSE on failure or
  array( [$file => $thumbnail] [, $file => $thumbnail] [, ...] )
----------------------------------------------------------------------------*/
function camera_videos()
{
  return _camera_scan_directory($GLOBALS['CAMERA_STORE']['VIDEOS']['FILES'], $GLOBALS['CAMERA_STORE']['VIDEOS']['THUMBNAILS'], $GLOBALS['CAMERA_THUMBNAIL_SIZE']['VIDEOS']);
}


/*----------------------------------------------------------------------------
  Get a list from a directory and updates the thumbnails if need be
  Returns FALSE on failure or
  array( [$thumbnail => $file] [, $thumbnail => $file] [, ...] )
----------------------------------------------------------------------------*/
function _camera_scan_directory($directory, $thumbnails, $thumbnail_size)
{
  // Check the directories are set up
  if(!is_dir($directory) || !is_dir($thumbnails)) return FALSE;

  // Scan the directory
  $files = array();
  if(($listing = @scandir($directory)) === FALSE) return FALSE;
  foreach($listing as $file)
    if(!is_dir($directory.'/'.$file)) // Ignore directories
    {
      $file_details = pathinfo($directory.'/'.$file);
      switch($file_details['extension'])
      {
        // Create Thumbnail
        case 'jpg':
        case 'png':
        case 'gif':
          if(_camera_create_image_thumb($directory.'/'.$file, $thumbnails.'/'.$file_details['filename'].'.png', $thumbnail_size))
            $files[$file_details['filename'].'.png'] = $file;
          break;

        case 'h264':
          // NOT YET IMPLIMENTED
          // TO DO
          break;

        // Ignore everything else
        default:
          break;
      }
    }

  // Scan the thumbnails and remove anything that shouldn't be there
  if(($listing = @scandir($thumbnails)) !== FALSE)
    foreach($listing as $file)
      if(!is_dir($directory.'/'.$file)) // Ignore directories
        if(!isset($files[$file]))
        {
          // OK lets remove the thumbnail
          $file_details = pathinfo($directory.'/'.$file);
          @unlink($thumbnails.'/'.$file_details['filename'].'.png');
        }

  return $files;
}


/*----------------------------------------------------------------------------
  Creates an image thumbnail
  Returns FALSE on failure or TRUE on success
----------------------------------------------------------------------------*/
function _camera_create_image_thumb($file, $thumbnail, $thumb_size)
{
  // Check for bad resize
  if(!isset($thumb_size['X']) || !is_numeric($thumb_size['X']) || $thumb_size['X'] < 1 || !isset($thumb_size['Y']) || !is_numeric($thumb_size['Y']) || $thumb_size['Y'] < 1)
    return FALSE;

  // Source file is missing
  if(!is_file($file))
    return FALSE;

  // Already exists
  if(is_file($thumbnail))
    return TRUE;

  // Create a zero byte thumbnail to stop race conditions where two people view the site at once and try to create thumbnails at once
  if(!@touch($thumbnail))
    return FALSE;

  // Get the file information
  list($source_x, $source_y, $type) = getimagesize($file);

  // Check gd support for PNG's (which we need for the thumbnail) and the image we are making into a thumb and get it
  $supported = imagetypes();
  if(!$supported & IMG_PNG) return FALSE;
  switch($type)
  {
    case IMAGETYPE_JPEG:
      if($supported & IMG_JPG)
        $img = imagecreatefromjpeg($file);
      break;

    case IMAGETYPE_PNG:
      if($supported & IMG_PNG)
        $img = imagecreatefrompng($file);
      break;

    case IMAGETYPE_GIF:
      if($supported & IMG_GIF)
        $img = imagecreatefromgif($file);
      break;
  }

  if(!isset($img) || !$img)
  {
    @unlink($thumbnail);
    return FALSE;
  }

  // Calculate scale
  $x_scale = $source_x/$thumb_size['X'];
  $y_scale = $source_y/$thumb_size['Y'];
  $scale   = $y_scale > $x_scale ? $y_scale : $x_scale;
  $thumb_x = round($source_x/$scale);
  $thumb_y = round($source_y/$scale);

  // Create new image
  if(($thumb_img = imagecreatetruecolor($thumb_x, $thumb_y)) === FALSE)
  {
    @unlink($thumbnail);
    return FALSE;
  }

  if(!($success = imagecopyresampled($thumb_img, $img, 0, 0, 0, 0, $thumb_x, $thumb_y, $source_x, $source_y) && imagepng($thumb_img, $thumbnail)))
    @unlink($thumbnail);

  @imagedestroy($img);
  @imagedestroy($thumb_img);

  return $success;
}
