## Laravel 5.3+ Digit to Text Module

[![Build Status](https://travis-ci.org/andrey-helldar/DigitText.svg?branch=master&style=flat-square)](https://travis-ci.org/andrey-helldar/DigitText)
[![Total Downloads](https://poser.pugx.org/andrey-helldar/digittext/downloads?format=flat-square)](https://packagist.org/packages/andrey-helldar/digittext)
[![Latest Stable Version](https://poser.pugx.org/andrey-helldar/digittext/v/stable?format=flat-square)](https://packagist.org/packages/andrey-helldar/digittext)
[![Latest Unstable Version](https://poser.pugx.org/andrey-helldar/digittext/v/unstable?format=flat-square)](https://packagist.org/packages/andrey-helldar/digittext)
[![License](https://poser.pugx.org/andrey-helldar/digittext/license?format=flat-square)](https://packagist.org/packages/andrey-helldar/digittext)


[![Quality Score](https://img.shields.io/scrutinizer/g/andrey-helldar/digittext.svg?style=flat-square)](https://github.com/andrey-helldar/DigitText)
[![Code Coverage](https://scrutinizer-ci.com/g/andrey-helldar/DigitText/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/andrey-helldar/DigitText/?branch=master)
[![Dependency Status](https://www.versioneye.com/php/andrey-helldar:digittext/dev-master/badge.svg?style=flat-square)](https://www.versioneye.com/php/andrey-helldar:digittext/dev-master)
[![StyleCI](https://styleci.io/repos/45746985/shield)](https://styleci.io/repos/45746985)

[![PHP-Eye](https://php-eye.com/badge/andrey-helldar/digittext/tested.svg?style=flat)](https://php-eye.com/package/andrey-helldar/digittext)


Модуль позволяет переводить числа в текстовый эквивалент. Это актуально при выставлении счетов по безналичному расчету.

## Установка

1. В раздел "require" файла composer.json добавьте пакет и выполните composer update:

        composer require andrey-helldar/digittext

2. После обновления композера, добавьте сервис провадер в файл config/app.php

        Helldar\DigitText\DigitServiceProvider::class,

3. Затем в файл config/app.php добавьте фасад:

        'DigitText' => Helldar\DigitText\DigitText::class,

Для тех, кто пользуется Laravel 5.2, смотрите ветку [Laravel 5.2](https://github.com/andrey-helldar/DigitText/tree/Laravel_5.2)

## Документация

Для перевода числа в текст используйте конструкцию:

    DigitText::text($number = 0, $lang = 'ru', $currency = false)

Пример:

    DigitText::text();
    DigitText::text(64.42);
    DigitText::text(2866);

    DigitText::text(0, 'ru', true);
    DigitText::text(64.42, 'ru', true);
    DigitText::text(2866, 'ru', true);

    // Результат:
    ноль
    шестьдесят четыре
    две тысячи восемьсот шестьдесят шесть

    ноль руб
    шестьдесят четыре руб 42 коп
    две тысячи восемьсот шестьдесят шесть руб

## Поддерживаемые языки

    EN - English
    DE - Deutsch
    RU - Русский
    UK - Український


## Поддержка

Помощь автору пакета: [PayPal](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=94B8LCPAPJ5VG), [Yandex Money](https://money.yandex.ru/quickpay/shop-widget?account=410012608840929&quickpay=shop&payment-type-choice=on&mobile-payment-type-choice=on&writer=seller&targets=Andrey+Helldar%3A+Open+Source+Projects&targets-hint=&default-sum=&button-text=04&mail=on&successURL=), WebMoney (Z124862854284, R343524258966)

## Копирайты и лицензия

DigitText разработан Андреем Хэллдаром для фреймворка Laravel версии 5.3 или выше, и распространяется под лицензией MIT. Смотрите файл LICENSE.
