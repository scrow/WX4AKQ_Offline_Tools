<?php
/*	
#	This file is part of WX4AKQ Offline Tools
#	
#	Copyright (c) 2015-19, Steve Crow, Reid Barden
#	Licensed under the BSD 2-clause “Simplified” License
#	
#	For license information, see the LICENSE.md file or visit
#	http://wx4akq.org/software
*/

chdir(dirname(__FILE__));

	function gzUncompressFile($srcName, $dstName) {
		$sfp = gzopen($srcName, "rb");
		$fp = fopen($dstName, "w");
		while (!gzeof($sfp)) {
			$string = gzread($sfp, 4096);
			fwrite($fp, $string, strlen($string));
		};
		gzclose($sfp);
		fclose($fp);
	};


if(file_exists('../mesh_mode.xml')) {
        $meshConfig = simplexml_load_file('../mesh_mode.xml');
	$mesh_operator = strtolower(trim($meshConfig->my_call));
	$mesh_operator_api = strtolower(trim($meshConfig->api_key));
} else {
	die('mesh_mode.xml not found.');
};

	// Download the API authentication file
	echo('Downloading API authentication file ... ');

	$ch = curl_init();
	$data = array(
		'user' => $mesh_operator,
		'api_key' => $mesh_operator_api,
		'req' => 'api_htaccess'
	);

	$fp = fopen('.htpasswd.tmp','w');
	$opt_array = array(
		CURLOPT_URL => 'https://dev.wx4akq.org/ops/xml_query.php',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_FILE => $fp,
		CURLOPT_POST => 1,
		CURLOPT_POSTFIELDS => $data
	);
	curl_setopt_array($ch, $opt_array);
	// Set a timeout for slow connections - Bug #36
	set_time_limit(3600);
	curl_exec($ch);
	curl_close($ch);
	fclose($fp);
	// Swap out the file
	if(file_exists('.htpasswd.tmp')) {
		if(file_exists('../.htpasswd')) {
			unlink('../.htpasswd');
		};
		rename('.htpasswd.tmp','../.htpasswd');
		echo('pass<BR/>');
	} else {
		echo('fail<BR/>');
	};
?>
