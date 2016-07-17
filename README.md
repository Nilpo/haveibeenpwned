# HaveIBeenPwned-For-PHP (HIBP)

[![Build Status](https://secure.travis-ci.org/Nilpo/haveibeenpwned.png?branch=master)](http://travis-ci.org/Nilpo/haveibeenpwned) [![Total Downloads](https://poser.pugx.org/Nilpo/haveibeenpwned/downloads.png)](https://packagist.org/packages/nilpo/haveibeenpwned)

HIBP is a simple consumer for the HaveIBeenPwned API written for PHP 5.3+.

[haveibeenpwned](https://haveibeenpwned.com) is a simple and flexible API for checking an email address or user name against an aggregated list of dump files for major security breaches.

# Installation

## Composer

HIBP is PSR-4 compliant and can be installed using [composer](http://getcomposer.org/).  Simply add `nilpo/haveibeenpwned` to your composer.json file.  _Composer is the sane alternative to PEAR.  It is excellent for managing dependencies in larger projects_.

    {
        "require": {
            "nilpo/haveibeenpwned": "*"
        }
    }

# Usage

See example.php for a simple usage example.

# Changelog

## 0.1.0

 - First public release
