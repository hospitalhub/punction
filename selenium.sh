#!/bin/bash
# selenium.sh: Start Selenium up and also start headless screen.
#Xvfb needed: sudo apt-get install xvfb 
#Xvfb :99 -ac &
export DISPLAY=:99.0
sh -e /etc/init.d/xvfb start
sleep 3
java -jar vendor/netwing/selenium-server-standalone/selenium-server-standalone-2.43.0.jar &
sleep 3