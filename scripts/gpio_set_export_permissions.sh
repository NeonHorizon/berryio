#!/bin/bash
# BerryIO script to grant the webserver access to the gpio export settings

adduser www-data gpio 2> /dev/null
chgrp -R gpio /sys/class/gpio/
chmod -R g+w /sys/class/gpio/
