## DigitText for Laravel 5.5+

The module allows to translate numbers into a text equivalent. This is important in the billing.

![digittext](https://user-images.githubusercontent.com/10347617/40197725-f2138bfe-5a1c-11e8-99be-8a42715516c9.png)

<p align="center">
    <a href="https://styleci.io/repos/45746985"><img src="https://styleci.io/repos/45746985/shield" alt="StyleCI" /></a>
    <a href="https://packagist.org/packages/andrey-helldar/DigitText"><img src="https://img.shields.io/packagist/dt/andrey-helldar/DigitText.svg?style=flat-square" alt="Total Downloads" /></a>
    <a href="https://packagist.org/packages/andrey-helldar/DigitText"><img src="https://poser.pugx.org/andrey-helldar/DigitText/v/stable?format=flat-square" alt="Latest Stable Version" /></a>
    <a href="https://packagist.org/packages/andrey-helldar/DigitText"><img src="https://poser.pugx.org/andrey-helldar/DigitText/v/unstable?format=flat-square" alt="Latest Unstable Version" /></a>
    <a href="LICENSE"><img src="https://poser.pugx.org/andrey-helldar/DigitText/license?format=flat-square" alt="License" /></a>
</p>


## Installation

To get the latest version of DigitText, simply require the project using [Composer](https://getcomposer.org/):

```bash
$ composer require andrey-helldar/digittext
```

Instead, you may of course manually update your require block and run `composer update` if you so choose:

```json
{
    "require": {
        "andrey-helldar/digittext": "^5.0"
    }
}
```

If you don't use auto-discovery, add the ServiceProvider to the providers array in `config/app.php`:

```php
Helldar\DigitText\ServiceProvider::class,
```

Now, use `DigitText` Facade or `digit_text()` helper.


## Documentation

You can use a helper

```php
digit_text($number = 0, string $lang = 'en', bool $is_currency = false);
```

or go directly to a class "Helldar\DigitText\DigitText":

```php
(new DigitText)
    ->get($number = 0, $lang = 'en', $is_currency = false);
```

Example:
```php
echo digit_text(null);          // zero
echo digit_text(64.23);         // sixty four
echo digit_text(2866);          // two thousands eight hundred sixty six
echo digit_text(2866, 'ru');    // две тысячи восемьсот шестьдесят шесть

echo digit_text(0, 'en', true);     // zero dollar
echo digit_text(64.23, 'en', true); // sixty four dollars 23 cents
echo digit_text(2866, 'en', true);  // two thousands eight hundred sixty six dollars
echo digit_text(2866, 'ru', true);  // две тысячи восемьсот шестьдесят шесть руб
```


## Support Languages

    EN - English
    DE - Deutsch
    RU - Русский
    UK - Український
    

## Copyright and License

DigitText was written for the Laravel framework 5.5 or later, and is released under the [MIT License](LICENSE).
