<?php

if (!function_exists('digit_text')) {
    /**
     * A Helper for showing a fractional number in a text equivalent from a static method.
     *
     * @param float $number
     * @param null|string $locale If set to `NULL`, the global value will be taken.
     * @param bool $is_currency
     *
     * @return string
     */
    function digit_text(float $number = 0.0, string $locale = null, bool $is_currency = false): string
    {
        return app('digit_text')->get($number, $locale, $is_currency);
    }
}
