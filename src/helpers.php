<?php

use Helldar\DigitText\DigitText;

if (!function_exists('digit_text')) {
    /**
     * A Helper for showing a fractional number in a text equivalent from a static method.
     *
     * @param float $digit
     * @param string $lang
     * @param bool $is_currency
     *
     * @return string
     */
    function digit_text($digit = 0.0, string $lang = 'en', bool $is_currency = false)
    {
        return (new DigitText)
            ->get($digit, $lang, $is_currency);
    }
}
