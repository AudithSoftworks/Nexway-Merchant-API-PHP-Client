[![Code Climate](https://codeclimate.com/github/AudithSoftworks/Nexway-Merchant-API-PHP-Client/badges/gpa.svg)](https://codeclimate.com/github/AudithSoftworks/Nexway-Merchant-API-PHP-Client)
[![Code Quality](https://scrutinizer-ci.com/g/AudithSoftworks/Nexway-Merchant-API-PHP-Client/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/AudithSoftworks/Nexway-Merchant-API-PHP-Client)
[![Latest Stable Version](https://poser.pugx.org/audithsoftworks/nexway-merchant-api-php-client/v/stable.svg)](https://packagist.org/packages/audithsoftworks/nexway-merchant-api-php-client)
[![Total Downloads](https://poser.pugx.org/audithsoftworks/nexway-merchant-api-php-client/downloads.svg)](https://packagist.org/packages/audithsoftworks/nexway-merchant-api-php-client)
[![Latest Unstable Version](https://poser.pugx.org/audithsoftworks/nexway-merchant-api-php-client/v/unstable.svg)](https://packagist.org/packages/audithsoftworks/nexway-merchant-api-php-client)
[![License](https://poser.pugx.org/audithsoftworks/nexway-merchant-api-php-client/license.svg)](https://packagist.org/packages/audithsoftworks/nexway-merchant-api-php-client)

# Nexway API implementation in PHP (by Shahriyar Imanov at Audith Softworks) #

This library implements Nexway's WSDL/SOAP powered API interface, using PHP's OOP facilities.


## What is this repository for? ##

* Before being able to use this library, you need working Test configuration access token to [Nexway](http://www.nexway.com) WebServices interface. For production environment, you will need the Live configuration token as well.
* Once Nexway's access tokens have been acquired, enter them in ```/src/Audith/Providers/Nexway/config.ini``` file, in appropriate sections.
* Check out Unit-tests in ```/tests``` folder for use-cases.


## How to run Unit-tests? ##

Composer configuration file includes ```phpunit/phpunit``` package for development purposes. Once ```composer install``` has been executed, PHPUnit library files will be fetched.

Run following command to execute unit-tests: ```./vendor/phpunit/phpunit/phpunit --verbose --colors --strict --debug tests/```


## How to build Documentation using PHPDocumentor? ##

Again, as in the case of PHPUnit, we also have included PHPDocumentor in Composer configuration file. Once libraries are installed, run following command to build Documentation:

```./vendor/phpdocumentor/phpdocumentor/bin/phpdoc.php -d ./src```

Although data-layer of source-code isn't well-documented (i.e. PhpDoc summaries are missing, which are totally not necessary), the *Class Hierarchy Diagram* can prove useful.

**Note:** Please make sure you have PHP's ```xsl``` extension installed. It's required for PHPDocumentor libraries. If you don't want PHPDocumentor included with your installation, please remove it from ```composer.json``` file's ```require-dev``` list, before running ```composer install```.


## Where to report bugs? ##

Use our [JIRA](https://audith.atlassian.net/browse/NEXWAY) instance to report possible bugs.
