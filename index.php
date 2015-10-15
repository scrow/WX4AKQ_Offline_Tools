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

// functions to see if we are online
function connect_attempt($ip = '8.8.4.4', $port=53) {
	return (bool) @fsockopen($ip, $port, $errnum, $errstring, 1);
};
function isOnline() {
	// Test both Google nameservers
	if(connect_attempt('8.8.4.4',53) || connect_attempt('8.8.8.8',53)) {
		return true;
	} else {
		return false;
	};
};

// Read configuration Options or redirect to configuration form

if(!file_exists('config.xml')) {
	if(isset($_GET['form']) && ($_GET['form']!=='config') && ($_GET['form']!=='config_save')) {
		header('Location: index.php?form=config');
	};
};

$Config = array();
if(file_exists('config.xml')) {
	$configFile = simplexml_load_file('config.xml');
	$Config['my_call'] = trim($configFile->my_call);
	if($Config['my_call']=='') {
		if(isset($_GET['form']) && ($_GET['form']!=='config') && ($_GET['form']!=='config_save')) {
			header('Location: index.php?form=config');
		};
	};
	$Config['queue_folder'] = trim($configFile->queue_folder);
	if($Config['queue_folder']=='') {
		$Config['queue_folder']=='queue';
	};
	if(!file_exists($Config['queue_folder'])) {
		mkdir($Config['queue_folder']);
	};
	$Config['api_key'] = trim($configFile->api_key);
	$Config['op_mode'] = trim($configFile->op_mode);
	if($Config['op_mode']=='') {
		$Config['op_mode'] = SAVE_TO_QUEUE;
	};
	$Config['upload_url'] = trim($configFile->upload_url);
	if($Config['upload_url'] == '') {
		$Config['upload_url'] = 'http://ops.wx4akq.org/xml_upload.php';
	};
	if(trim($configFile->override_connect_detect)=='true') {
		$Config['override_connect_detect']=true;
	} else {
		$Config['override_connect_detect']=false;
	};
} else {
	$Config['my_call'] = '';
	$Config['queue_folder'] = 'queue';
	$Config['op_mode'] = SAVE_TO_QUEUE;
	$Config['upload_url'] = 'http://ops.wx4akq.org/xml_upload.php';
	$Config['api_key'] = '';
	$Config['override_connect_detect'] = false;
};

function includeFooter() {
	echo <<< HTML
<hr/>
<p class="footer">Copyright &copy; 2015 Steve Crow, Reid Barden.  This work is licensed under the BSD 2-Clause &quot;Simplified&quot; License.  Update to the latest version of this form, download additional forms, request features and report bugs at the <a href="http://github.com/scrow/wx4akq-offline-tools" class="footer" TARGET="_blank">Project Homepage</a> (Internet connection required). SKYWARN&#0174 and the SKYWARN&#0174 logo are registered trademarks of the National Oceanic and Atmospheric Administration, used with permission.</p>
HTML;
}

function includeLogo() {
	echo('<img src="resources/WX4AKQ_Web_Logo.png" alt="[NWS Wakefield SKYWARN Logo]" HEIGHT=53 WIDTH=191 STYLE="vertical-align: middle; padding-right: 10px">');
}; // end function includeLogo();

switch($_SERVER['REQUEST_METHOD']) {
	case 'GET':
		if(isset($_GET['form'])) {
			$form = trim(strtolower($_GET['form']));
			switch($form) {
				case 'wx4akq_spotter_report_form':
					// Serve the WX4AKQ_Spotter_Report_Form.html file
					$fd = file_get_contents('forms/WX4AKQ_Spotter_Report_Form.html');
					$fd = str_replace('{FormServer}', $_SERVER['SERVER_NAME'], $fd);
					$fd = str_replace('{FormPort}', $_SERVER['SERVER_PORT'].dirname($_SERVER['REQUEST_URI'].'/index.php'),$fd);
					$fd = str_replace('id="appName" value="RMSExpress"', 'id="appName" value="runlocal"', $fd);
					$fd = str_replace('{Callsign}', $Config['my_call'], $fd);
					echo($fd);
					break;
				case 'upload':
					include('resources/fo_upload.inc.php');
					break;
				case 'menu':
					include('resources/fo_menu.inc.php');
					break;
				case 'config':
					include('resources/fo_config.inc.php');
					break;
				case 'config_save':
					$xml = new SimpleXMLElement('<config></config>');
					if(isset($_GET['my_call'])) {
						$xml->addChild('my_call',trim(strtoupper($_GET['my_call'])));
					} else {
						$xml->addChild('my_call',$Config['my_call']);
					};
					if(isset($_GET['op_mode'])) {
						$xml->addChild('op_mode',$_GET['op_mode']);
					} else {
						$xml->addChild('op_mode',$Config['op_mode']);
					};
					if(isset($_GET['upload_url'])) {
						$xml->addChild('upload_url',trim($_GET['upload_url']));
					} else {
						$xml->addChild('upload_url',$Config['upload_url']);
					};
					if(isset($_GET['api_key'])) {
						$xml->addChild('api_key',trim($_GET['api_key']));
					} else {
						$xml->addChild('api_key',$Config['api_key']);
					};
					if(isset($_GET['queue_folder']) && (trim($_GET['queue_folder']!==''))) {
						$xml->addChild('queue_folder',trim($_GET['queue_folder']));
					} else {
						$xml->addChild('queue_folder',trim($_GET['queue_folder']));
					};
					if(isset($_GET['override_connect_detect']) && (trim($_GET['override_connect_detect']=='true'))) {
						$xml->addChild('override_connect_detect','true');
					} else {
						$xml->addChild('override_connect_detect','false');
					};
					$fp = fopen('config.xml','w');
					fwrite($fp, $xml->asXML());
					fclose($fp);
					header('Location: index.php?form=menu');
					break;
				case 'download':
					include('resources/fo_download.inc.php');
					break;
				default:
					die('Unrecognized form name.');
					break;
			}; // end switch($form);
		} else {
			// No form name specified
			// Eventually we could show a list of forms or some other default page here
			// For now, let's redirect to the Spotter form
			header('Location: index.php?form=menu');
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
				$fp = fopen($Config['queue_folder'].'/'.$filename, 'w');
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
