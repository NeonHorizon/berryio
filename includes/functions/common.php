<?
/*------------------------------------------------------------------------------
  BerryIO General Functions
------------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------
  Returns a formatted message and redirects if supplied and in HTML mode
----------------------------------------------------------------------------*/
function message($message = '', $redirect = '')
{
  if($GLOBALS['EXEC_MODE'] == 'html' && $redirect != '')
    header('Refresh: 5; url=/'.$redirect);

  return view('message', array('message' => $message));
}


/*----------------------------------------------------------------------------
  Returns instructions on how to use BerryIO with error message if supplied
----------------------------------------------------------------------------*/
function usage($error = '', $subset = 'usage')
{
  // Get command list and version information
  require_once(CONFIGS.'usage.php');
  require_once(CONFIGS.'version.php');

  // Get any extra information required
  switch($subset)
  {
    case 'lcd_command':
      require_once(FUNCTIONS.'lcd.php');
      break;
    case 'api':
      require_once(CONFIGS.'api.php');
      break;
  }

  return view('usage/'.$subset, array('error' => $error));
}


/*----------------------------------------------------------------------------
  Load a view supplied with $data and return its content
----------------------------------------------------------------------------*/
function view($view, $data = '', $view_type = '')
{
  if(is_array($data))
    extract($data, EXTR_REFS | EXTR_SKIP);

  // We need to buffer the output so we can send it back
  ob_start();
  require(VIEWS.($view_type == '' ? $GLOBALS['EXEC_MODE'] : $view_type).'/'.$view.'.php');
  $content = ob_get_contents();
  ob_end_clean();

  return $content;
}


/*----------------------------------------------------------------------------
  Executes a command and parameters by redirecting the user to it
  Usage: go_to($command [, $parameter] [, $parameter] [...])
----------------------------------------------------------------------------*/
function go_to()
{
  // Get the command and parameters
  $args = func_get_args();
  if(count($args) < 1) return FALSE;

  // If not in html mode just straight execute the command
  if($GLOBALS['EXEC_MODE'] != 'html')
    return call_user_func_array('command', $args);

  // Construct the link from the arguments
  $link = '';
  foreach($args as $arg)
    $link .= '/'.rawurlencode($arg);

  // Pass on any autoscroll information
  if(isset($_GET['s'])) $link .= '?s='.($_GET['s'] + 0);

  // Redirect
  header('Location: '.$link);
  exit();
}


/*----------------------------------------------------------------------------
  Executes a command by running it and returning the generated content
  Usage: command($command [, $parameter] [, $parameter] [...])
----------------------------------------------------------------------------*/
function command()
{
  // Get the command and parameters
  $args = func_get_args();
  if(($command = array_shift($args)) === NULL) return FALSE;

  // Calculate the command filename
  $command_file = COMMANDS.$command.'.php';

  // Set the default page title
  $GLOBALS['TITLE'] = 'Invalid Command';

  // Check no funny business is going on
  if(substr(realpath($command_file).'/', 0, strlen($command_file)) != $command_file)
  {
    $GLOBALS['SUCCESS'] = FALSE;
    return usage('The requested command "'.$command.'" is invalid');
  }

  // Check the commands exists
  if(!is_file($command_file))
  {
    $GLOBALS['SUCCESS'] = FALSE;
    return usage('The requested command "'.$command.'" does not exist');
  }

  // Check we can read it
  if(!is_readable($command_file))
  {
    $GLOBALS['SUCCESS'] = FALSE;
    return message('The requested command "'.$command.'" cannot be read');
  }

  // Run it
  $content = '';
  if((require_once($command_file)) === FALSE)
    $GLOBALS['SUCCESS'] = FALSE;

  // Return the title and content
  $GLOBALS['TITLE'] = isset($title) ? $title : FALSE;
  return $content;
}


/*----------------------------------------------------------------------------
  Used to seperate out columns from an exec command return the data
----------------------------------------------------------------------------*/
function get_columns($line)
{
  // Explode out the columns
  $columns = array();
  foreach(explode(' ', $line) as $column)
  {
    $column = trim($column);
    if($column != '')
      $columns[] = $column;
  }

  return $columns;
}


/*----------------------------------------------------------------------------
  Format a value to an si unit
  (only does positive powers at the moment, may need to do neg at some point)
  Set mode to 1024 for disk capacities
----------------------------------------------------------------------------*/
function si_unit($value, &$power = '', $mode = 1000, $places = 2)
{
  $symbols = array(0 => '', 1 => 'k', 2 => 'M', 3 => 'G', 4 => 'T', 5 => 'P', 6 => 'E', 7 => 'Z', 8 => 'Y');

  // Find nearest $mode^$power if not specified
  if(!is_numeric($power)) $power = floor(log($value)/log($mode));

  // Return formatted value
  return number_format($value/pow($mode, floor($power)), $places, '.', ',').$symbols[$power];
}


/*----------------------------------------------------------------------------
  Loads a settings file and produces and error if its no good
----------------------------------------------------------------------------*/
function settings($file, $version = '')
{
  if(!is_readable(SETTINGS.$file.'.php'))
  {
    echo view('errors/missing_config', array('file' => $file));
    exit(1);
  }

  require_once(SETTINGS.$file.'.php');

  if(@constant(strtoupper($file).'_SETTINGS_VERSION') != $version)
  {
    echo view('errors/incompatible_config', array('file' => $file));
    exit(1);
  }
}
