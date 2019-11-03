#!/bin/bash
#	
#	This file is part of WX4AKQ Offline Tools
#	
#	Copyright (c) 2015-19, Steve Crow, Reid Barden
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
	CURRDIR=`pwd`

	if [ ! -d "$CURRDIR/build" ]; then
		mkdir "$CURRDIR/build"
	fi

	cd ..
	cp -R "$CURRDIR" "$newver"
	zip -9 "$newver.zip" $newver/.htaccess $newver/*.md $newver/*.php $newver/utils/* $newver/*.bat $newver/start_server.sh $newver/Vagrant/bootstrap.sh $newver/Vagrantfile $newver/resources/* $newver/data/.htaccess $newver/forms/* $newver/files/.htaccess

	# Build rmsonly bundle
	zip -9 "$newver+rmsonly.zip" $newver/*.md $newver/forms/*.html $newver/forms/*.txt $newver/*.bat

	rm -Rf "$newver"

	mv "$newver.zip" "$CURRDIR/build"
	mv "$newver+rmsonly.zip" "$CURRDIR/build"

	cd $CURRDIR
fi
