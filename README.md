## Laravel 5.1+ Digit to Text Module

[![StyleCI](https://styleci.io/repos/45746985/shield)](https://styleci.io/repos/45746985)
[![Build Status](https://travis-ci.org/andrey-helldar/DigitText.svg?branch=master)](https://travis-ci.org/andrey-helldar/DigitText)
[![Total Downloads](https://poser.pugx.org/andrey-helldar/digittext/downloads)](https://packagist.org/packages/andrey-helldar/digittext)
[![Latest Stable Version](https://poser.pugx.org/andrey-helldar/digittext/v/stable)](https://packagist.org/packages/andrey-helldar/digittext)
[![Latest Unstable Version](https://poser.pugx.org/andrey-helldar/digittext/v/unstable)](https://packagist.org/packages/andrey-helldar/digittext)

[![Dependency Status](https://www.versioneye.com/php/andrey-helldar:digittext/dev-master/badge.svg)](https://www.versioneye.com/php/andrey-helldar:digittext/dev-master)
[![License](https://poser.pugx.org/andrey-helldar/digittext/license)](https://packagist.org/packages/andrey-helldar/digittext)

The module allows to translate numbers into a text equivalent. This is important in the billing.

## Installation

1. Require this package in your composer.json and run composer update:

		"andrey-helldar/digittext": "^1.0",

2. After composer update, add service providers to the config/app.php

		Helldar\DigitText\DigitServiceProvider::class,

3. Add this to the facade in config/app.php:

		'DigitText' => Helldar\DigitText\DigitText::class,

## Documentation

To transfer the design using the form:

    DigitText::text($number = 0, $lang = 'ru', $currency = false)

Example:

    DigitText::text(null, 'en');
    DigitText::text(64.23, 'en');
    DigitText::text(2866, 'en');

    DigitText::text(0, 'en', true);
    DigitText::text(64.23, 'en', true);
    DigitText::text(2866, 'en', true);

    // Result:
    zero
    sixty four dollars
    two thousands eight hundred sixty six

    zero dollar
    sixty four dollars 23 cents
    two thousands eight hundred sixty six dollars


## Support Library

You can donate via [PayPal](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=94B8LCPAPJ5VG), Yandex Money (410012608840929), WebMoney (Z124862854284)

## Copyright and License

DigitText was written by Andrey Helldar for the Laravel framework 5.1 or later, and is released under the MIT License. See the LICENSE file for details.

## Translation

Translations of text and comment by Google Translate. Help with translation +1 in karma :)
