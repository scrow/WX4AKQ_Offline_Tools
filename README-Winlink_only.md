# Custom Templates for Winlink Express

The WX4AKQ Offline Tools suite includes two custom templates for the Winlink Express software.  These forms generate an XML file which is routed to the SKYWARN server over the Winlink e-mail network.  Messages can then be transmitted via whichever Winlink connection is already in place (VHF, HF, telnet, etc.)  When received at the SKYWARN server, messages are authenticated and ingested directly into the SKYWARN log system for handling by Net Control and quality check teams.  Existing SKYWARN systems will relay qualifying reports to NWS Wakefield and any of five neighboring offices.

## Prequisites

To use these forms, the following prerequisites apply:

  * Winlink Express (formerly RMS Express) v1.3.5.0 or newer - requires Microsoft Windows
  * A valid amateur radio call sign
  * Active Winlink account
  * Recent version of Internet Explorer, Chrome, Edge, Safari, Firefox, Opera, or any other major browser

## Installation

Templates provided by this project can be installed for use by a specific callsign or by all users of the Winlink Express installation.  To install for a specific callsign, the target folder is `C:\RMS Express\<callsign>\Templates`.  To install for all users, the target folder is `C:\RMS Express\Global Folders\Templates`.

To install a form and template, simply copy the desired `.html` file along with its corresponding `.txt` file from the `forms/` folder to the installation target folder.  A script called `install_rms_forms.bat` is included with this package to provide a quick way to perform an installation for all users.  You may run that script instead of manually copying the files.

## Usage

To use the form, begin by starting to compose a new message as per usual:

  1. Click `Message`.
  2. Click `New Message`.
  3. Click `Select Template`.

From here, double-click the desired template, such as `WX4AKQ_Spotter_Report_Form`.  Your browser will launch and display the form.  **Internet Explorer users:** You may receive an error message about enabling scripts to run.  You must accept this and permit the script to run.  Users of other browsers should not see this warning.

Complete the form and click `Submit.`  When you see the confirmation message, close the browser window or tab, return to Winlink Express, and click `Post to Outbox`.  Then, when ready, transmit the message as usual by radio or telnet connection.

## Creating a Shortcut

For quick access, you can create up to three form shortcuts in the Messaging window.  To do this, from the main Winlink Express window:

  1. Click `Message`.
  2. Click `Set Favorite Templates`.
  3. Enter a Display Name, such as `Spotter Report Form`.
  4. Click the `Browse` button and double-click the appropriate form entry.
  5. Click `Save`.

Now, when accessing the `Message` > `New Message` function from the main Winlink Express window, you will see a button at the top corresponding to your new favorite template.

## Addressing the Message

The template will automatically set the destination e-mail address and attach a small XML file containing your report.  Do not alter the e-mail address or remove the file attachment(s).

## Included Forms

### WX4AKQ_Spotter_Report_Form

This form is to be used by SKYWARN Spotters in relaying reports to the National Weather Service.  This form generates an `.xml` file which is sent to a specific e-mail address, where it is automagically processed and injected into the Wakefield SKYWARN Amateur Radio Support Team logs.  The report is then visible to Wakefield SKYWARN team members and certain Emergency Management partners.  The report is then sent to the National Weather Service along with other reports collected by SKYWARN nets.

### WX4AKQ_NCO_Report_Form

This form provides offline net log entry creation for active SKYWARN Net Control Operators.  The form is designed to approximately mirror the layout of the existing form located within the NCO Dashboard on the SKYWARN Ops Portal, but the call sign lookup functionality seen in Ops Portal is not available in the Winlink templates.
