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
	<title>WX4AKQ Offline Tools: Main Menu</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="resources/styles.css"/>
</head>
<body>
<div class="container">

<H1><?php includeLogo();?> Offline Tools Menu</H1>

<hr/>

<P>The WX4AKQ Offline Tools package provides special functionality for both SKYWARN Spotters and Net Control Operators in the Wakefield County Warning Area (CWA).  The files in the <code>forms/</code> folder can be used with the RMS Express software package to transmit reports and net log entries over the Winlink radio messaging system.  See the bundled <code>README.md</code> file for setup instructions.</P>
	
<P>Users temporarily without Internet access can create Spotter reports and log entries through this web interface to be queued and uploaded to the SKYWARN system once Internet connectivity is available.</P>

<hr>

<?php

echo('<P><B>User:</B> '.$Config['my_call'].' &middot; <B>Operating mode:</B> ');
if($Config['op_mode']==SAVE_TO_QUEUE) {
	echo('Queue for Upload');
} else {
	echo('Download as XML');
};

$numXML = sizeof(glob($Config['queue_folder'].'/*.xml'));
if($numXML == 0) {
	echo(' (no reports queued)');
} else {
	echo(' ('.$numXML.' report(s) queued) <A HREF="?form=upload">Upload now</A>');
};

echo('</P>');
?>
<HR/>

<P>Available forms:
<br/><a href="?form=WX4AKQ_Spotter_Report_Form">Spotter Report Form</a>
<?php if($Config['api_key']!=='') {
	echo('<br/><a href="?form=WX4AKQ_NCO_Report_Form">NCO Report Form</a>');
};?>
</P>

<?php
	if(file_exists('offline_files.xml')) {
		echo('<P>Offline files:');
		$xml = new SimpleXMLElement(file_get_contents('offline_files.xml'));
		foreach($xml->file as $thisFile) {
			echo('<br/><A HREF="files/'.$thisFile->saveas.'" TARGET="_blank">'.$thisFile->title.'</A>');
		};
		echo('<P>');
	};
?>

<P>System Options:
<br/><a href="?form=config">System Configuration</a>
<?php if(sizeof(glob($Config['queue_folder'].'/*.xml'))>0) {
	echo('<br/><a href="?form=upload">Upload Queued Reports</a>');
};
if(($Config['api_key']!=='') && (sizeof(glob($Config['queue_folder'].'/WX4AKQ_NCO_Report_Form-*.xml'))>0)) {
	echo('<br/><a href="?form=editreport">Edit Queued NCO Reports</a>');
};?>
<br/><a href="?form=download">Download Offline Data and Files from Server</a></P>

<?php includeFooter();?>
</div>
</body>
</html>