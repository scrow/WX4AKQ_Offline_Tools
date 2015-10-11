<?php
/*	
#	This file is part of WX4AKQ Winlink Forms for RMS Express
#	
#	Copyright (c) 2015, Steve Crow, Reid Barden
#	Licensed under the BSD 2-clause “Simplified” License
#	
#	For license information, see the LICENSE.md file or visit
#	http://wx4akq.org/software
*/

/*	Simple wrapper script to provide ability to submit to a server
	other than the one built in to RMS Express.
	
	Sample usage:  Install the .html file and index.php onto a local
	web server running httpd + PHP.  Submission of the form will
	generate a downloadable .xml file which could be saved locally
	and then attached to a Winlink message through an application
	other than RMS Express.  Additional use cases might be later
	submission via conventional e-mail.  Could also build an upload
	script which would send the files to the server using cURL or
	something similar. 
*/

const SAVE_TO_QUEUE = 1;
const DOWNLOAD_ATTACHMENT = 2;

// Read configuration Options
require_once('config.inc.php');

switch($_SERVER['REQUEST_METHOD']) {
	case 'GET':
		if(isset($_GET['form'])) {
			$form = trim(strtolower($_GET['form']));
			switch($form) {
				case 'wx4akq_spotter_report_form':
					// Serve the WX4AKQ_Spotter_Report_Form.html file
					$fd = file_get_contents('WX4AKQ_Spotter_Report_Form.html');
					$fd = str_replace('{FormServer}', $_SERVER['SERVER_NAME'], $fd);
					$fd = str_replace('{FormPort}', $_SERVER['SERVER_PORT'].dirname($_SERVER['REQUEST_URI'].'/index.php'),$fd);
					// Eventually set the value of a hidden form value specifying an app name
					// For example, <INPUT TYPE="hidden" ID="appName" NAME="appName" VALUE="RMS_Express"/>
					//              str_replace('VALUE="RMS_Express"','VALUE="runlocal"');
					// Then use document.getElementById('appName').value to customize the confirmation messaging
					echo($fd);
					break;
				case 'doupload':
					//
				default:
					die('Unrecognized form name.');
					break;
			}; // end switch($form);
		} else {
			// No form name specified
			// Eventually we could show a list of forms or some other default page here
			// For now, let's redirect to the Spotter form
			header('Location: index.php?form=wx4akq_spotter_report_form');
		};
		break;
	case 'POST':
		// Handle form submissions
		// Convert array keys to lowercase for consistency with RMS Express
		$_POST = array_change_key_case($_POST, CASE_LOWER);
		$xml = new SimpleXMLElement('<RMS_Express_Form></RMS_Express_Form>');
		$xmlVariables = $xml->addChild('variables');
		foreach(array_keys($_POST) as $thiskey) {
			$xmlVariables->addChild($thiskey, $_POST[$thiskey]);
		};
		// Generate a filename
		$filename = $_POST['formname'].'-'.time().'.xml';
		// Send the file to the browser (we might also want to provide a config option to save to disk)
		switch($Config['op_mode']) {
			case SAVE_TO_QUEUE:
				$fp = $fopen($Config['queue_folder'].'/'.$name);
				fwrite($fp, $xml->asXML());
				fclose($fp);
				break;
			case DOWNLOAD_ATTACHMENT:
				header('Content-type: text/xml');
				header('Content-Disposition: attachment; filename="'.$filename.'"');
				echo $xml->asXML();
				break;
		}; // end switch($Config['op_mode']);
		break;
	default:
		die('Unsupported request method.');
		break;
} // end switch($_SERVER['REQUEST_METHOD']);
?>