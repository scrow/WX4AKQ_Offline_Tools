#!/bin/bash
if [[ -z "$1" ]]; then
	echo Release version string not specified
	echo Usage:  $0 1.0.2-rc2
else
	newver=wx4akq-offline-tools-$1
	currdir=`pwd`
	cd ..
	cp -R "$currdir" "$newver"
	zip -9o "$newver.zip" $newver/* --exclude .* queue config.xml mkrelease.sh
	rm -Rf "$newver"
	mv "$newver.zip" "$currdir" 
	cd $currdir
fi
