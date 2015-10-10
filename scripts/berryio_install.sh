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
apt-get -y install ethtool wireless-tools msmtp apache2 php5 libapache2-mod-php5 pwauth git || { echo -e "Install failed!" 1>&2; exit 1; }

echo -e "\nRemoving any old copies of BerryIO...."
rm -fr /usr/share/berryio || { echo -e "Install failed!" 1>&2; exit 1; }

echo -e "\nRetrieving latest copy of BerryIO from GitHub...."
git clone https://github.com/NeonHorizon/berryio.git /usr/share/berryio/

echo -e "\nCopying in the default config...."
cp -R /usr/share/berryio/default_config/berryio /etc || { echo -e "Install failed!" 1>&2; exit 1; }
cp -R /usr/share/berryio/default_config/apache2 /etc || { echo -e "Install failed!" 1>&2; exit 1; }
cp -R /usr/share/berryio/default_config/php5 /etc || { echo -e "Install failed!" 1>&2; exit 1; }
cp -R /usr/share/berryio/default_config/network /etc || { echo -e "Install failed!" 1>&2; exit 1; }
cp -R /usr/share/berryio/default_config/sudoers.d /etc || { echo -e "Install failed!" 1>&2; exit 1; }
chmod 440 /etc/sudoers.d/berryio || { echo -e "Install failed!" 1>&2; exit 1; }
if [ ! -f /etc/msmtprc ]; then
  cp /usr/share/berryio/default_config/msmtprc /etc/msmtprc || { echo -e "Install failed!" 1>&2; exit 1; }
fi
if [ -f /etc/apache2/sites-available/berryio ]; then
  a2dissite berryio
  rm /etc/apache2/sites-available/berryio
fi

echo -e "\nCreating the log file directories...."
if [ ! -d /var/log/berryio ]; then
  mkdir /var/log/berryio
fi
if [ ! -d /var/log/msmtp ]; then
  mkdir /var/log/msmtp
fi

echo -e "\nGranting the webserver access to the email configuration...."
chmod 640 /etc/msmtprc || { echo -e "Install failed!" 1>&2; exit 1; }
chgrp www-data /etc/msmtprc || { echo -e "Install failed!" 1>&2; exit 1; }

echo -e "\nGranting the webserver access to the GPIO...."
addgroup gpio &> /dev/null
adduser www-data gpio || { echo -e "Install failed!" 1>&2; exit 1; }

echo -e "\nEnabling the required Apache modules...."
a2enmod rewrite authnz_external || { echo -e "Install failed!" 1>&2; exit 1; }

echo -e "\nEnabling the BerryIO site configuration...."
a2dissite default
a2dissite default-ssl.conf
a2ensite berryio || { echo -e "Install failed!" 1>&2; exit 1; }

echo -e "\nRestarting Apache...."
service apache2 restart || { echo -e "Install failed!" 1>&2; exit 1; }

echo -e "\nSetting up the BerryIO command line...."
rm -f /usr/bin/berryio # Just in case any older versions are present
ln -s /usr/share/berryio/scripts/berryio.php /usr/bin/berryio || { echo -e "Install failed!" 1>&2; exit 1; }

echo -e "\n\nConfiguring email settings\n--------------------------\n"
defaultMailTo="pi@localhost"
defaultMailFrom="pi@localhost"
emailConfigured="N";
until [[ "$emailConfigured" =~ ^[yY]$ ]]; do
  read -p "Email address messages should be sent to [$defaultMailTo]: " mailTo
  read -p "Email address messages should be sent from [$defaultMailFrom]: " mailFrom
  if [[ -z "$mailTo" ]]; then
    mailTo="$defaultMailTo"; else
    defaultMailTo="$mailTo"
  fi
  if [[ -z "$mailFrom" ]]; then
    mailFrom="$defaultMailFrom"; else
    defaultMailFrom="$mailFrom"
  fi
  echo -e "\nMail To:   $mailTo\nMail From: $mailFrom\n"
  emailConfigured="X"
  until [[ "$emailConfigured" =~ ^[yYnN]$ || -z "$emailConfigured" ]]; do
    read -p "Is this correct? [y/N]: " -n1 emailConfigured
    echo
  done
done
echo -e "<?\n/*------------------------------------------------------------------------------\n  BerryIO Email Settings\n------------------------------------------------------------------------------*/\n\ndefine('EMAIL_FROM', '$mailFrom');\ndefine('EMAIL_TO', '$mailTo');\n" > /etc/berryio/email.php

echo -e "\n\nConfiguring GPIO settings\n-------------------------"
GPIOConfig="rev2.0";
cat /proc/cpuinfo | grep 'Revision' | grep '0002\|0003' >> /dev/null && GPIOConfig='rev1.0';
cat /proc/cpuinfo | grep 'Revision' | grep '0012' >> /dev/null && GPIOConfig='a_plus';
cat /proc/cpuinfo | grep 'Revision' | grep '0010' >> /dev/null && GPIOConfig='b_plus';
cat /proc/cpuinfo | grep 'Revision' | grep '0011' >> /dev/null && GPIOConfig='compute_module';
echo -e "\nYour Pi has been detected as a $GPIOConfig"
gpioConfigured="N";
until [[ "$gpioConfigured" =~ ^[yY]$ || -z "$gpioConfigured" ]]; do
  gpioConfigured="X";
  echo -e "The GPIO configuration for a $GPIOConfig will be set"
  until [[ "$gpioConfigured" =~ ^[yYnN]$ || -z "$gpioConfigured" ]]; do
    read -p "Is this correct? [Y/n]: " -n1 gpioConfigured
    echo
  done
  if [[ "$gpioConfigured" =~ ^[nN]$ ]]; then
    GPIOConfig='';
    until [[ "$GPIOConfig" = 'rev1.0' ]] || [[ "$GPIOConfig" = 'rev2.0' ]] || [[ "$GPIOConfig" = 'a_plus' ]] || [[ "$GPIOConfig" = 'b_plus' ]] || [[ "$GPIOConfig" = 'compute_module' ]]; do
      read -p "Please enter your Pi variant [rev1.0|rev2.0|a_plus|b_plus|compute_module]: " GPIOConfig
    done
    echo
  fi
done

cp "/usr/share/berryio/default_config/berryio/gpio.$GPIOConfig.example.php" /etc/berryio/gpio.php || { echo -e "Install failed!" 1>&2; exit 1; }

echo -e "\nInstall successful!"
echo -e "Finish the configuration as described in /usr/share/berryio/INSTALL.README.txt"
echo -e "...and you're ready to go!\n"
