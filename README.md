## Digit to Text for Laravel 5.3+

The module allows to translate numbers into a text equivalent. This is important in the billing.

![Digit to Text for Laravel 5.3+](https://cloud.githubusercontent.com/assets/10347617/21897789/f51aed2c-d92d-11e6-9f86-de24d148c0ca.jpg)

<p align="center">
<a href="https://travis-ci.org/andrey-helldar/DigitText"><img src="https://travis-ci.org/andrey-helldar/DigitText.svg?branch=master&style=flat-square" alt="Build Status" /></a>
<a href="https://packagist.org/packages/andrey-helldar/DigitText"><img src="https://img.shields.io/packagist/dt/andrey-helldar/DigitText.svg?style=flat-square" alt="Total Downloads" /></a>
<a href="https://packagist.org/packages/andrey-helldar/DigitText"><img src="https://poser.pugx.org/andrey-helldar/DigitText/v/stable?format=flat-square" alt="Latest Stable Version" /></a>
<a href="https://packagist.org/packages/andrey-helldar/DigitText"><img src="https://poser.pugx.org/andrey-helldar/DigitText/v/unstable?format=flat-square" alt="Latest Unstable Version" /></a>
<a href="https://github.com/andrey-helldar/DigitText"><img src="https://poser.pugx.org/andrey-helldar/DigitText/license?format=flat-square" alt="License" /></a>
</p>


<p align="center">
<a href="https://github.com/andrey-helldar/DigitText"><img src="https://img.shields.io/scrutinizer/g/andrey-helldar/DigitText.svg?style=flat-square" alt="Quality Score" /></a>
<a href="https://www.versioneye.com/php/andrey-helldar:DigitText/dev-master"><img src="https://www.versioneye.com/php/andrey-helldar:DigitText/dev-master/badge?style=flat-square" alt="Dependency Status" /></a>
<a href="https://styleci.io/repos/45746985"><img src="https://styleci.io/repos/45746985/shield" alt="StyleCI" /></a>
<a href="https://php-eye.com/package/andrey-helldar/DigitText"><img src="https://php-eye.com/badge/andrey-helldar/DigitText/tested.svg?style=flat" alt="PHP-Eye" /></a>
</p>


## Installation

1. Run command in console:

        composer require andrey-helldar/digittext

2. After composer update, add service providers to the config/app.php

        Helldar\DigitText\DigitServiceProvider::class,

3. Add this to the facade in config/app.php:

        'DigitText' => Helldar\DigitText\Facade::class,

For those who use Laravel 5.2, see the branch [Laravel 5.2](https://github.com/andrey-helldar/DigitText/tree/Laravel_5.2)

## Documentation

To transfer the design using the form:

    DigitText::number($number = 0)->lang('en')->currency(false)->get();
    
    //or use helper:    
    digit_text()->number($number = 0)->lang('en')->currency(false)->get();

Example:

    DigitText::number(null)->lang('en')->get();
    DigitText::number(64.23)->lang('en')->get();
    DigitText::number(2866)->lang('en')->get();

    DigitText::number(0)->lang('en')->currency()->get();
    DigitText::number(64.23)->lang('en')->currency()->get();
    DigitText::number(2866)->lang('en')->currency()->get();

    // Result:
    zero
    sixty four
    two thousands eight hundred sixty six

    zero dollar
    sixty four dollars 23 cents
    two thousands eight hundred sixty six dollars

## Support Languages

    EN - English
    DE - Deutsch
    RU - Русский
    UK - Український


## Support Package

You can donate via [PayPal](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=94B8LCPAPJ5VG), [Yandex Money](https://money.yandex.ru/quickpay/shop-widget?account=410012608840929&quickpay=shop&payment-type-choice=on&mobile-payment-type-choice=on&writer=seller&targets=Andrey+Helldar%3A+Open+Source+Projects&targets-hint=&default-sum=&button-text=04&mail=on&successURL=), WebMoney (Z124862854284, R343524258966) and [Patreon](https://www.patreon.com/helldar)

## Copyright and License

DigitText was written by Andrey Helldar for the Laravel framework 5.3 or later, and is released under the MIT License. See the LICENSE file for details.

## Translation

Translations of text and comment by Google Translate. Help with translation +1 in karma :)
