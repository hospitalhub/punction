#!/bin/bash
# selenium.sh: Start Selenium up and also start headless screen.
Xvfb :99 -ac &
export DISPLAY=:99 
java -jar vendor/netwing/selenium-server-standalone/selenium-server-standalone-2.43.0.jar &