//------------------------------------------------------------------------------
// set_dac SPI module for BerryIO 
//------------------------------------------------------------------------------

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include "berryio_spi.h" 
#include "gb_common.h"


//------------------------------------------------------------------------------
// Display usage information
//------------------------------------------------------------------------------
void usage(char *exec)
{
  fprintf(stderr, "Usage: %s chip_select channel value\n", exec); 
  exit(EXIT_FAILURE);
}


//------------------------------------------------------------------------------
// Set the appropriate DAC output
//------------------------------------------------------------------------------
int main(int argc, char *argv[])
{ 
  char* end;
  long chip_select, channel;
  int value;

  // Check the inputs are present
  if(argc != 4)
    usage(argv[0]);
  
  // Convert and validate the inputs
  chip_select = strtol(argv[1], &end, 10);
  if(*end || chip_select < 0 || chip_select > 1) usage(argv[0]);      
  channel = strtol(argv[2], &end, 10);
  if(*end || channel < 0 || channel > 1) usage(argv[0]);      
  value = strtol(argv[3], &end, 10);
  if(*end || value < 0 || value > 4095) usage(argv[0]);   

  // Map the I/O
  setup_io();

  // Activate the SPI bus pins
  setup_gpio(chip_select);

  // Setup the SPI bus
  setup_spi();

  // Send the value to the DAC
  write_dac(chip_select, channel, value);
  
  // Restore the I/O
  restore_io();
  
  exit(EXIT_SUCCESS);
}
