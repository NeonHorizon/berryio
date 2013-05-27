<?
/*------------------------------------------------------------------------------
  BerryIO Common Configuration
------------------------------------------------------------------------------*/

// Real name of application
define('REAL_NAME', 'BerryIO');

// Commands which need sudo
$GLOBALS['NEED_SUDO'] = array( 'cpu_status', 'camera_setup', 'system_status', 'network_status', 'email_ip', 'upgrade', 'reboot', 'shutdown', 'lcd_initialise', 'lcd_position', 'lcd_command', 'lcd_output', 'gpio_status', 'gpio_get_values', 'gpio_set_mode', 'gpio_set_value', 'spi_status', 'spi_get_values', 'spi_set_dac_value' );

// Storage for javascripts which need displaying/executing
$GLOBALS['JAVASCRIPT_RUN'] = array();
$GLOBALS['JAVASCRIPT'] = array();
