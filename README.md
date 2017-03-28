[![Travis CI](https://travis-ci.org/PayU/card-info-client-php.svg)](https://travis-ci.org/PayU/card-info-client-php) [![Latest Stable Version](https://poser.pugx.org/payu/card-info-client-php/v/stable.svg)](https://packagist.org/packages/payu/card-info-client-php) [![Total Downloads](https://poser.pugx.org/payu/card-info-client-php/downloads.svg)](https://packagist.org/packages/payu/card-info-client-php) [![License](https://poser.pugx.org/payu/card-info-client-php/license.svg)](https://packagist.org/packages/payu/card-info-client-php)

## Prerequisites

 * PHP 5.3 and above
 * curl extension with support for OpenSSL
 * PHPUnit 4.2.0 for running test suite (Optional)
 * Composer (Optional)

## Composer

You can install the library via [Composer](http://getcomposer.org/).
1. By running
```bash
composer require payu/card-info-client-php
```
2. Or by adding this to your composer.json
```bash
    {
      "require": {
        "payu/card-info-client-php": "^0.1.0"
      }
    }
```
 - Then install via:
```bash
    composer install
```
To use the library, include Composer's [autoload](https://getcomposer.org/doc/00-intro.md#autoloading]):

    require_once('vendor/autoload.php');

## Manual Installation

Obtain the latest version of the PayU Card Info V2 Client Library with:

    git clone https://github.com/PayU/card-info-client-php.git

To use the Library, add the following to your PHP script:

    require_once __DIR__ . '/path/to/card-info-client-php/src/init.php';

## Getting Started

You can find usage examples in the examples directory:

* cardExample.php - Minimal requirements for getting card info based on a card number
* tokenExample.php - Minimal requirements for getting card info based on a card token
