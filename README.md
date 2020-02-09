# web-framework
This is the latest stable version of my Web Framework as it comes installed via composer (composer create-project jcdev/mvc_framework "your/installation/directory" 1.0.*).  

I started developing this framework as a self-learning exercise and have continued to improve and update it.  It comes with a templating system on the front end and with Vue.js and PHPUnit installed.  Sites are built in the app directory.  This can house an independant app however by extending from the Abstract Controller you can have access to the 'container' which has access to the connection object, state management, authed user etc.

The app is routed to the controller via the Name followed by Controller e.g. the profile controller would be named ProfileController.  Dependencies for Controllers (and Models) can be defined in the config folder, these will also be available in the 'container' when defined and as such Dependency Injection can be easily maintained.  This is also where any env variables can be set.

The front end templating is quite simple, extending from the main public template with sections able to be included.  The template name is set in the controller along with the data it requires.  Sections can be included in the following way:

[[ extends::public ]]

[[ section::partials/publicHeader ]]

<p>The site says: [[ message ]] </p>
<p>The connection type is : [[ dbo ]] </p>

When the app is installed there is a basic example available.

This framework is a work in progress and is mainly for personal learning and development



