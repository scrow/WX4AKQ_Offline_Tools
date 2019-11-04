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

if($mesh_mode && !$is_mesh_operator) {
	echo('<P>The system is running in multi-user mode and you are not the system operator.  This function is not available.</P>');
?>
<P><A HREF="index.php">Return to main menu</A></P>

<?php includeFooter();?>
</div>
</body>
</html>
<?php die();
};
	
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
	
	if((!isOnline()) && (!$Config['override_connect_detect'])) {
		echo('<P>You are not currently connected to the Internet.</P>');
		echo('<P><A HREF="index.php?form=menu">Return to the main menu.</A></P>');
		includeFooter();
		die();
	};

	$api_passed = false;

	// Download the roster
	$ch = curl_init();
	$data = array(
		'user' => $Config['my_call'],
		'api_key' => $Config['api_key'],
		'req' => 'roster'
	);
	$opt_array = array(
		CURLOPT_URL => 'https://dev.wx4akq.org/ops/xml_query.php',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_POST => 1,
		CURLOPT_POSTFIELDS => $data
	);
	curl_setopt_array($ch, $opt_array);
	// Set a timeout for slow connections - Bug #36
	set_time_limit(120);

	$result = curl_exec($ch);
	curl_close($ch);
	$xml = simplexml_load_string($result);

	ob_flush(); flush();

	if(trim($xml->passfail)=='PASS') {
		if(!file_exists('data')) {
			mkdir('data');
			file_put_contents('data/.htaccess',"Order allow,deny\nDeny from all");
		};
		file_put_contents('data/roster.xml', $xml->asXML());
		echo('<P>Download Team Roster ... passed<br/>');
		$api_passed = true;
	} else {
		echo('<P>Download Team Roster ... failed</br>');
	};

	ob_flush(); flush();
	
	// Get the list of supplemental files
	echo('Downloading supplemental files list ... ');
	ob_flush(); flush();
	$ch = curl_init();
	$opt_array = array(
		CURLOPT_URL => 'http://files.wx4akq.org/offline_files.xml',
		CURLOPT_RETURNTRANSFER => true
	);
	curl_setopt_array($ch, $opt_array);
	// Set a timeout for slow connections - Bug #36
	set_time_limit(120);
	$result = curl_exec($ch);
	$error = curl_errno($ch);
	$supplementals = new SimpleXMLElement($result);
	curl_close($ch);
	if($error!==0) {
		echo('failed<br/>');
		ob_flush(); flush();
	} else {
		echo('done');
		ob_flush(); flush();
		$doDownload = true;
		if(file_exists('data/offline_files.xml')) {
			$existing = new SimpleXMLElement(file_get_contents('data/offline_files.xml'));
			if(trim($supplementals->version) == trim($existing->version)) {
				$doDownload = false;
				echo(', up to date<br/>');
				ob_flush(); flush();
			} else {
				echo('<br/>');
				ob_flush(); flush();
			};
		} else {
			echo('updates required<br/>');
		};

		if($doDownload) {
			ob_flush(); flush();
			file_put_contents('data/offline_files.xml', $supplementals->asXML());
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
				// Set a timeout for slow connections - Bug #36
				// Going with a big number in case included files happen to be huge
				set_time_limit(1800);
				$result = curl_exec($ch);
				$error = curl_errno($ch);
				echo('Download '.$thisFile->title.' ... ');
				ob_flush(); flush();
				if($error==0) {
					file_put_contents('files/'.$thisFile->saveas, $result);
					echo('pass<br/>');
				} else {
					echo('fail<br/>');
				};
				ob_flush(); flush();
				curl_close($ch);
			};
		};

		if((!$doDownload) && ($Config['always_refresh']==1)) {
			// Refresh the "always refresh" files if enabled in config
			foreach($supplementals->file as $thisFile) {
				if($thisFile->always_refresh==1) {
					$ch = curl_init();
					$opt_array = array(
						CURLOPT_URL => $thisFile->url,
						CURLOPT_RETURNTRANSFER => true
					);
					curl_setopt_array($ch, $opt_array);
					// Set a timeout for slow connections - Bug #36
					// Going with a big number in case included files happen to be huge
					set_time_limit(1800);
					$result = curl_exec($ch);
					$error = curl_errno($ch);
					echo('Refresh '.$thisFile->title.' ... ');
					ob_flush(); flush();
					if($error==0) {
						file_put_contents('files/'.$thisFile->saveas, $result);
						echo('pass<br/>');
					} else {
						echo('fail<br/>');
					};
					ob_flush(); flush();
					curl_close($ch);
				};
			};
		};
		
	};
	
	// Handle FCC database download
	if($Config['include_fcc']) {
		
		if(!$api_passed) {
			echo('Download FCC data ... failed<br/>');
			ob_flush(); flush();
		} else {
			echo('Download FCC data ... ');
			ob_flush(); flush();
			$ch = curl_init();
			$data = array(
				'user' => $Config['my_call'],
				'api_key' => $Config['api_key'],
				'req' => 'fcc'
			);
			$opt_array = array(
				CURLOPT_URL => 'https://dev.wx4akq.org/ops/xml_query.php',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_POST => 1,
				CURLOPT_POSTFIELDS => $data
			);
			curl_setopt_array($ch, $opt_array);
			// Set a timeout for slow connections - Bug #36
			set_time_limit(120);
			$result = curl_exec($ch);
			curl_close($ch);
			$xml = simplexml_load_string($result);
			
			// Check existing file version
			if(file_exists('data/fcc.xml')) {
				$existing_xml = simplexml_load_file('data/fcc.xml');
				$existing_version = $existing_xml->timestamp;
			} else {
				$existing_version = 1;
			};
			
			if(($xml->passfail=='PASS') && ($xml->filesize>0)) {
				if(intval($existing_version) >= intval($xml->timestamp)) {
					echo('up to date<br/>');
				} else {
					$ch = curl_init();
					$data = array(
						'user' => $Config['my_call'],
						'api_key' => $Config['api_key'],
						'req' => 'fccdata'
					);
					$fp = fopen('data/fcc.sqlite3.gz.tmp','w');
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
					if(file_exists('data/fcc.sqlite3.gz')) {
						unlink('data/fcc.sqlite3.gz');
					};
					rename('data/fcc.sqlite3.gz.tmp', 'data/fcc.sqlite3.gz');
					// Handle decompression here
					echo('unpacking ... ');
					ob_flush(); flush();
					// Set a timeout for large files - Bug #6
					set_time_limit(3600);
					gzUncompressFile('data/fcc.sqlite3.gz', 'data/fcc.sqlite3');
					// Unlink compressed file
					unlink('data/fcc.sqlite3.gz');
					// Write the XML
					file_put_contents('data/fcc.xml', $xml->asXML());
					echo('pass<br/>');
				};
			} else {
				echo('skipped, no database available<br/>');
			};
		}; // end API validation
	}; // end FCC database download

	// Download the API authentication file
	if($mesh_mode && $is_mesh_operator) {
		echo('Downloading API authentication file ... ');
		ob_flush(); flush();

		$ch = curl_init();
		$data = array(
			'user' => $Config['my_call'],
			'api_key' => $Config['api_key'],
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
			if(file_exists('.htpasswd')) {
				unlink('.htpasswd');
			};
			rename('.htpasswd.tmp','.htpasswd');
			echo('pass<BR/>');
		} else {
			echo('fail<BR/>');
		};

		ob_flush(); flush();
	};
	
?>

<P><A HREF="index.php">Return to main menu</A></P>

<?php includeFooter();?>
</div>
</body>
</html>
