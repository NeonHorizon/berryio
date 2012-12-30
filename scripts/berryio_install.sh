#!/bin/bash
# BerryIO setup script

# Make sure this script is being run by root
if [[ $EUID -ne 0 ]]; then
   echo "You must be root to install BerryIO" 1>&2
   echo "Try: sudo "$0 1>&2
   exit 1
fi

echo -e "\nBerryIO Installer\n-----------------"

echo -e "\nInstalling the prerequisites...."
apt-get -y install ethtool msmtp apache2 php5 pwauth git || { echo -e "Install failed!" 1>&2; exit 1; }

echo -e "\nRemoving any old copies of BerryIO...."
rm -fr /usr/share/berryio || { echo -e "Install failed!" 1>&2; exit 1; }

echo -e "\nRetrieving latest copy of BerryIO from GitHub...."
sudo git clone https://github.com/NeonHorizon/berryio.git /usr/share/berryio/

echo -e "\nCopying in the default config...."
cp -R /usr/share/berryio/default_config/apache2 /etc || { echo -e "Install failed!" 1>&2; exit 1; }
cp -R /usr/share/berryio/default_config/berryio /etc || { echo -e "Install failed!" 1>&2; exit 1; }
cp -R /usr/share/berryio/default_config/network /etc || { echo -e "Install failed!" 1>&2; exit 1; }
cp -R /usr/share/berryio/default_config/php5 /etc || { echo -e "Install failed!" 1>&2; exit 1; }
cp -R /usr/share/berryio/default_config/sudoers.d /etc || { echo -e "Install failed!" 1>&2; exit 1; }
if [ ! -f /etc/msmtprc ]; then
  cp /usr/share/berryio/default_config/msmtprc /etc/msmtprc || { echo -e "Upgrade failed!" 1>&2; exit 1; }
fi

echo -e "\nGranting the webserver access to the email configuration...."
chown www-data /etc/msmtprc || { echo -e "Install failed!" 1>&2; exit 1; }

echo -e "\nEnabling the required Apache modules...."
a2enmod rewrite authnz_external || { echo -e "Install failed!" 1>&2; exit 1; }

echo -e "\nEnabling the BerryIO site configuration...."
a2dissite default || { echo -e "Install failed!" 1>&2; exit 1; }
a2ensite berryio || { echo -e "Install failed!" 1>&2; exit 1; }

echo -e "\nRestarting Apache...."
service apache2 restart || { echo -e "Install failed!" 1>&2; exit 1; }

echo -e "\nSetting up the BerryIO command line...."
rm -f /usr/bin/berryio # Just in case any older versions are present
ln -s /usr/share/berryio/scripts/berryio.php /usr/bin/berryio || { echo -e "Install failed!" 1>&2; exit 1; }

echo -e "\nInstall successful!"
echo -e "Now configure your email and GPIO settings as described in /usr/share/berryio/INSTALL.README.txt\n"
