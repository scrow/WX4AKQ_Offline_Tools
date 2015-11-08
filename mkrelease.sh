#!/bin/bash
#	
#	This file is part of WX4AKQ Offline Tools
#	
#	Copyright (c) 2015, Steve Crow, Reid Barden
#	Licensed under the BSD 2-clause “Simplified” License
#	
#	For license information, see the LICENSE.md file or visit
#	http://wx4akq.org/software
#	

if [[ -z "$1" ]]; then
	echo Release version string not specified
	echo Usage:  $0 1.0.2-rc2
else
	newver=wx4akq-offline-tools-$1
	currdir=`pwd`
	cd ..
	cp -R "$currdir" "$newver"
	zip -9 "$newver.zip" $newver/*.md $newver/*.php $newver/utils/* $newver/*.bat $newver/start_server.sh $newver/Vagrant/bootstrap.sh $newver/Vagrantfile * $newver/resources/* $newver/data/.htaccess $newver/forms/* $newver/files/.htaccess
	rm -Rf "$newver"
	mv "$newver.zip" "$currdir" 
	cd $currdir
fi
