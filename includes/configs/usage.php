<?
/*------------------------------------------------------------------------------
  BerryIO Usage Information
------------------------------------------------------------------------------*/

$GLOBALS['USAGE_COMMANDS']['General'] = array(
  'help',
  'about',
  'version',
  'upgrade',
);


$GLOBALS['USAGE_COMMANDS']['GPIO Control'] = array(
  'gpio_status',
  array('gpio_set_mode', '<pin>|all', 'in|out|not_exported'),
  array('gpio_set_value', '<pin>|all', '<value>'),
);


$GLOBALS['USAGE_COMMANDS']['Camera Control'] = array(
  'camera_setup',
  'camera_status',
  array('camera_take_image', '[<raspistill short form options>]'),
  array('camera_show', 'image|image_thumbnail|video|video_thumbnail', '<filename>'),
  array('camera_delete', 'image|video', '<filename>'),
);


$GLOBALS['USAGE_COMMANDS']['SPI Control'] = array(
  'spi_status',
  array('spi_set_dac_value', '<chip_select>', '<channel>', '<value>'),
);


$GLOBALS['USAGE_COMMANDS']['LCD Control'] = array(
  'lcd_status',
  'lcd_initialise',
  array('lcd_output', '<string>'),
  array('lcd_position', '<x>', '[<y>]'),
  array('lcd_command', 'help|<command>', '[<command>]', '[<command>]', '[...]'),
);


$GLOBALS['USAGE_COMMANDS']['Email Control'] = array(
  'email_status',
  'email_ip',
);


$GLOBALS['USAGE_COMMANDS']['System Status'] = array(
  'system_status',
  'network_status',
  'cpu_status',
  'memory_status',
  'disk_status',
  'board_status',
);


$GLOBALS['USAGE_COMMANDS']['Power Control'] = array(
  'reboot',
  'shutdown',
);


$GLOBALS['USAGE_COMMANDS']['API'] = array(
  'api_help',
  array('api_command', '<command>', '[<option>]', '[<option>]', '....'),
);


$GLOBALS['USAGE_COMMANDS']['Version Control'] = array(
  'check_version',
  'changelog',
);
