# Synopsis

This project contains SKYWARN-related forms for use with the [RMS Express](http://www.winlink.org/tags/rms_express) amateur radio messaging software.  These forms are designed for use by SKYWARN Spotters and amateur radio team members within the 66 counties and independent cities served by the [National Weather Service Wakefield, VA WFO](http://www.nws.noaa.gov/er/akq) and the [Wakefield SKYWARN Amateur Radio Support Team](http://www.wx4akq.org/).

An optional `runlocal` release adds the ability to utilize these forms independent of RMS Express through the use of a locally installed web server.  The XML output can be downloaded and saved to a folder for transmission through another Winlink application or standard e-mail, or can be queued for upload to the SKYWARN server over an Internet connection.

For information on the forms included in this project, see "Included Forms."


# Prerequisites

To use this form, you must have a current version of [RMS Express](http://www.winlink.org/tags/rms_express) installed and configured for your amateur radio callsign.  The installation and configuration of RMS Express is outside the scope of this document.  This form package is currently being designed and tested for RMS Express version 1.3.5.0 and newer.

You must have a recent version of Internet Explorer, Firefox, Chrome, Safari, or Opera set as your system's default browser.  Most recent versions of these browsers will be supported.  Development will always take place on the most recent version of these browsers.  Backwards compatibility with Internet Explorer, back to version 9, will be on a best-effort basis.


# Standard Release

## Installation

Templates provided by this project can be installed for use by a specific callsign or by all users of the RMS Express installation.  To install for a specific callsign, the target folder is `C:\RMS Express\<callsign>\Templates`.  To install for all users, the target folder is `C:\RMS Express\Global Folders\Templates`.

To install a form and template, simply copy the desired `.html` file along with its corresponding `.txt` file to the target folder.


## Usage

To use the form, begin by starting to compose a new message as per usual:

 1. Click `Message`.
 2. Click `New Message`.
 3. Click `Select Template`.

From here, double-click the desired template, such as `WX4AKQ_Spotter_Report_Form`.  Your browser will launch and display the form.  **Internet Explorer users:** You may receive an error message about enabling scripts to run.  You must accept this and permit the script to run.  Users of other browers should not see this warning.

Complete the form and click `Submit.`  When you see the confirmation message, close the browser window or tab, return to RMS, and click `Post to Outbox`.  Then, when ready, transmit the message as usual by radio or telnet connection.

## Creating a Shortcut

For quick access, you can create up to three form shortcuts in the Messaging window.  To do this, from the main RMS Express window:

 1. Click `Message`.
 2. Click `Set Favorite Templates`.
 3. Enter a Display Name, such as `Spotter Report Form`.
 4. Click the `Browse` button and double-click the appropriate form entry.
 5. Click `Save`.

Now, when accessing the `Message` > `New Message` function from the main RMS Express window, you will see a button at the top corresponding to your new favorite template.

## Addressing the Message

The template will automatically set the destination e-mail address and attach a small XML file containing your report.  Do not alter the e-mail address or remove the file attachment.


# Optional `runlocal` Release

An optional `runlocal` bundle provides all of the functionality of the standard release plus provides the ability to utilize these forms independent of RMS Express through the use of a locally installed web server.  The XML output can be downloaded and saved to a folder for transmission through another Winlink application or standard e-mail, or can be queued for upload to the SKYWARN server over an Internet connection.

An existing PHP 5.3+ web server can be used (`libcurl` and the PHP `cURL` extension required) and a `Vagrantfile` is provided for use with the [Vagrant](http://www.vagrantup.com/) virtualization environment.

## Installation

To install, extract the `runlocal` bundle to a folder on your drive:

	unzip wx4akq-winlink-forms-2.0.1+runlocal.zip /home/scrow/skywarn

...and that's about it for the installation.

## Configuration

To configure the installation, copy the provided `config.inc.php.SAMPLE` file to `config.inc.php` and edit the configuration according to the notes in the configuration file:

	$Config = array(
		// Define user call sign
		'my_call'		=>	'AB1CDE',
	
		// Operating mode.  Can be SAVE_TO_QUEUE or DOWNLOAD_ATTACHMENT
		'op_mode'		=>	SAVE_TO_QUEUE,
	
		// SAVE_TO_QUEUE mode options
		'queue_folder'	=>	'queue',
		'upload_url'	=>	'http://ops.wx4akq.org/xml_upload.php',
		'api_key'		=>	null
	);

Then, launch Vagrant by executing `vagrant up`.  The first time you run this command, Vagrant will download and configure your virtual machine.  This will require an Internet connection, and the time required will vary depending on the speed of your Internet connection and the capabilities of your computer.

## Usage

With the Vagrant virtual machine running, point your web browser to:

	http://localhost:8080/
	
At this time the only included form will automatically load.  If you are queueing files for later upload to the SKYWARN server, you can trigger those uploads by accessing the URL:

	http://localhost:8080/index.php?form=doupload
	
You can confirm the files have been uploaded by checking the `queue` folder.  If any XML files remain, check the server's error log for guidance:

	vagrant ssh
	sudo su
	tail -s 0.01 -f /var/log/apache2/error.log
	
If errors occur, please open an issue on the Github issue tracker.


# Included Forms

## WX4AKQ_Spotter_Report_Form

Currently this package contains a single form, `WX4AKQ_Spotter_Report_Form`, to be used by SKYWARN Spotters in relaying reports to the National Weather Service.  This form generates an `.xml` file which is sent to a specific e-mail address, where it is automagically processed and injected into the Wakefield SKYWARN Amateur Radio Support Team logs.  The report is then visible to Wakefield SKYWARN team members and certain Emergency Management partners.  The report is then sent to the National Weather Service along with other reports collected by SKYWARN nets.

Additional forms planned for the future include utilities for SKYWARN Net Control Operators and team members.


# Contributors

This projet is maintained by [Steve Crow (KG4PEQ)](mailto:kg4peq@wx4akq.org) and [Reid Barden (N1VCU)](mailto:n1vcu@wx4akq.org).  Additional contributors can be found on the [Contributors](https://github.com/scrow/wx4akq-winlink-forms/graphs/contributors) page.  


# License

Copyright (c) 2015, Steve Crow, Reid Barden.  This work is licensed under the BSD 2-clause “Simplified” License.  Please see the separate `LICENSE.md` file for further information.