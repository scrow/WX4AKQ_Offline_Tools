# Synopsis

This project contains SKYWARN-related forms for use by SKYWARN Spotters and Net Control Operators within the NWS Wakefield, Virginia County Warning Area (CWA).  The forms can be used either with the [Winlink Express](http://www.winlink.org/tags/rms_express) amateur radio messaging software or in a standalone form using a locally-installed web server.  These forms are designed and maintained for the [Wakefield SKYWARN Amateur Radio Support Team](http://www.wx4akq.org/).

For information on the forms included in this project, see "Included Forms."

The [project homepage](http://offline.wx4akq.org) contains additional information and an introductory video with a demonstration.


# Get Notified of Updates

Announcements of updates to this project will be made over the [wx4akq-offline-announce](http://www.wx4akq.org/mailman/listinfo/wx4akq-offline-announce) e-mail list.  This is a low-traffic, announce-only mailing list anyone can subscribe to.  Please sign up for the e-mail list as part of your installation of this project.  There may be critical updates we need to let you know about!


# Multiple Tools in One package

To streamline the documentation and make it easier to understand each option, we've broken the README file down into several parts.

  * If you only want to use our custom templates for Net Control logging or Spotter reports in the Winlink Express software, see the file `README-Winlink_only.md`
  * If you are a Wakefield SKYWARN Net Control and would like the flexibility of Winlink reporting or direct upload when Internet connectivity is available, and you have a laptop or desktop PC or Mac, see the file `README-Vagrant_instance.md`
  * If you are a Wakefield SKYWARN Net Control and would like to host your own private "offline" instance on server you control, or from your laptop/desktop, see the file `README-Local_server.md`
  * If you are a Wakefield SKYWARN Net Control and would like to host a multi-user instance of the Offline Tools within an AREDN mesh or similar limited-access wireless network, see `README-Multi_user.md`


# Known Issues

For a full list of current issues or to submit a bug, refer to the [Issues](https://github.com/scrow/wx4akq-offline-tools/issues) tracker.

## Mobile Broadband Users

Users of some mobile broadband service providers (specifically AT&T Wireless, and probably some other carriers, too) may experience "Bad header line" error messages during the initial provisioning of the Vagrant virtual machine.  These errors are likely caused by the upstream proxy services utilized by the mobile broadband service.  Users encountering these error conditions will be missing some functionality or could end up with an unusable virtual machine, and will need to re-provision their virtual machine using the `utils/reprovision_machine.bat` or `utils/reprovision_machine.sh` script.  For more information, see [Issue #32](https://github.com/scrow/wx4akq-offline-tools/issues/32).


# Contributors

This project is maintained by [Steve Crow (KG4PEQ)](mailto:kg4peq@wx4akq.org) and [Reid Barden (N1VCU)](mailto:n1vcu@wx4akq.org).  Additional contributors can be found on the [Contributors](https://github.com/scrow/wx4akq-offline-tools/graphs/contributors) page.  


# License

Copyright (c) 2015-19, Steve Crow, Reid Barden.  This work is licensed under the BSD 2-clause “Simplified” License.  Please see the separate `LICENSE.md` file for further information.
