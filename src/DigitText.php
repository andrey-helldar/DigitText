<?php
/*
 * The MIT License
 *
 * Copyright 2016 Andrey Helldar <helldar@ai-rus.com>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace Helldar\DigitText;

class DigitText
{
    /**
     * Home locale.
     *
     * @var string
     */
    private static $lang = 'en';

    /**
     * Default language.
     *
     * @var string
     */
    private static $lang_fallback = 'en';

    /**
     * Array of numbers.
     *
     * @var array
     */
    private static $texts;

    /**
     * Remainder of the division.
     *
     * @var int
     */
    private static $surplus = 0;

    /**
     * Showing a fractional number in a text equivalent.
     *
     * @param float  $digit
     * @param string $lang
     * @param bool   $currency
     *
     * @return string
     */
    public static function text($digit = 0.0, $lang = 'en', $currency = false)
    {
        if (!is_null($lang)) {
            self::$lang = $lang;
        }

        // Return text from php_intl library
        $intl = self::intl($digit, $lang, $currency);
        if (!is_null($intl)) {
            return $intl;
        }

        // Loading texts from locale page
        self::loadTexts();

        if (is_null($digit) || $digit == 0) {
            return self::$texts['zero'];
        }

        // Get the fractional part
        self::fraction((float)$digit);

        // Get the integer part
        $digit = (int)str_replace([',', ' '], '', $digit);

        $groups = str_split(self::dsort((int)$digit), 3);
        $result = '';

        for ($i = count($groups) - 1; $i >= 0; $i--) {
            if ((int)$groups[$i] > 0) {
                $result .= ' ' . trim(self::digits($groups[$i], $i));
            }
        }

        return $currency ? self::currency($result) : trim($result);
    }

    /**
     * php_intl Loader.
     *
     * @author  Andrey Helldar <helldar@ai-rus.com>
     * @version 2016-11-28
     * @since   1.0
     *
     * @param float  $digit
     * @param string $lang
     * @param bool   $currency
     *
     * @return string
     */
    private static function intl($digit = 0.0, $lang = 'en-US', $currency = false)
    {
        if ($currency) {
            if (extension_loaded('php_intl')) {
                return (new \MessageFormatter($lang, '{n, spellout}'))->format(['n' => $digit]);
            }
        }
    }

    /**
     * Loading localized data.
     */
    private static function loadTexts()
    {
        $locale      = __DIR__ . '/lang/' . self::$lang . '/digittext.php';
        $lang        = file_exists($locale) ? self::$lang : self::$lang_fallback;
        self::$texts = require __DIR__ . '/lang/' . $lang . '/digittext.php';
    }

    /**
     * Get the fractional part.
     *
     * @param float $digit
     *
     * @return type
     */
    private static function fraction($digit = null)
    {
        if (is_null($digit)) {
            self::$surplus = 0;

            return;
        }

        $pos           = strripos((string)$digit, '.');
        self::$surplus = $pos === false ? 0 : mb_substr((string)$digit, $pos + 1);
    }

    /**
     * Sorting digits.
     *
     * @param string $digit
     *
     * @return string
     */
    private static function dsort($digit = '0')
    {
        $digit = (string)$digit;

        if ($digit == '0') {
            return [0 => 0];
        }

        $sortedDigit = '';

        for ($i = strlen($digit) - 1; $i >= 0; $i--) {
            $sortedDigit .= $digit[$i];
        }

        return $sortedDigit;
    }

    /**
     * The conversion of numbers in text.
     *
     * @param float $digit
     * @param int   $id
     *
     * @return string
     */
    private static function digits($digit = 0.0, $id = 0)
    {
        if ($digit == 0) {
            return self::$texts['zero'];
        }

        $digitUnsorted = (int)self::dsort($digit);

        if ($digitUnsorted > 0 && $digitUnsorted < 20) {
            return trim(self::$texts[$id == 1 ? 3 : 0][(int)$digitUnsorted] . self::decline($id, $digitUnsorted));
        }

        $array  = str_split((string)$digit, 1);
        $result = '';

        for ($i = count($array) - 1; $i >= 0; $i--) {
            $result .= ' ' . self::$texts[$id == 1 ? $i + 3 : $i][$array[$i]];
        }

        return trim($result) . self::decline($id, $digitUnsorted);
    }

    /**
     * Declination of discharges.
     *
     * @param int   $group
     * @param float $digit
     *
     * @return string
     */
    private static function decline($group = 0, $digit = 0.0)
    {
        $text   = (string)((int)$digit);
        $text   = (int)$text[strlen($digit) - 1];
        $result = '';

        switch ($group) {
            case 1:
                $result = ' ' . self::$texts['thousands'][0];
                if ($text == 1) {
                    $result = ' ' . self::$texts['thousands'][1];
                } elseif ($text >= 2 && $text <= 4) {
                    $result = ' ' . self::$texts['thousands'][2];
                }
                break;

            case 2:
                $result = ' ' . self::$texts['millions'][0];
                if ($text >= 2 && $text <= 4) {
                    $result = ' ' . self::$texts['millions'][1];
                } elseif (($text >= 5 && $text <= 9) || $text == 0) {
                    $result = ' ' . self::$texts['millions'][2];
                }
                break;

            default:
                break;
        }

        return $result;
    }

    /**
     * Form the payment amount.
     *
     * @param string $content
     *
     * @return string
     */
    private static function currency($content = null)
    {
        if (is_null($content)) {
            return '---';
        }

        if (self::$texts['currency']['position'] == 'before') {
            $result = self::$texts['currency']['int'] . ' ' . $content;

            if (self::$surplus > 0) {
                $result .= '.' . self::$surplus;
            }
        } else {
            $result = trim($content) . ' ' . self::$texts['currency']['int'];

            if (self::$surplus > 0) {
                $result .= ' ' . self::$surplus . ' ' . self::$texts['currency']['fraction'];
            } else {
                $result .= ' 00 ' . self::$texts['currency']['fraction'];
            }
        }

        return $result;
    }
}
