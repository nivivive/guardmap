guardmap
========

Google Hack for a Change - Runner-up

June 1, 2013

Access the application at http://guard-map.herokuapp.com.

=======
##What does this code do?
1. guardmap overlays public crime data onto Google Maps and gives you alternate, safer walking directions.
2. The guardmap API allows new crime data to be added to the database.
3. A proof-of-concept application uses the API by allowing users to text a number to add to the crime database.

##Why would I want to use it?
If you are feeling unsafe, use the guardmap web application to find better walking directions. Or, if you would like to contribute more recent data to the database, use the API. To report a crime by text message, use the twilio application.

##What platform does it run on?
The backend, which handles the API, runs on **Ruby on Rails**, which is hosted with **heroku**. The frontend is built with the **Google Maps API**, **jQuery**, **Bootstrap**, **HTML5**, **CSS3**, and **JavaScript**. The database runs on **Google Fusion Tables**. The proof-of-concept application uses **PHP** with the **twilio API**. Some initial data was preprocessed with a **Python** script.

##How do I install it?

    git clone https://github.com/Startstar/guardmap.git

Set up Ruby on Rails/twilio, and provide the appropriate API keys for Google Fusion Tables.

TBD

##How do I run it?
See [README.rdoc](README.rdoc).

TBD

To simply run the frontend, load up the `public/index.html` page in a browser. If you want geolocation to work locally, in a terminal window, enter

    cd public
    python -m SimpleHTTPServer

in a terminal window and then visit `http://localhost:8000` in your browser.

##How do I run the tests?
There are no tests for the frontend guardmap application, except the functioning application itself. The twilio application serves as a test for the guardmap API.

##What license does it have?
guardmap, its API, and its twilio application is released under the MIT License.
