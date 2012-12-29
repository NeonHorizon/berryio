#!/bin/bash
# BerryIO script to grant the webserver access to the gpio export settings

chgrp -R www-data /sys/class/gpio/
chmod -R g+w /sys/class/gpio/
