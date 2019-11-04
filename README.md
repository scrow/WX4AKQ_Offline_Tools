# Synopsis

This project contains SKYWARN-related forms for use by SKYWARN Spotters and Net Control Operators within the NWS Wakefield, Virginia County Warning Area (CWA).  The forms can be used either with the [RMS Express](http://www.winlink.org/tags/rms_express) amateur radio messaging software or in a standalone form using a locally-installed web server.  These forms are designed and maintained for the [Wakefield SKYWARN Amateur Radio Support Team](http://www.wx4akq.org/).

For information on the forms included in this project, see "Included Forms."

The [project homepage](http://offline.wx4akq.org) contains additional information and an introductory video with a demonstration.


# Get Notified of Updates

Announcements of updates to this project will be made over the [wx4akq-offline-announce](http://www.wx4akq.org/mailman/listinfo/wx4akq-offline-announce) e-mail list.  This is a low-traffic, announce-only mailing list anyone can subscribe to.  Please sign up for the e-mail list as part of your installation of this project.  There may be critical updates we need to let you know about!


# Quick Start for WX4AKQ Team Members

This section is for SKYWARN Net Control Operators, Area Managers, Net Managers, and Responders.  All other users please skip to the next section, "Winlink Use with RMS Express."

To get started, download and extract the latest [release](https://github.com/scrow/wx4akq-offline-tools/releases) to a folder on your computer, such as `C:\SKYWARN`.

**Note:**  If you _only_ need RMS Express capability and have no desire to utilize the full offline web server capability, you may choose to download the `+rmsonly` bundle, which contains only the documentation, RMS Express forms, and installation script.

Exit RMS Express if it is currently running.  Locate and run the `install_rms_forms.bat` file included with this package.  Restart RMS Express.  To use a form, click `Message`, then `New Message`, then `Select Template`.  Double-click the template name.  After submitting data into the template, close the browser window or tab, return to RMS Express, and transmit the Winlink message.


# Winlink Use with RMS Express

## Prequisites

To use these forms with RMS Express you must have a current version installed and configured for your amateur radio callsign.  The installation and configuration of RMS Express is outside the scope of this document.  This project is currently being designed and tested for RMS Express version 1.3.5.0 and newer.

You must have a recent version of Internet Explorer, Firefox, Chrome, Safari, or Opera set as your system's default browser.  Most recent versions of these browsers will be supported.  Development will always take place on the most recent version of these browsers.  Backwards compatibility with Internet Explorer, back to version 9, will be on a best-effort basis.

## Installation

Templates provided by this project can be installed for use by a specific callsign or by all users of the RMS Express installation.  To install for a specific callsign, the target folder is `C:\RMS Express\<callsign>\Templates`.  To install for all users, the target folder is `C:\RMS Express\Global Folders\Templates`.

To install a form and template, simply copy the desired `.html` file along with its corresponding `.txt` file from the `forms/` folder to the installation target folder.  A script called `install_rms_forms.bat` is included with this package to provide a quick way to perform an installation for all users.  You may run that script instead of manually copying the files.

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

The forms included in this project can also be accessed through a local web server.  In this configuration, there are four ways to get reports to the SKYWARN team:

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

For users without an existing local web server, a `Vagrantfile` is provided for use with the [Vagrant](http://www.vagrantup.com) virtualization environment.  Please note that Vagrant is dependent on a virtualization environment (either VMWare or Virtualbox) so you must have one of those installed *before* installing Vagrant.  [Virtualbox](http://www.virtualbox.org/) is available for free and is compatible with Windows, Mac, and Linux operating systems.

To use a Vagrant virtual machine as your local server, extract the project files to a folder on your machine, for example, `/home/ab1cde` or `C:\skywarn`.  Then from a terminal or command prompt, navigate to that folder and run `vagrant up`.

The first time you run this command, Vagrant will download and configure your virtual machine.  This will require an Internet connection, and the time required will vary depending on the speed of your Internet connection and the capabilities of your computer.

The offline tools will be available by browsing to [http://localhost:8080](http://localhost:8080).

## API Key

The "NCO Report Form" requires an API Key to submit reports from a local web server.  SKYWARN Net Controls can obtain their API key by logging in to [Ops Portal](https://ops.wx4akq.org) and clicking on the [My Account](https://ops.wx4akq.org/myaccount.php) link.

## Special Features Enabled

Several special features are enabled when running from a local web server:

  1. SKYWARN amateur radio team members (Net Controls, Responders, Leadership, etc) have access to an offline copy of the latest Team Roster.
  2. Optional offline FCC database for use with the NCO Report Form, similar to the lookup functionality currently provided in the NCO Dashboard on Ops Portal.
  3. Offline files.  These include copies of reporting criteria, paper log sheets, and other reference material, and could potentially include event-specific information packs such as ICS-205's.
  
These features all require configuration of a valid API key as described earlier in this document.  To retrieve these features, use the "Download Offline Data and Files from Server" option on the main menu.

The offline FCC database is currently updated once weekly and the "Include FCC database when downloading from server" option must be enabled in the System Configuration.  Disabling this option will not remove existing FCC data, but will prevent retrieval of the latest update.  Note that the FCC database is approximately a 75 MB download, so users over slow or restricted Internet connections may wish to forego this update.


# Multi-User (Mesh) Mode

A new multi-user mode is now available which allows deployment of the Offline Tools on a web server within a mesh network or other environment where there may be intermittent Internet connectivity.  The end user functionality is practically identical to running the Offline Tools on a local web server.  Users will have access as long as there is a mesh network path between their computer and the server.  Reports can be pushed from the server when connectivity is available, or they can be downloaded individually through the web browser for attachment to an e-mail message.

## Prerequisites

The prerequisites for multi-user mode are the same as running on a local web server.  Additionally, the server operator's Ops Portal account must be a member of the "mesh-ops" group.  (Users wishing to have their credentials available on these servers should ask to be added to the "mesh-users" group on Ops Portal.)

## Deployment process

Spawn a local server using Vagrant as usual or install on an existing web server as previously described.  Then:

  1. Copy `mesh_mode.xml.example` to `mesh_mode.xml` and edit the new file to contain the server operator's call sign and Ops Portal API key.  Set `mesh_mode_enable` to `1`
  2. Run `utils/sync_api_auth.php` to pull down the authentication file from Ops Portal.  The server must have working Internet connectivity to complete this step.  If this step fails, confirm that the account a member of the "mesh-ops" group in Ops Portal.
  3. Confirm that there are user names and hashed passwords in the `.htpasswd` file in the server root
  4. Edit `.htaccess` in the server root to enable password authentication

## Login Process

To log in, use the call sign for the username and the last 8 characters of the API key as the password.  Users can obtain their API key from the "My Account" page in Ops Portal and must be a member of the "mesh-users" group.

## File Downloads and Authentication Synchronization

Only the node owner (specified in `mesh_mode.xml`) can initiate downloads from the Ops Portal server while running in multi-user mode.  The Ops Portal user database will synchronize as part of the download activity, as long as the node owner remains in the "mesh-ops" group in Ops Portal.

Files downloaded by the node owner will be available to all users of the server.

## System Bulletin

A system bulletin file can be created as `bulletins/front_page.htm`.  When the system is running in multi-user mode and this file exists, it will replace the standard text at the top of the main menu.  This file is controlled by the system operator and does not synchronize from the network.


# Included Forms

## WX4AKQ_Spotter_Report_Form

This form is to be used by SKYWARN Spotters in relaying reports to the National Weather Service.  This form generates an `.xml` file which is sent to a specific e-mail address, where it is automagically processed and injected into the Wakefield SKYWARN Amateur Radio Support Team logs.  The report is then visible to Wakefield SKYWARN team members and certain Emergency Management partners.  The report is then sent to the National Weather Service along with other reports collected by SKYWARN nets.

## WX4AKQ_NCO_Report_Form

This form provides offline net log entry creation for active SKYWARN Net Control Operators.  The form is designed to approximately mirror the layout of the existing form located within the NCO Dashboard on the SKYWARN Ops Portal, with two key differences:

  1. When used as an RMS Express template, call sign lookup functionality is not available.
  2. Spotter statistics, including training status, are not available.
  
Reports generated by this form must be transmitted to the SKYWARN server by one of the following methods:

  1. Via Winlink e-mail from a call sign recognized by the SKYWARN Ops Portal as a member of the `nco`, `responder`, `leadership`, or `areamgrs` permission group.
  2. Via e-mail to `xmlsubmit@wx4akq.org` from an e-mail address registered in the SKYWARN Team Roster on Ops Portal.
  3. Using the Upload functionality when the form is accessed from a local web server.
  4. Via upload to `https://ops.wx4akq.org/xml_upload.php`

Upload methods require an embedded API Key, which can be obtained from the [My Account](https://ops.wx4akq.org/myaccount.php) page in the SKYWARN Ops Portal.

# Known Issues

For a full list of current issues or to submit a bug, refer to the [Issues](https://github.com/scrow/wx4akq-offline-tools/issues) tracker.

## Mobile Broadband Users

Users of some mobile broadband service providers (specifically AT&T Wireless, and probably some other carriers, too) may experience "Bad header line" error messages during the initial provisioning of the Vagrant virtual machine.  These errors are likely caused by the upstream proxy services utilized by the mobile broadband service.  Users encountering these error conditions will be missing some functionality or could end up with an unusable virtual machine, and will need to re-provision their virtual machine using the `utils/reprovision_machine.bat` or `utils/reprovision_machine.sh` script.  For more information, see [Issue #32](https://github.com/scrow/wx4akq-offline-tools/issues/32).


# Contributors

This project is maintained by [Steve Crow (KG4PEQ)](mailto:kg4peq@wx4akq.org) and [Reid Barden (N1VCU)](mailto:n1vcu@wx4akq.org).  Additional contributors can be found on the [Contributors](https://github.com/scrow/wx4akq-offline-tools/graphs/contributors) page.  


# License

Copyright (c) 2015-19, Steve Crow, Reid Barden.  This work is licensed under the BSD 2-clause “Simplified” License.  Please see the separate `LICENSE.md` file for further information.
