cd ../
cd#!/usr/bin/env bash

sudo apt -y update;
sudo apt -y upgrade;

sudo wget -O $HOME/xamppinstaller.run https://www.apachefriends.org/xampp-files/7.3.13/xampp-linux-x64-7.3.13-0-installer.run
sudo chmod 777 $HOME/xamppinstaller.run;
echo "";
echo "THIS PART MIGHT TAKE A WHILE";
echo "";
sudo $HOME/xamppinstaller.run --mode unattended;
sudo rm $HOME/xamppinstaller.run;

echo 'alias edithosts="sudo nano /etc/hosts"' | sudo tee -a /etc/bashrc;
echo 'alias editvirtualhosts="sudo nano /opt/lampp/etc/extra/httpd-vhosts.conf"' | sudo tee -a /etc/bashrc;
echo 'alias restartServer="sudo /opt/lampp/xampp restart"' | sudo tee -a /etc/bashrc;
echo 'alias startServer="sudo /opt/lampp/xampp start"' | sudo tee -a /etc/bashrc;
echo 'alias stopServer="sudo /opt/lampp/xampp stop"' | sudo tee -a /etc/bashrc;

echo 'source /etc/bashrc' | sudo tee -a ~/.bashrc;
echo 'export PATH=$PATH:/opt/lampp/bin' | sudo tee -a ~/.bashrc;
export PATH=$PATH:/opt/lampp/bin;
source $HOME/.bashrc;

php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'e0012edf3e80b6978849f5eff0d4b4e4c79ff1609dd1e613307e16318854d24ae64f26d17af3ef0bf7cfb710ca74755a') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"

sudo mv composer.phar /usr/local/bin/composer;
composer global require laravel/installer;

echo 'export PATH=$PATH:$HOME/.composer/vendor/bin' | sudo tee -a ~/.bashrc;
export PATH=$PATH:$HOME/.composer/vendor/bin;
source ~/.bashrc;

sudo wget -O $HOME/node.tar.xz https://nodejs.org/dist/v12.16.1/node-v12.16.1-linux-x64.tar.xz;
sudo tar -xJf $HOME/node.tar.xz;
sudo mv $HOME/node-v12.16.1-linux-x64 /node;
echo 'export PATH=$PATH:/node/bin' | sudo tee -a ~/.bashrc;
export PATH=$PATH:/node/bin;

sudo mkdir /projects;
sudo chmod 777 /projects;

sudo apt-get install -y git;
sudo apt-get install -y unzip

sudo /opt/lampp/xampp restart;

BLINKGREEN='\033[32;5m';
BLINKEND='\033[0m';
GREEN='\033[0;32m';
RED='\033[0;31m';
YELLOW='\033[0;33m';
WHITE='\033[0;37m';

echo "";
echo -e "${BLINKGREEN}INSTALLATION FINISHED! PLEASE READ BELOW${BLINKEND}";
echo"";
echo -e "${GREEN}Alex here,";
echo -e "${YELLOW}PLEASE MAKE SURE YOU RUN THE COMMAND ${WHITE}source ~/.bashrc";
echo -e "${GREEN}This will only have to be done once, but it is needed after this script runs"
echo -e "${GREEN}You're all set! You now have a directory called";
echo -e "${WHITE}/projects";
echo -e "${GREEN}that you can use to make your projects in!";
echo -e "";
echo -e "${WHITE}----------";
echo -e "";
echo -e "${GREEN}You now have a web server up and running, with laravel and composer installed for you!";
echo -e "${RED}IMPORTANT: ${GREEN}You will have to use GIT to transfer files between the work you do on your editor locally and the work you want to reflect on the server";
echo -e "";

