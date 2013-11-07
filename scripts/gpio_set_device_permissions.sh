#!/bin/bash
# BerryIO script to grant the webserver access to the gpio virtual devices

adduser www-data gpio 2> /dev/null
chgrp -R gpio /sys/devices/virtual/gpio
chmod -R g+w /sys/devices/virtual/gpio 
