<?php
/*	
#	This file is part of WX4AKQ Offline Tools
#	
#	Copyright (c) 2015, Steve Crow, Reid Barden
#	Licensed under the BSD 2-clause “Simplified” License
#	
#	For license information, see the LICENSE.md file or visit
#	http://wx4akq.org/software
*/
?><!doctype html>
<html>
<head>
	<title>WX4AKQ Offline Tools: Data Download</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="resources/styles.css"/>
</head>
<body>
<div class="container">

<H1><?php includeLogo();?> Data Download</H1>

<hr/>

<?php

	$ch = curl_init();
	$data = array(
		'user' => $Config['my_call'],
		'api_key' => $Config['api_key'],
		'req' => 'roster'
	);
	$opt_array = array(
		CURLOPT_URL => 'http://dev.wx4akq.org/ops/xml_query.php',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_POST => 1,
		CURLOPT_POSTFIELDS => $data
	);
	curl_setopt_array($ch, $opt_array);
	$result = curl_exec($ch);
	curl_close($ch);
	$xml = simplexml_load_string($result);

	if(trim($xml->passfail)=='PASS') {
		if(!file_exists('data')) {
			mkdir('data');
			file_put_contents('data/.htaccess',"Order allow,deny\nDeny from all");
		};
		file_put_contents('data/roster.xml', $xml->asXML());
		echo('<P>Download Team Roster ... passed<br/>');
	} else {
		echo('<P>Download Team Roster ... failed</br>');
	};
	
	// Get the list of supplemental files
	$ch = curl_init();
	$opt_array = array(
		CURLOPT_URL => 'http://files.wx4akq.org/offline_files.xml',
		CURLOPT_RETURNTRANSFER => true
	);
	curl_setopt_array($ch, $opt_array);
	$result = curl_exec($ch);
	$error = curl_errno($ch);
	$supplementals = new SimpleXMLElement($result);
	curl_close($ch);
	if($error!==0) {
		echo('Download supplemental files list ... failed<br/>');
	} else {
		$doDownload = true;
		if(file_exists('offline_files.xml')) {
			$existing = new SimpleXMLElement(file_get_contents('offline_files.xml'));
			if(trim($supplementals->version) == trim($existing->version)) {
				$doDownload = false;
			};
			echo('Download supplemental files list ... passed and up-to-date<br/>');
		};

		if($doDownload) {
			file_put_contents('offline_files.xml', $supplementals->asXML());
			if(!file_exists('files')) {
				mkdir('files');
				file_put_contents('files/.htaccess',"IndexOrderDefault Ascending Name\nIndexOptions FancyIndexing ScanHTMLTitles SuppressDescription NameWidth=65 FoldersFirst");
			};
			foreach($supplementals->file as $thisFile) {
				$ch = curl_init();
				$opt_array = array(
					CURLOPT_URL => $thisFile->url,
					CURLOPT_RETURNTRANSFER => true
				);
				curl_setopt_array($ch, $opt_array);
				$result = curl_exec($ch);
				$error = curl_errno($ch);
				echo('Download '.$thisFile->title.' ... ');
				if($error==0) {
					file_put_contents('files/'.$thisFile->saveas, $result);
					echo('pass<br/>');
				} else {
					echo('fail<br/>');
				};
				curl_close($ch);
			};
		};
		
	};
	
?>

<P><A HREF="index.php">Return to main menu</A></P>

<?php includeFooter();?>
</div>
</body>
</html>
