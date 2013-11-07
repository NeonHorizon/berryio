#!/bin/bash
# BerryIO script to grant the webserver access to the gpio virtual devices

adduser www-data gpio
chgrp -R gpio /sys/devices/virtual/gpio
chmod -R g+w /sys/devices/virtual/gpio
