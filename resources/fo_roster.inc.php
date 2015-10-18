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
	<title>WX4AKQ Offline Tools: Team Roster</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="resources/styles.css"/>
</head>
<body>
<div class="container">

<H1><?php includeLogo();?> Team Roster</H1>

<hr/>

<?php
	// See if the roster data file exists
	if(!file_exists('data/roster.xml')) {
		echo('<P>No roster data file found.  <A HREF="?form=download">Connect and download</A> (API Key required).</P>');
		includeFooter();
		die();
	};

	// Load the roster data into an XML object
	$xml = simplexml_load_file('data/roster.xml');
	
	// Error checking for "FAIL" condition in roster data
	if($xml->passfail=='FAIL') {
		echo('<P>No roster data found.  <A HREF="?form=download">Connect and download</A> (API Key required).</P>');
		includeFooter();
		die();
	};
	
	// Check roster age
	if((time() - $xml->timestamp) > (86400 * 30)) {
		echo('<P>Warning:  Roster data is over 30 days old.  <A HREF="?form=download">Connect and download to update</A>.</P>');
	};
	
	if(isset($_GET['callsign']) && (trim($_GET['callsign']!==''))) {
		// Display details for a specific call sign
		// This should look similar to http://ops.wx4akq.org/viewroster.php?call=N1VCU
		$found = false;
		foreach($xml->entry as $entry) {
			if(!$found && strtolower($entry->callsign)==strtolower($_GET['callsign'])) {
				$found = true;
				echo($entry->callsign);
				echo($entry->memberstatus);
				echo($entry->firstname);
				echo($entry->lastname);
				echo($entry->areanum);
				echo($entry->role);
				echo($entry->location);
				echo($entry->pricontact);
				echo($entry->altcontact);
				echo($entry->extemail);
				echo($entry->haswinlink);
				echo($entry->availability);
			};
		};
		if(!$found) {
			echo('<P>Call sign not found.</P>');
		};
		
	} else {
		// Step through the roster data and show summary.  Sort order is determined by the XML file.
		// This should look similar to http://ops.wx4akq.org/roster.php
		foreach($xml->entry as $entry) {
			echo($entry->areanum);
			echo($entry->callsign); // display as link to ?form=roster&callsign=$entry->callsign
			echo($entry->firstname);
			echo($entry->lastname);
			echo($entry->role);
		};
	};

?>

<P><A HREF="index.php">Return to main menu.</A></P>

<?php includeFooter();?>
</div>
</body>
</html>
