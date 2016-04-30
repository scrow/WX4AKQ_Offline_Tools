# Change Log

## v1.1.0 Feature release

* Makes updates to the Roster Viewer function for improved compatibility with the back-end changes introduced in Ops Portal v8.4.
* Addresses Issue #44 by removing "Send to NWS and Copy WX4AKQ via Winlink" option from the NCO form.  Beginning with Ops Portal v8.0, a 20-minute digest of all reports is sent to WX4AKQ over Winlink automatically.
* Fixes Issue #40 by disabling access to the `.git/` folder by way of an `.htaccess` update.  This addresses a potential security concern for users with specific installation setups for offline functionality.
* Addresses Issue #39 by allowing NCO's to submit their own reports via the NCO form.  This brings the offline forms in line with Ops Portal v8 changes.  Self-reports do not count for NCO activity credit but are otherwise handled as any other report.
* Addresses Issue #41 by updating both the NCO and Spotter forms to support "estimated" and "unknown" times, syncing the functionality with Ops Portal v8.  This increments the version of these two forms to `2`.
* Implemented Issue #46 by adding information on the [wx4akq-offline-announce](http://www.wx4akq.org/mailman/listinfo/wx4akq-offline-announce) e-mail list in the `README.md` file.
* Moves the Change Log from `README.md` to a separate `CHANGELOG.md` file.
* Miscellaneous minor cosmetic updates.

## v1.0.5 Bugfix release

* Corrected Issue #45 which prevented the API key from being inserted into XML files when running in offline server mode.

## v1.0.4 Minor enhancement release

* Adds an `+rmsonly` build output to `mkrelease.sh`.  This build contains only the documentation, RMS Express forms, and installation batch file.

## v1.0.3 Minor enhancement release

* Adds missing license text to `.gitattributes`, `.gitignore`, and several `.htaccess` files.
* Updates the `README.md` file to provide a reference to the new project homepage URL.
* Updates the forms to point to the new project homepage URL in the footer block.

## v1.0.2 Minor enhancement release

* Changed build output to new `build/` folder
* Changed `.gitignore` to disregard `gh-pages/` folder

## v1.0.1 Bugfix release

* Corrected Issue #38 which prevented a top-level `.htaccess` file from being included in the packaged output file.

## v1.0.0 Initial general release

* Corrected Issue #36 by adding code in an attempt to avoid server timeouts during download sessions, particularly when an FCC database is downloaded and unpacked on a slow connection and slow computer.
* Minor README cleanup.

## v1.0.0-beta2 Second beta release

* Corrected Issues #27 and #31 plus assorted other documentation cleanup.
* Corrected Issue #28 which prevented proper RMS Express form operation under certain browsers.
* Corrected Issue #29 which prevented the `start_server.bat` file from working under Windows 8.
* Corrected Issue #30 which resolved a missing Vagrant boostrap file in the release distribution ZIP file.
* Addressed Issue #32 by adding a Known Issues section with content describing provisioning failures some or all mobile broadband users may encounter when spinning up a new Vagrant virtual machine over said mobile broadband connection.  Created a `utils/` folder with scripts to destroy and reprovision a bad Vagrant virtual machine.
* Corrected Issue #33 to fix a syntax error in the file copy routine in `install_rms_forms.bat`
* Corrected Issue #34 which prevented the `install_rms_forms.bat` file from working under Windows 8.
* Windows users will now have their default browser auto-launch to http://localhost:8080 after running `start_server.bat`
* Created a Change Log in the README file.

## v1.0.0-beta1 First beta release

This is the first beta release.  Please submit any issues or feature requests to the [Issues](https://github.com/scrow/wx4akq-offline-tools/issues) tracker.

## v0.1.0-alpha1 Initial alpha test

Initial alpha test release version.