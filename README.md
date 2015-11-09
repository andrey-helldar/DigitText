## Laravel 5.1+ Digit to Text Module

[![Total Downloads](https://poser.pugx.org/andrey-helldar/digittext/downloads)](https://packagist.org/packages/andrey-helldar/digittext)
[![Latest Stable Version](https://poser.pugx.org/andrey-helldar/digittext/v/stable)](https://packagist.org/packages/andrey-helldar/digittext)
[![Latest Unstable Version](https://poser.pugx.org/andrey-helldar/digittext/v/unstable)](https://packagist.org/packages/andrey-helldar/digittext)
[![License](https://poser.pugx.org/andrey-helldar/digittext/license)](https://packagist.org/packages/andrey-helldar/digittext)

[![StyleCI](https://styleci.io/repos/45746985/shield)](https://styleci.io/repos/45746985)
[![Build Status](https://travis-ci.org/andrey-helldar/DigitText.svg?branch=master)](https://travis-ci.org/andrey-helldar/DigitText)
[![Dependency Status](https://www.versioneye.com/php/andrey-helldar:digittext/dev-master/badge.svg)](https://www.versioneye.com/php/andrey-helldar:digittext/dev-master)

The module allows to translate numbers into a text equivalent. This is important in the billing.

## Installation

1. Require this package in your composer.json and run composer update:

		"andrey-helldar/digittext" : "1.*"

2. After composer update, add service providers to the config/app.php

		Helldar\DigitText\DigitServiceProvider::class,

3. Add this to the facade in config/app.php:

		'DigitText' => Helldar\DigitText\DigitText::class,

## Documentation

To transfer the design using the form:

    DigitText::text($number);

Example:

    DigitText::text();
    DigitText::text(64.42);
    DigitText::text(2866);
    DigitText::text('10,000');
    DigitText::text(70043783);
    DigitText::text(786443783);

    // Result:
    ноль
    шестьдесят четыре
    две тысячи восемьсот шестьдесят шесть
    десять тысяч
    семьдесят миллионов сорок три тысячи семьсот восемьдесят три
    семьсот восемьдесят шесть миллионов четыреста сорок три тысячи семьсот восемьдесят три


## Support Library

You can donate via [PayPal](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=94B8LCPAPJ5VG), Yandex Money (410012608840929), WebMoney (Z124862854284)

## Copyright and License

DigitText was written by Andrey Helldar for the Laravel framework 5.1 or later, and is released under the MIT License. See the LICENSE file for details.

## Translation

Translations of text and comment by Google translate. Help with translation +1 in karma :)