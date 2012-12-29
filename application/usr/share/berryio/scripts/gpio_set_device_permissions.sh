#!/bin/bash
# BerryIO script to grant the webserver access to the gpio virtual devices

chgrp -R www-data /sys/devices/virtual/gpio
chmod -R g+w /sys/devices/virtual/gpio 
