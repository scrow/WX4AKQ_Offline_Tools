# Synopsis

This project contains SKYWARN-related forms for use with the [RMS Express](http://www.winlink.org/tags/rms_express) amateur radio messaging software.  These forms are designed for use by SKYWARN Spotters and amateur radio team members within the 66 counties and independent cities served by the [National Weather Service Wakefield, VA WFO](http://www.nws.noaa.gov/er/akq) and the [Wakefield SKYWARN Amateur Radio Support Team](http://www.wx4akq.org/).

For information on the forms included in this project, see "Included Forms."


# Prerequisites

To use this form, you must have a current version of [RMS Express](http://www.winlink.org/tags/rms_express) installed and configured for your amateur radio callsign.  The installation and configuration of RMS Express is outside the scope of this document.  This form package is currently being designed and tested for RMS Express version 1.3.6.0.

You must have a recent version of Internet Explorer, Firefox, Chrome, Safari, or Opera set as your system's default browser.  Most recent versions of these browsers will be supported.  Development will always take place on the most recent version of these browsers.  Backwards compatibility with Internet Explorer, back to version 9, will be on a best-effort basis.


# Installation

Templates provided by this project can be installed for use by a specific callsign or by all users of the RMS Express installation.  To install for a specific callsign, the target folder is `C:\RMS Express\<callsign>\Templates`.  To install for all users, the target folder is `C:\RMS Express\Global Folders\Templates`.

To install a form and template, simply copy the desired `.html` file along with its corresponding `.txt` file to the target folder.


# Usage

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


# Included Forms

## WX4AKQ_Spotter_Report_Form

Currently this package contains a single form, `WX4AKQ_Spotter_Report_Form`, to be used by SKYWARN Spotters in relaying reports to the National Weather Service.  This form generates an `.xml` file which is sent to a specific e-mail address, where it is automagically processed and injected into the Wakefield SKYWARN Amateur Radio Support Team logs.  The report is then visible to Wakefield SKYWARN team members and certain Emergency Management partners.  The report is then sent to the National Weather Service along with other reports collected by SKYWARN nets.

Additional forms planned for the future include utilities for SKYWARN Net Control Operators and team members.


# Contributors

This projet is maintained by [Steve Crow (KG4PEQ)](mailto:kg4peq@wx4akq.org) and [Reid Barden (N1VCU)](mailto:n1vcu@wx4akq.org).  Additional contributors can be found on the [Contributors](https://github.com/scrow/wx4akq-winlink-forms/graphs/contributors) page.  


# License

Copyright (c) 2015, Steve Crow, Reid Barden.  This work is licensed under the BSD 2-clause “Simplified” License.  Please see the separate `LICENSE.md` file for further information.