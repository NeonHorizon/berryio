<?
/*------------------------------------------------------------------------------
  BerryIO Usage Information
------------------------------------------------------------------------------*/

$GLOBALS['USAGE_COMMANDS'] = array(
  'help',
  'about',
  'check_version',
  'changelog',
  'memory_status',
  'disk_status',
  'email_status',
  'gpio_status',
  'lcd_status',
  'spi_status',
  'cpu_status',
  'system_status',
  'network_status',
  'email_ip',
  'upgrade',
  'reboot',
  'shutdown',
  'lcd_initialise',
  array('lcd_position', '<x>', '[<y>]'),
  array('lcd_command', '<command>', '[<command>]', '[<command>]', '[...]'),
  array('lcd_output', '<string>'),
  array('gpio_set_mode', '<pin>|all', 'in|out|not_exported'),
  array('gpio_set_value', '<pin>|all', '<value>'),
  array('spi_set_dac_value', '<chip_select>', '<channel>', '<value>'),
);
