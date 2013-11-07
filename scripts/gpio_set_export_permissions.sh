#!/bin/bash
# BerryIO script to grant the webserver access to the gpio export settings

adduser www-data gpio
chgrp -R gpio /sys/class/gpio/
chmod -R g+w /sys/class/gpio/
