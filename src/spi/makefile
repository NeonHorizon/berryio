#------------------------------------------------------------------------------
# Makefile for BerryIO SPI functions
#------------------------------------------------------------------------------

all : berryio_spi_get_adc berryio_spi_set_dac

clean :
	rm *.o berryio_spi_get_adc berryio_spi_set_dac


#------------------------------------------------------------------------------
# BerryIO Module Executables
#------------------------------------------------------------------------------

berryio_spi_get_adc : berryio_spi_get_adc.o berryio_spi.o gb_common.o 
	gcc -o berryio_spi_get_adc berryio_spi_get_adc.o berryio_spi.o gb_common.o 

berryio_spi_set_dac : berryio_spi_set_dac.o berryio_spi.o gb_common.o 
	gcc -o berryio_spi_set_dac berryio_spi_set_dac.o berryio_spi.o gb_common.o


#------------------------------------------------------------------------------
# BerryIO Module Objects 
#------------------------------------------------------------------------------

berryio_spi_get_adc.o : berryio_spi_get_adc.c berryio_spi.h gb_common.h
	gcc -c berryio_spi_get_adc.c

berryio_spi_set_dac.o : berryio_spi_set_dac.c berryio_spi.h gb_common.h 
	gcc -c berryio_spi_set_dac.c


#------------------------------------------------------------------------------
# BerryIO Shared Objects 
#------------------------------------------------------------------------------

berryio_spi.o : berryio_spi.c berryio_spi.h
	gcc -c berryio_spi.c


#------------------------------------------------------------------------------
# 3rd Party Shared Objects
#------------------------------------------------------------------------------

gb_common.o : gb_common.c gb_common.h
	gcc -c gb_common.c
