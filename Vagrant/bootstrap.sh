#!/usr/bin/env bash

# Vagrant bootstrap file for wx4akq-winlink-forms

# Initial package installation

sudo apt-get update

if [ ! -f /var/log/swsetup ];
then
	sudo debconf-set-selections <<< 'mysql-server-5.5 mysql-server/root_password password f0a8266bb2930e6b'
	sudo debconf-set-selections <<< 'mysql-server-5.5 mysql-server/root_password_again password f0a8266bb2930e6b'
	
	sudo apt-get install -y mysql-server-5.5 php5-mysql apache2 php5 zip php5-curl curl
	if ! [ -L /var/www ]; then
		rm -rf /var/www
		ln -fs /vagrant /var/www
	fi
	
	apt-get -f install
	chown -R vagrant.vagrant /var/lock/apache2
	sudo sed -i "s|\("^export\ APACHE_RUN_USER=" * *\).*|\1vagrant|" /etc/apache2/envvars
	sudo sed -i "s|\("^export\ APACHE_RUN_GROUP=" * *\).*|\1vagrant|" /etc/apache2/envvars
	sudo sed -i "s|\("AllowOverride\ " * *\).*|\1all|" /etc/apache2/sites-enabled/000-default	
	sudo service apache2 stop
	sudo service apache2 start
	touch /var/log/swsetup
fi

# Initial database configuration

if [ ! -f /var/log/dbsetup ];
then
	echo "CREATE USER 'vagrant'@'localhost' IDENTIFIED BY 'vagrant'" | mysql -uroot -pf0a8266bb2930e6b
	echo "CREATE DATABASE vagrant" | mysql -uroot -pf0a8266bb2930e6b
	echo "GRANT ALL ON vagrant.* TO 'vagrant'@'localhost'" | mysql -uroot -pf0a8266bb2930e6b
	echo "flush privileges" | mysql -uroot -pf0a8266bb2930e6b

	if [ -f /vagrant/tables.sql ];
	then
		mysql -uroot -pf0a8266bb2930e6b vagrant < /vagrant/tables.sql
	fi

	touch /var/log/dbsetup
fi
