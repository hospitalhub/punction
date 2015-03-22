## Punction [![Build Status](https://travis-ci.org/amarcinkowski/punction.svg?branch=master)](https://travis-ci.org/amarcinkowski/punction) [![Coverage Status](https://coveralls.io/repos/amarcinkowski/punction/badge.svg)](https://coveralls.io/r/amarcinkowski/punction)

Punction is a tool for nurses to categorize patients.

**Version:** 1.0.0

### Git
// add id_rsa.pub key to github / bitbucket / cloudforge

### Node
Node isn't hard to install too. Just visit their [website](http://nodejs.org/) and click install.

### Bower
Command `npm install -g bower`.

### Grunt
`npm install -g grunt-cli`
`npm install grunt`
`npm install grunt-npm-install`
`sudo grunt npm-install`
`sudo npm install --save-dev load-grunt-tasks time-grunt`
Building and Documentation
`grunt build`
`grunt doc`

### WP-CLI
`curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar`
`chmod +x wp-cli.phar`
`sudo mv wp-cli.phar /usr/local/bin/wp`
tests scaffolding
`wp --path="wp/" scaffold plugin-tests punction`


### PHPUnit
debug / code coverage:
`sudo apt-get install php5-xdebug`
phpunit get
`wget https://phar.phpunit.de/phpunit.phar`
`chmod +x phpunit.phar`
`sudo mv phpunit.phar /usr/local/bin/phpunit`
run:
`phpunit`

### Composer 

### vagrant / jujubox
//`vagrant box add jujub http://cloud-images.ubuntu.com/vagrant/trusty/trusty-server-cloudimg-amd64-juju-vagrant-disk1.box`
//`vagrant init jujub`
//`vagrant init ubuntu/precise64-juju`
`vagrant init ubuntu/trusty64-juju`
`vagrant up`
`sshuttle -r vagrant@localhost:2222 10.0.3.0/24`
`vagrant ssh`
http://127.0.0.1:6080/
`juju bootstrap`
services
`juju deploy cs:precise/mysql-48`
`juju deploy cs:precise/wordpress-26`
`juju deploy wordpress`
`juju add-relation wordpress mysql`
`juju expose wordpress`
`juju deploy cs:precise/apache2`
wordpress->engine "apache2"
`juju deploy cs:precise/phpmyadmin`
`juju set phpmyadmin password="password"`
juju-admin / password
`juju deploy jenkins`
`juju expose jenkins`
`wget http://10.0.3.113:8080/jnlpJars/jenkins-cli.jar`
`sudo apt-get install openjdk-7-jre-headless`
`java -jar jenkins-cli.jar -s http://10.0.3.113:8080 login --username admin --password juju`
`java -jar jenkins-cli.jar -s http://10.0.3.113:8080 install-plugin checkstyle cloverphp crap4j dry htmlpublisher jdepend plot pmd violations xunit`
`java -jar jenkins-cli.jar -s http://10.0.3.113:8080 safe-restart`
`juju ssh jenkins/0`
`sudo apt-get install php5 git php5-curl php5-mysql php5-xsl phpunit nodejs npm firefpx phantomjs xvfb`
`sudo npm install bower -g`
`curl -sS https://getcomposer.org/installer | php`
`sudo mv composer.phar /usr/bin/composer`
`sudo /var/lib/jenkins/.env`
DB_NAME=wordpress
DB_USER=ahzaipeeceikaon
DB_PASSWORD=chienaiziweegoh
DB_HOST=10.0.3.133
`/var/lib/jenkins/jobs/punction/workspace$ php vendor/bin/doctrine orm:schema-tool:update --force --dump-sql`
lub
`php /var/lib/jenkins/jobs/punction/workspace/vendor/bin/doctrine orm:schema-tool:update --force --dump-sql`
Do you want to store credentials for wsz.git.cloudforge.com in /home/ubuntu/.composer/auth.json ? [Yn] y
copy auth.json file to /var/lib/jenkins/.composer 

### QUnit

### Selenium
`sudo apt-get install php5-curl`
`wget http://selenium-release.storage.googleapis.com/2.43/selenium-server-standalone-2.43.1.jar`
`wget http://chromedriver.storage.googleapis.com/2.10/chromedriver_linux64.zip`
`unzip chromedriver_linux64.zip`

### PHPDox
`wget http://phpdox.de/releases/phpdox.phar`
`chmod +x phpdox.phar`
`mv phpdox.phar /usr/local/bin/phpdox`

### Doctrine db
reverse engineering
`php vendor/bin/doctrine orm:convert-mapping --force --from-database annotation ./EXPORT/`
db tables generation based on annotation
`php vendor/bin/doctrine orm:schema-tool:update --force --dump-sql`

### Phpmyadmin

sudo apt-get install phpmyadmin
















