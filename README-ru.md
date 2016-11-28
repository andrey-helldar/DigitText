## Laravel 5.3+ Digit to Text Module

[![StyleCI](https://styleci.io/repos/45746985/shield)](https://styleci.io/repos/45746985)
[![Build Status](https://travis-ci.org/andrey-helldar/DigitText.svg?branch=master)](https://travis-ci.org/andrey-helldar/DigitText)
[![Total Downloads](https://poser.pugx.org/andrey-helldar/digittext/downloads)](https://packagist.org/packages/andrey-helldar/digittext)
[![Latest Stable Version](https://poser.pugx.org/andrey-helldar/digittext/v/stable)](https://packagist.org/packages/andrey-helldar/digittext)
[![Latest Unstable Version](https://poser.pugx.org/andrey-helldar/digittext/v/unstable)](https://packagist.org/packages/andrey-helldar/digittext)
[![PHP-Eye](https://php-eye.com/badge/andrey-helldar/digittext/tested.svg?style=flat)](https://php-eye.com/package/andrey-helldar/digittext)


[![Dependency Status](https://www.versioneye.com/php/andrey-helldar:digittext/dev-master/badge.svg)](https://www.versioneye.com/php/andrey-helldar:digittext/dev-master)
[![License](https://poser.pugx.org/andrey-helldar/digittext/license)](https://packagist.org/packages/andrey-helldar/digittext)

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

Вы можете задонатить автору пакета: [PayPal](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=94B8LCPAPJ5VG), Yandex Money (410012608840929), WebMoney (Z124862854284)

## Копирайты и лицензия

DigitText разработан Андреем Хэллдаром для фреймворка Laravel версии 5.3 или выше, и распространяется под лицензией MIT. Смотрите файл LICENSE.
