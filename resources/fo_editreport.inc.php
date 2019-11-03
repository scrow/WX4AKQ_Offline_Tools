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
	<title>WX4AKQ Offline Tools: Edit NCO Report</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="resources/styles.css"/>
</head>
<body>
<div class="container">

<H1><?php includeLogo();?> Edit NCO Report</H1>

<hr/>

<?php
	// See if we have any pending files, and if not, die()
	if(sizeof(glob($Config['queue_folder'].'/WX4AKQ_NCO_Report_Form-*.xml')) == 0) {
		echo('<P>There are no pending reports.');
		echo('<P><A HREF="index.php">Return to main menu.</A></P>');
		includeFooter();
		die();
	};

	// Iterate through the list of pending NCO reports
	echo('<P>Reports available for edit:');
	foreach(glob($Config['queue_folder'].'/WX4AKQ_NCO_Report_Form-*.xml') as $filename) {
		$xml = new SimpleXMLElement(file_get_contents($filename));
		if(strlen($xml->variables->reportinfo) > 20) {
			$summary = substr($xml->variables->reportinfo,0,20);
		} else {
			$summary = $xml->variables->reportinfo;
		};
		
		if($xml->variables->relayedvia==6) {
			$holdtext = ' <B>(ON HOLD)</B>';
		} else {
			$holdtext = '';
		};
		
		echo('<br/><a href="?form=WX4AKQ_NCO_Report_Form&edit='.basename($filename).'">'.$summary.' from '.$xml->variables->spottercall.' reported '.$xml->variables->eventdate.' at '.$xml->variables->eventtime.$holdtext.'</A>');
		unset($xml);
	}; //end foreach(glob...
?>

<P><A HREF="index.php">Return to main menu.</A></P>

<?php includeFooter();?>
</div>
</body>
</html>
