#!/bin/bash

# Installing Wekan-php. Not tested.
# Please read steps below and make any changes required for your environment.

# 1) Current user and repo to variable
USER=$(whoami)
REPODIR=/home/$USER/repos/w

# 2) Clone repo, go to repo dir
mkdir -p $REPODIR
cd $REPODIR
git clone git@github.com:wekan/php.git
cd php

# 3) Install deps
sudo apt-get install libcurl4-openssl-dev pkg-config libssl-dev apache2-mod-php php-mbstring libgd3
sudo apt install php-pear
sudo pecl channel-update pecl.php.net
sudo pecl install mongodb

# 4) Optional:Add mongo to php.ini
#   sudo echo "extension=mongodb.so" >> /etc/php/7.4/apache2/php.ini

# 5) Symlink repo to Apache
echo $REPODIR | sudo ln -s - /var/www/html/wekan-php

# 6) Add your user to www-data group
sudo usermod -a -G www-data $USER

# 7 Reboot
echo "Please reboot."
