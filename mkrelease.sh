#!/bin/bash
if [[ -z "$1" ]]; then
	echo Release version string not specified
	echo Usage:  $0 1.0.2-rc2
else
	zip -9o "wx4akq-winlink-forms-$1.zip" *.md *.html *.txt
fi

