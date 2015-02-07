#!/bin/bash
# BerryIO script to grant the webserver access to the gpio virtual devices

adduser www-data gpio
cd -P /sys/class/gpio/gpiochip0/../..
chgrp -R gpio gpio
chmod -R g+w gpio
