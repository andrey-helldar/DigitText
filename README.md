## Laravel 5.3+ Digit to Text Module


[![Build Status](https://travis-ci.org/andrey-helldar/DigitText.svg?branch=master&style=flat-square)](https://travis-ci.org/andrey-helldar/DigitText)
[![Total Downloads](https://poser.pugx.org/andrey-helldar/digittext/downloads?format=flat-square)](https://packagist.org/packages/andrey-helldar/digittext)
[![Latest Stable Version](https://poser.pugx.org/andrey-helldar/digittext/v/stable?format=flat-square)](https://packagist.org/packages/andrey-helldar/digittext)
[![Latest Unstable Version](https://poser.pugx.org/andrey-helldar/digittext/v/unstable?format=flat-square)](https://packagist.org/packages/andrey-helldar/digittext)
[![License](https://poser.pugx.org/andrey-helldar/digittext/license?format=flat-square)](https://packagist.org/packages/andrey-helldar/digittext)


[![Quality Score](https://img.shields.io/scrutinizer/g/andrey-helldar/digittext.svg?style=flat-square)](https://github.com/andrey-helldar/DigitText)
[![Dependency Status](https://www.versioneye.com/php/andrey-helldar:digittext/dev-master/badge.svg?style=flat-square)](https://www.versioneye.com/php/andrey-helldar:digittext/dev-master)
[![StyleCI](https://styleci.io/repos/45746985/shield)](https://styleci.io/repos/45746985)
[![PHP-Eye](https://php-eye.com/badge/andrey-helldar/digittext/tested.svg?style=flat)](https://php-eye.com/package/andrey-helldar/digittext)


The module allows to translate numbers into a text equivalent. This is important in the billing.

## Installation

1. Run command in console:

        composer require andrey-helldar/digittext

2. After composer update, add service providers to the config/app.php

        Helldar\DigitText\DigitServiceProvider::class,

3. Add this to the facade in config/app.php:

        'DigitText' => Helldar\DigitText\DigitText::class,

For those who use Laravel 5.2, see the branch [Laravel 5.2](https://github.com/andrey-helldar/DigitText/tree/Laravel_5.2)

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
    sixty four
    two thousands eight hundred sixty six

    zero dollar
    sixty four dollars 23 cents
    two thousands eight hundred sixty six dollars

## Support Library

    EN - English
    DE - Deutsch
    RU - Русский
    UK - Український


## Support Library

You can donate via [PayPal](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=94B8LCPAPJ5VG), [Yandex Money](https://money.yandex.ru/quickpay/shop-widget?account=410012608840929&quickpay=shop&payment-type-choice=on&mobile-payment-type-choice=on&writer=seller&targets=Andrey+Helldar%3A+Open+Source+Projects&targets-hint=&default-sum=&button-text=04&mail=on&successURL=), WebMoney (Z124862854284, R343524258966)

## Copyright and License

DigitText was written by Andrey Helldar for the Laravel framework 5.3 or later, and is released under the MIT License. See the LICENSE file for details.

## Translation

Translations of text and comment by Google Translate. Help with translation +1 in karma :)
