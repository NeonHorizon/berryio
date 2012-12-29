BerryIO
=======

Description: A web Browser based control system for the RaspberryPi
License: GPL Version 3
Platform: Tested on Raspbian Wheezy (2012-09-18 and newer) may work on others
Requirements: Requires a Raspberry Pi running Raspbian and a decent web browser (Internet Explorer versions older than 8 are not supported)

The long term aim of BerryIO is to enable developers to control the Raspberry Pi and its GPIO ports remotely from any device with a browser without ever needing to connect a screen or keyboard.

The way BerryIO works is once the Raspberry Pi has booted up (or if the connectivity changes) it automatically connects to the main wired or one of the predefined wireless networks and BerryIO emails the owner with a web link. They can then click the link and open the control panel in a browser (with their username and password).

There is also a command line interface, so you can issue commands directly to it over SSH or in scripting should you wish to.

For those interested in the technical details its mostly written in PHP which runs the back end for both the command line and the web browser interface (which is served with Apache). SPI control is written in C, the emailing is done with msmtp and the network can be managed by Raspians wpagui (although I hope to include functions in BerryIO to configure the network at some point).
