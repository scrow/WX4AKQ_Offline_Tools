# Using a Vagrant instance

For users without an existing local web server, [Vagrant](http://www.vagrantup.com) provides a pre-configured virtual machine and web server that can provide enhanced offline services on a laptop or desktop.  A `Vagrantfile` is provided.  Please note that Vagrant is dependent on a virtualization environment (either VMWare or Virtualbox) so one of those must be installed *before* installing Vagrant.  [Virtualbox](http://www.virtualbox.org/) is available for free and is compatible with Windows, Mac, and Linux operating systems.

To use a Vagrant virtual machine as a local server, extract the project files to a folder on your machine, for example, `/home/ab1cde` or `C:\skywarn`.  Then from a terminal or command prompt, navigate to that folder and run `start_server.sh` or `start_server.bat`.

The first time you run this command, Vagrant will download and configure your virtual machine.  This will require an Internet connection, and the time required will vary depending on the speed of your Internet connection and the capabilities of your computer.

The offline tools will be available by browsing to [http://localhost:8080](http://localhost:8080).

Functionality and configuration are otherwise the same as running from any other local server.  See `README-Local_server.md` for information.
