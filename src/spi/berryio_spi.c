//------------------------------------------------------------------------------
// Common SPI functions for BerryIO 
//
// Based on Gertboard test code:
// Copyright (C) Gert Jan van Loo & Myra VanInwegen 2012
//
//------------------------------------------------------------------------------

#include "gb_common.h"
#include "berryio_spi.h"


//------------------------------------------------------------------------------
// Set-up the SPI interface
//------------------------------------------------------------------------------
void setup_spi()
{
  // Want to have 1 MHz SPI clock.
  // Assume 250 Mhz system clock
  // So divide 250MHz system clock by 250 to get 1MHz45
  SPI0_CLKSPEED = 250;

  // clear FIFOs and all status bits
  SPI0_CNTLSTAT = SPI0_CS_CLRALL;
  SPI0_CNTLSTAT = SPI0_CS_DONE; // make sure done bit is cleared
}


//------------------------------------------------------------------------------
// Read a value from one of the two ADC channels
//------------------------------------------------------------------------------
int read_adc(int chip_select, int channel)
{ 
  unsigned char v1,v2,rec_c;
  int status,w;
  
  // Set up for single ended, MS comes out first
  v1 = 0xD0 | (channel<<5);
  
  // Delay to make sure chip select is high for a short while
  short_wait();

  // Enable SPI interface: Use chip_select and set activate bit
  SPI0_CNTLSTAT = chip_select|SPI0_CS_ACTIVATE;

  // Write the command into the FIFO so it will
  // be transmitted out of the SPI interface to the ADC
  // We need a 16-bit transfer so we send a command byte
  // folowed by a dummy byte
  SPI0_FIFO = v1;
  SPI0_FIFO = 0; // dummy

  // Wait for SPI to be ready
  // This will take about 16 micro seconds
  do {
     status = SPI0_CNTLSTAT;
  } while ((status & SPI0_CS_DONE)==0);
  SPI0_CNTLSTAT = SPI0_CS_DONE; // clear the done bit

  // Data from the ADC chip should now be in the receiver
  // read the received data
  v1 = SPI0_FIFO;
  v2 = SPI0_FIFO;
  // Combine the 8-bit and 2 bit values into an 10-bit integer
  // NOT!!!  return ((v1<<8)|v2)&0x3FF;
  // I have checked the result and it returns 3 bits in the MS byte not 2!!
  // So I might have my SPI clock/data phase wrong.
  // For now its easier to adapt the results (running out of time)
  return ( (v1<<7) | (v2>>1) ) & 0x3FF;
}


//------------------------------------------------------------------------------
// Write 12 bit value to DAC channel 0 or 1
//------------------------------------------------------------------------------
void write_dac(int chip_select, int channel, int val)
{
  char v1,v2,dummy;
  int status;
  val &= 0xFFF;  // force value in 12 bits

  // Build the first byte: write, channel 0 or 1 bit
  // and the 4 most significant data bits
  v1 = 0x30 | (channel<<7) | (val>>8);
  // Remain the Least Significant 8 data bits
  v2 = val & 0xFF;

  // Delay to have CS high for a short while
  short_wait();

  // Enable SPI: Use chip_select and set activate bit
  SPI0_CNTLSTAT = chip_select|SPI0_CS_ACTIVATE;

  // Send the values
  SPI0_FIFO = v1;
  SPI0_FIFO = v2;

  // Wait for SPI to be ready
  // This will take about 16 micro seconds
  do {
     status = SPI0_CNTLSTAT;
  } while ((status & SPI0_CS_DONE)==0);
  SPI0_CNTLSTAT = SPI0_CS_DONE; // clear the done bit

  // For every transmit there is also data coming back
  // We MUST read that received data from the FIFO
  // even if we do not use it!
  dummy = SPI0_FIFO;
  dummy = SPI0_FIFO;
}


//------------------------------------------------------------------------------
// Setup the GPIO ports for SPI
//------------------------------------------------------------------------------
void setup_gpio(int channel)
{
  if(channel == -1 || channel == 1)
    INP_GPIO(7);  SET_GPIO_ALT(7,0);
  if(channel == -1 || channel == 0)    
    INP_GPIO(8);  SET_GPIO_ALT(8,0);    
  INP_GPIO(9);  SET_GPIO_ALT(9,0);
  INP_GPIO(10); SET_GPIO_ALT(10,0);
  INP_GPIO(11); SET_GPIO_ALT(11,0);
}
