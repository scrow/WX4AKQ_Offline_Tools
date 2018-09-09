<?php
/*	
#	This file is part of WX4AKQ Offline Tools
#	
#	Copyright (c) 2015-18, Steve Crow, Reid Barden
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
		// This should look similar to https://ops.wx4akq.org/viewroster.php?call=N1VCU
		$found = false;
		foreach($xml->entry as $entry) {
			if(!$found && strtolower($entry->callsign)==strtolower($_GET['callsign'])) {
				$found = true;
				switch($entry->areanum) {
					case 1:
						$areanum = '1 - Richmond';
						break;
					case 2:
						$areanum = '2 - Southern Virginia';
						break;
					case 3:
						$areanum = '3 - Williamsburg';
						break;
					case 4:
						$areanum = '4 - Piedmont';
						break;
					case 5:
						$areanum = '5 - Southeast Virginia';
						break;
					case 6:
						$areanum = '6 - Smithfield';
						break;
					case 7:
						$areanum = '7 - Northeast North Carolina';
						break;
					case 8:
						$areanum = '8 - Northern Neck';
						break;
					case 9:
						$areanum = '9 - Eastern Shore';
						break;
					default:
						$areanum = $entry->areanum;
						break;
				}; // end switch($entry->areanum);
				if(trim($entry->availability) == '') {
					$availability = 'No information provided.';
				} else {
					$availability = $entry->availability;
				};
				echo "<table>";
				echo "<tr><td> Callsign </td><td>$entry->callsign</td></tr>";
				echo "<tr><td> Status</td><td>$entry->memberstatus</td></tr>";
				echo "<tr><td> Name </td><td>$entry->firstname </td></tr>";
				echo "<tr><td> Primary Area </td><td>$areanum </td></tr>";
				echo "<tr><td> Primary Location </td><td>$entry->location </td></tr>";
				echo "<tr><td> Primary Role </td><td>$entry->role</td></tr>";
				echo "<tr><td> Primary Contact </td><td>$entry->pricontact</td></tr>";
				echo "<tr><td> Alternate Contact </td><td>$entry->altcontact</td></tr>";
				echo "<tr><td> Email </td><td>$entry->extemail</td></tr>";
				if($entry->haswinlink == 1) {
					$winlink = 'Yes';
				} else {
					$winlink = 'No';
				};
				echo "<tr><td> Has Winlink Address </td><td>$winlink</td></tr>";
				echo "<tr><td> Availability </td><td>$availability</td></tr>";
				echo "</table>";
				echo '<P><A HREF="?form=roster">Return to Roster listing</A></P>';
			};
		};
		if(!$found) {
			echo('<P>Call sign not found.</P>');
		};
		
	} else {
		// Step through the roster data and show summary.  Sort order is determined by the XML file.
		// This should look similar to https://ops.wx4akq.org/roster.php

		echo('<P>Click on a call sign to view Team Member details.</P>');

		echo '<table style="text-align: center"><thead><tr><td>Area</td><td>Callsign</td><td>Name</td><td>Role</td></tr></thead>';
		foreach($xml->entry as $entry) {
			echo "<tr><td>$entry->areanum</td>";
			echo "<td><a href=\"?form=roster&callsign=$entry->callsign\"> $entry->callsign </a></td>"; // display as link to ?form=roster&callsign=$entry->callsign
			echo "<td>$entry->firstname ";
			echo "$entry->lastname</td>";
			echo "<td>$entry->role</td></tr>";
		};
		echo "</table>";
	};

?>

<P><A HREF="index.php">Return to main menu</A></P>

<?php includeFooter();?>
</div>
</body>
</html>
