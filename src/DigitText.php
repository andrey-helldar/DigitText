<?php
/*
 * The MIT License
 *
 * Copyright 2015-2017 Andrey Helldar <helldar@ai-rus.com>.
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

/**
 * Class DigitText
 */
class DigitText
{
    /**
     * Default language.
     *
     * @var string
     */
    private $lang_fallback = 'en';

    /**
     * Selected locale.
     *
     * @var string
     */
    private $lang = 'en';

    /**
     * Array of numbers.
     *
     * @var array
     */
    private $texts;

    /**
     * Remainder of the division.
     *
     * @var int
     */
    private $surplus = 0;

    /**
     * @var bool
     */
    private $is_currency = false;

    /**
     * @var float
     */
    private $digit = null;

    /**
     * Set lang.
     *
     * @param string $lang
     */
    private function lang($lang = 'en')
    {
        $filename = sprintf('%s/lang/%s.php', __DIR__, trim($lang));
        $this->lang = file_exists($filename) ? trim($lang) : $this->lang_fallback;
    }

    /**
     * Set currency.
     *
     * @param bool $is_currency
     */
    private function currency($is_currency = false)
    {
        $this->is_currency = (bool) $is_currency;
    }

    /**
     * Showing a fractional number in a text equivalent from a static method.
     *
     * @param float  $digit
     * @param string $lang
     * @param bool   $is_currency
     *
     * @return mixed|string|void
     */
    public static function get($digit = 0.0, $lang = 'en', $is_currency = false)
    {
        return (new self())->text($digit, $lang, $is_currency);
    }

    /**
     * Showing a fractional number in a text equivalent.
     *
     * TODO: Incorrect translation into German.
     *
     * @param float  $digit
     * @param string $lang
     * @param bool   $is_currency
     *
     * @return mixed|string|void
     */
    public function text($digit = 0.0, $lang = 'en', $is_currency = false)
    {
        $this->lang($lang);
        $this->currency($is_currency);
        $this->fixDigit($digit);

        // Return text from php_intl library
        $intl = $this->intl();
        if (!empty($intl)) {
            return $intl;
        }

        // Loading texts from locale page
        $this->loadTexts();

        if ($this->digit == 0) {
            return $this->texts['zero'];
        }

        // Get the fractional part
        $this->fraction();

        $groups = str_split($this->digitReverse((int) $this->digit), 3);
        $result = array();
        for ($i = sizeof($groups) - 1; $i >= 0; $i--) {
            if ((int) $groups[$i] > 0) {
                $result[] = $this->digits($groups[$i], $i);
            }
        }

        if ($this->lang == 'de') {
            $result = array_reverse($result);
        }

        $result = implode(($this->lang == 'de' ? 'und' : ' '), $result);

        return $this->is_currency ? $this->getCurrency($result) : trim($result);
    }

    /**
     * @param null $digit
     */
    private function fixDigit($digit = null)
    {
        if (empty($digit)) {
            $this->digit = 0;

            return;
        }

        $digit = str_replace(array(',', '-', ' ', "'", '`'), '', (string) $digit);

        if (strripos((string) $digit, '.') === false) {
            $this->digit = (float) $digit;

            return;
        }

        $digit = explode('.', $digit);
        $this->digit = (float) sprintf('%s.%s', intval($digit[0]), intval($digit[1]));
    }

    /**
     * php_intl Loader.
     *
     * @return string|void
     */
    private function intl()
    {
        if ($this->is_currency) {
            if (extension_loaded('php_intl')) {
                return (new \MessageFormatter($this->lang, '{n, spellout}'))->format(array('n' => $this->digit));
            }
        }

        return;
    }

    /**
     * Loading localized data.
     */
    private function loadTexts()
    {
        $filename = sprintf('%s/lang/%s.php', __DIR__, $this->lang);
        $lang = file_exists($filename) ? $this->lang : $this->lang_fallback;
        $this->texts = require sprintf('%s/lang/%s.php', __DIR__, $lang);
    }

    /**
     * Get the fractional part.
     *
     * @return void
     */
    private function fraction()
    {
        if (empty($this->digit)) {
            $this->surplus = 0;

            return;
        }

        $pos = strripos((string) $this->digit, '.');
        $this->surplus = $pos === false ? 0 : mb_substr((string) $this->digit, $pos + 1);
    }

    /**
     * Reverse digits.
     *
     * @param string $digit
     *
     * @return string
     */
    private function digitReverse($digit = '0')
    {
        return strrev((string) $digit);
    }

    /**
     * The conversion of numbers in text.
     *
     * @param float $digit
     * @param int   $id
     *
     * @return string
     */
    private function digits($digit = 0.0, $id = 0)
    {
        if ($digit == 0) {
            return $this->texts['zero'];
        }

        $digitUnsorted = (int) $this->digitReverse($digit);

        $array = str_split((string) $digit, 1);
        $result = array();

        for ($i = sizeof($array) - 1; $i >= 0; $i--) {
            if ($i === 1 && $array[$i] == '1') {
                $d = $array[$i].$array[$i - 1];
                $result[] = trim($this->texts[$id == 1 ? 3 : 0][(int) $d]);
                $i--;
            } elseif ((int) $array[$i] > 0) {
                $result[] = $this->texts[$id == 1 ? $i + 3 : $i][$array[$i]];
            }
        }

        $result = implode(($this->lang == 'de' ? 'und' : ' '), $result);

        return trim(trim($result).$this->decline($id, $digitUnsorted));
    }

    /**
     * Declination of discharges.
     *
     * @param int   $group
     * @param float $digit
     *
     * @return string
     */
    private function decline($group = 0, $digit = 0.0)
    {
        $text = (string) ((int) $digit);
        $text = (int) $text[strlen($digit) - 1];
        $result = '';
        $deleter = $this->lang == 'de' ? '' : ' ';

        switch ($group) {
            case 1:
                $result = $deleter.$this->texts['thousands'][0];
                if ($text == 1) {
                    $result = $deleter.$this->texts['thousands'][1];
                } elseif ($text >= 2 && $text <= 4) {
                    $result = $deleter.$this->texts['thousands'][2];
                }
                break;

            case 2:
                $result = $deleter.$this->texts['millions'][0];
                if ($text >= 2 && $text <= 4) {
                    $result = $deleter.$this->texts['millions'][1];
                } elseif (($text >= 5 && $text <= 9) || $text == 0) {
                    $result = $deleter.$this->texts['millions'][2];
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
    private function getCurrency($content = null)
    {
        if (empty($content)) {
            return '---';
        }

        if ($this->texts['currency']['position'] == 'before') {
            $result = $this->texts['currency']['int'].' '.$content;

            if ($this->surplus > 0) {
                $result .= '.'.$this->surplus;
            }
        } else {
            $result = trim($content).' '.$this->texts['currency']['int'];

            if ($this->surplus > 0) {
                $result .= ' '.$this->surplus.' '.$this->texts['currency']['fraction'];
            } else {
                $result .= ' 00 '.$this->texts['currency']['fraction'];
            }
        }

        return $result;
    }
}
