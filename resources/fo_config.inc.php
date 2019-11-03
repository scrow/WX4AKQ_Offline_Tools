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
?>
<!doctype html>
<html>
<head>
	<title>WX4AKQ Offline Tools: System Configuration</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="resources/styles.css"/>
</head>
<body>
<div class="container">

<H1><?php includeLogo();?> System Configuration</H1>

<hr/>
					
<div id='settingsForm'>

	<form id="settings" method="get" action="index.php" enctype="multipart/form-data">
		<input type="hidden" name="form" value="config_save"/>
		<input type="hidden" name="queue_folder" value="<?php echo($Config['queue_folder']);?>"/>
		
		<!--					<div class="help" id="helpSpace"></div>-->
		
		<fieldset class="call">
			<label for="my_call" class="required">Call Sign:</label>
			<input type="text" maxlength="6" name="my_call" id="my_call" value="<?php echo($Config['my_call']);?>"/>
		</fieldset>
		
		<fieldset class="eventInfo">
			<label for="api_key">API Key:</label>
			<input type="text" maxlength="32" name="api_key" id="api_key" style="width: 400px" value="<?php echo($Config['api_key']);?>"/>
		</fieldset>
		
		<!--
		<fieldset class="eventInfo">
			<label for="upload_url" class="required">Upload URL:</label>
			<input type="text" name="upload_url" id="upload_url" style="width: 400px" value="<?php echo($Config['upload_url']);?>"/>
		</fieldset>
		-->
		<input type="hidden" name="upload_url" id="upload_url" value="<?php echo($Config['upload_url']);?>"/>
		
		<fieldset class="call">
			<label for="override_connect_detect" class="required">Connection Detect:</label>
			<fieldset class="radiobuttons">
				<input type="radio" name="override_connect_detect" id="connect_detect_false" <?php if(!$Config['override_connect_detect']) { echo('CHECKED'); };?> VALUE="false"> Enabled<br/>
				<input type="radio" name="override_connect_detect" id="connect_detect_true" <?php if($Config['override_connect_detect']) { echo('CHECKED'); };?> VALUE="true"> Disabled
			</fieldset>
		</fieldset>
		
		<fieldset class="call">
			<label for="op_mode1" class="required">Operating Mode:</label>
			<fieldset class="radiobuttons">
				<input type="radio" name="op_mode" id="op_mode1" value="<?php echo(SAVE_TO_QUEUE);?>" <?php if($Config['op_mode']==SAVE_TO_QUEUE) { echo('CHECKED');};?>>Queue for Upload<br/>
				<input type="radio" name="op_mode" id="op_mode2" value="<?php echo(DOWNLOAD_ATTACHMENT);?>" <?php if($Config['op_mode']==DOWNLOAD_ATTACHMENT) { echo('CHECKED');};?>>Download Attachment
			</fieldset>
		</fieldset>
		
		<fieldset class="call">
			<label for="include_fcc">Download FCC Data:</label>
			<fieldset>
				<input type="checkbox" name="include_fcc" id="include_fcc" value="1" style="display: inline" <?php if($Config['include_fcc']) echo 'CHECKED';?>> Include FCC database when downloading from server
			</fieldset>
		</fieldset>

		<fieldset class="call">
			<label for="always_refresh">Include dynamic content:</label>
			<fieldset>
				<input type="checkbox" name="always_refresh" id="always_refresh" value="1" style="display: inline" <?php if($Config['always_refresh']) echo 'CHECKED';?>> Refresh frequently updated content when downloading from server
			</fieldset>
		</fieldset>

		&nbsp;<br/>
		
		<fieldset class="buttons">
			<input type="submit" id="submitBtn" name="submitBtn" value="Submit" class="green" onClick=""/>
			<input type="reset" id="resetBtn" name="resetBtn" value="Reset Form" class="gray" onClick="" />
		</fieldset>
	</form>
</div>

<?php includeFooter();?>
</div>
</body>
</html>
