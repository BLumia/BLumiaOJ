#!/bin/bash
#OJ Install Script for Debian 8

#Configure variables
WWW_PATH=/var/www/
JUDGER_USER=judge
HTTPD_USER=www-data
DB_USER=root
DB_PASSWORD=root

#Install dept package
sudo apt-get install flex g++ libmysql++-dev php5 apache2 mysql-server php5-mysql php5-gd php5-cli mono-gmcs git make

#Start MySQL service
sudo service mysql start

#Fetch source code
git clone https://github.com/BLumia/BLumiaOJ.git --depth=1
git clone https://github.com/zhblue/hustoj.git --depth=1

#Judger account
sudo useradd -m -u 1536 $JUDGER_USER

#Compile Judger
sudo ./hustoj/beta/core/make.sh

#Running database sql and copy www data
sudo cp -r BLumiaOJ/webframe/ $WWW_PATH/OnlineJudge/
sudo chmod -R 771 $WWW_PATH/OnlineJudge/
sudo chown -R $HTTPD_USER $WWW_PATH/OnlineJudge/
sudo mysql -h localhost -u$DB_USER -p$DB_PASSWORD < BLumiaOJ/utils/sql_runner/db.sql


