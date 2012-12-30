#!/bin/bash
# BerryIO upgrade script

# Make sure this script is being run by root
if [[ $EUID -ne 0 ]]; then
   echo "You must be root to upgrade BerryIO" 1>&2
   echo "Try: sudo "$0 1>&2
   exit 1
fi

echo -e "\nBerryIO Upgrader\n----------------"

echo -e "\nChanging into the BerryIO application directory...."
cd /usr/share/berryio/ || { echo -e "Upgrade failed!" 1>&2; exit 1; }

echo -e "\nSyncing the application files with github...."
git pull origin master || { echo -e "Upgrade failed!" 1>&2; exit 1; }

echo -e "\nRestarting Apache...."
service apache2 restart || { echo -e "Upgrade failed!" 1>&2; exit 1; }

echo -e "\nUpgrade successful!\n"
