#!/bin/bash
# BerryIO upgrade script

# Make sure this script is being run by root
if [[ $EUID -ne 0 ]]; then
   echo "You must be root to upgrade BerryIO" 1>&2
   echo "Try: sudo "$0 1>&2
   exit 1
fi

echo -e "\nBerryIO Upgrader\n----------------"

echo -e "\nRemoving the old application files...."
rm -fr /usr/share/berryio

echo -e "\nCopying in the new application files...."
cp -R application/* / || { echo -e "Upgrade failed!" 1>&2; exit 1; }

echo -e "\nUpdating config files...."
cp config/etc/berryio/menu.php /etc/berryio/menu.php || { echo -e "Upgrade failed!" 1>&2; exit 1; }
cp config/etc/sudoers.d/berryio /etc/sudoers.d/berryio || { echo -e "Upgrade failed!" 1>&2; exit 1; }

echo -e "\nCopying in new config files...."
if [ ! -f /etc/berryio/spi.php ]; then
  cp config/etc/berryio/spi.php /etc/berryio/spi.php || { echo -e "Upgrade failed!" 1>&2; exit 1; }
fi
if [ ! -f /etc/berryio/lcd.php ]; then
  cp config/etc/berryio/lcd.php /etc/berryio/lcd.php || { echo -e "Upgrade failed!" 1>&2; exit 1; }
fi

echo -e "\nRestarting Apache...."
service apache2 restart || { echo -e "Upgrade failed!" 1>&2; exit 1; }

echo -e "\nUpgrade successful!\n"
echo -e "You may need to configure your GPIO settings as described in UPGRADE.README.txt\n"
