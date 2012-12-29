//------------------------------------------------------------------------------
// get_adc SPI module for BerryIO 
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
  fprintf(stderr, "Usage: %s [chip_select [channel]]\n", exec); 
  exit(EXIT_FAILURE);
}


//------------------------------------------------------------------------------
// Output the appropriate ADC value
//------------------------------------------------------------------------------
void output_adcs(int chip_select, int channel, int *sent)
{ 
  if(chip_select == -1)
  {
    output_adcs(0, channel, sent);
    chip_select = 1;
  }

  if(channel == -1)
  {
    output_adcs(chip_select, 0, sent);
    channel = 1;  
  }

  if(*sent == 1)
    printf(",");
  printf("%d", read_adc(chip_select, channel));
  *sent = 1;
}


//------------------------------------------------------------------------------
// Output the appropriate ADC value
//------------------------------------------------------------------------------
int main(int argc, char *argv[])
{ 
  int sent;
  char* end;
  long chip_select, channel;
  
  // Set defaults which mean "all"
  chip_select = -1;
  channel = -1;

  // Check the inputs are present and correct
  switch(argc)
  {
    case 3:
      // Check channel
      channel = strtol(argv[2], &end, 10);
      if(*end || channel < 0 || channel > 1) 
        usage(argv[0]);    
  
    case 2:
      // Check chip_select
      chip_select = strtol(argv[1], &end, 10);
      if(*end || chip_select < 0 || chip_select > 1) 
        usage(argv[0]);      
      break;
      
    case 1:
      break;      
  
    default:  
      usage(argv[0]);
  }

  // Map the I/O
  setup_io();

  // Activate the SPI bus pins 
  setup_gpio(chip_select);

  // Setup the SPI bus
  setup_spi();

  // Output ADC values to the CLI
  sent = 0; 
  output_adcs(chip_select, channel, &sent);

  // Restore the I/O
  restore_io();
  
  exit(EXIT_SUCCESS);
}
