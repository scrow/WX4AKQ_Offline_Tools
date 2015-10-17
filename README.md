# Synopsis

This project contains SKYWARN-related forms for use by SKYWARN Spotters and Net Control Operators within the NWS Wakefield, Virginia County Warning Area (CWA).  The forms can be used either with the [RMS Express](http://www.winlink.org/tags/rms_express) amateur radio messaging software or in a standalone form using a locally-installed web browser.  These forms are designed and maintained for the [Wakefield SKYWARN Amateur Radio Support Team](http://www.wx4akq.org/).

For information on the forms included in this project, see "Included Forms."

# Quick Start for WX4AKQ Team Members

This section is for SKYWARN Net Control Operators, Area Managers, Net Managers, and Responders.  All other users please skip to the next section, "Winlink Use with RMS Express."

To get started, download and extract the latest [release](https://github.com/scrow/wx4akq-offline-tools/releases) to a folder on your computer, such as `C:\SKYWARN`.

## Quick Start: Setting up RMS Express Forms

Exit RMS Express if it is currently running.  Copy (do not move) the extracted files located in the `forms` folder to your `C:\RMS Express\Global Folders\Templates` folder.  The forms will now appear within RMS Express.

To use a form, click `Message`, then `New Message`, then `Select Template`.  Double-click the template name.  After submitting data into the template, close the browser window or tab, return to RMS Express, and send the Winlink message.

## Quick Start: Offline Logging without Winlink

Working Internet access is required to complete the initial setup.

Ensure you have [Vagrant](http://www.vagrantup.com) installed.

Navigate to the folder where you extracted the project files.  Windows users run the `start_server.bat` file.  Mac and Linux users, run `start_server.sh` from a terminal window.  The first time you run this script, Vagrant will download and configure a virtual machine.  This process will take 10 to 20 minutes, potentially longer, depending on the speed of your Internet connection and your computer's processor speed.  Users with slower computers or slow Internet connections (satellite, DSL) may require significantly longer setup time.

When the setup is complete, you will be prompted to navigate to [http://localhost:8080](http://localhost:8080).  You should see the WX4AKQ Offline Tools configuration window.

In a new browser window or tab, log in to the SKYWARN Ops Portal [My Account](http://ops.wx4akq.org/myaccount.php) page.  Highlight and copy your API Key to the clipboard.  Return to the WX4AKQ Offline Tools configuration window.  Enter your call sign and paste your API Key into the boxes provided.

Test your ability to upload reports by generating a Training Mode log entry.  Return to the main menu and select the Upload Reports function.  Verify that the report appears in the [NCO Dashboard](http://ops.wx4akq.org/dashboard.php) by using the Training Mode function in the dashboard.


# Winlink Use with RMS Express

## Prequisites

To use these forms with RMS Express you must have a current version installed and configured for your amateur radio callsign.  The installation and configuration of RMS Express is outside the scope of this document.  This project is currently being designed and tested for RMS Express version 1.3.5.0 and newer.

You must have a recent version of Internet Explorer, Firefox, Chrome, Safari, or Opera set as your system's default browser.  Most recent versions of these browsers will be supported.  Development will always take place on the most recent version of these browsers.  Backwards compatibility with Internet Explorer, back to version 9, will be on a best-effort basis.

## Installation

Templates provided by this project can be installed for use by a specific callsign or by all users of the RMS Express installation.  To install for a specific callsign, the target folder is `C:\RMS Express\<callsign>\Templates`.  To install for all users, the target folder is `C:\RMS Express\Global Folders\Templates`.

To install a form and template, simply copy the desired `.html` file along with its corresponding `.txt` file from the `forms/` folder to the installation target folder.

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


# Running from a Local Web Server

The forms incldued in this project can also be accessed through a local web server.  In this configuration, there are four ways to get reports to the SKYWARN team:

1. Reports can be staged in a queue folder and either:
	a. Uploaded to the SKYWARN server once Internet access is restored using a built-in uploader tool; or,
	b. Manually attached to an e-mail or Winlink message.
2. Reports can be downloaded as an XML file to be:
	a. Uploaded through a web browser; or,
	b. Manually attached to an e-mail or Winlink message.

## Using an Existing Local Web Server

An existing locally-installed web server can be used.  Installing, configuring, and troubleshooting issues with a locally-installed web server are outside the scope of this documentation.  The server used must have PHP 5.3 or higher with the PHP `cURL` extension installed.

Copy the project files to your web server's content folder, such as `/var/www/sites/` and then browse to the `index.php` file.

## Using Vagrant

For users without an existing local web server, a `Vagrantfile` is provided for use with the [Vagrant](http://www.vagrantup.com) virtualization environment.

To use Vagrant, extract the project files to a folder on your machine, for example, `/home/ab1cde` or `C:\skywarn`.  Then from a terminal or command prompt, navigate to that folder and run `vagrant up`.

The first time you run this command, Vagrant will download and configure your virtual machine.  This will require an Internet connection, and the time required will vary depending on the speed of your Internet connection and the capabilities of your computer.

The offline tools will be available by browsing to [http://localhost:8080](http://localhost:8080).

## API Key

The "NCO Report Form" requires an API Key to submit reports from a local web server.  SKYWARN Net Controls can obtain their API key by logging in to [Ops Portal](http://ops.wx4akq.org) and clicking on the [My Account](http://ops.wx4akq.org/myaccount.php) link.


# Included Forms

## WX4AKQ_Spotter_Report_Form

Currently this package contains a single form, `WX4AKQ_Spotter_Report_Form`, to be used by SKYWARN Spotters in relaying reports to the National Weather Service.  This form generates an `.xml` file which is sent to a specific e-mail address, where it is automagically processed and injected into the Wakefield SKYWARN Amateur Radio Support Team logs.  The report is then visible to Wakefield SKYWARN team members and certain Emergency Management partners.  The report is then sent to the National Weather Service along with other reports collected by SKYWARN nets.

Additional forms planned for the future include utilities for SKYWARN Net Control Operators and team members.


# Contributors

This projet is maintained by [Steve Crow (KG4PEQ)](mailto:kg4peq@wx4akq.org) and [Reid Barden (N1VCU)](mailto:n1vcu@wx4akq.org).  Additional contributors can be found on the [Contributors](https://github.com/scrow/wx4akq-offline-tools/graphs/contributors) page.  


# License

Copyright (c) 2015, Steve Crow, Reid Barden.  This work is licensed under the BSD 2-clause “Simplified” License.  Please see the separate `LICENSE.md` file for further information.
