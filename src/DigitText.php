<?php
/*
 * The MIT License
 *
 * Copyright 2017 Andrey Helldar <helldar@ai-rus.com>.
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
     * @var string
     */
    private $result = '';

    /**
     * Return result.
     *
     * @author Andrey Helldar <helldar@ai-rus.com>
     *
     * @since  2017-03-27
     * @return string
     */
    public function get()
    {
        return $this->result;
    }

    /**
     * Set lang.
     *
     * @author Andrey Helldar <helldar@ai-rus.com>
     *
     * @since  2017-03-27
     *
     * @param null $lang
     *
     * @return $this
     */
    public function lang($lang = null)
    {
        $this->lang = !empty(trim($lang)) ? trim($lang) : $this->lang_fallback;

        return $this;
    }

    /**
     * Set currency.
     *
     * @author Andrey Helldar <helldar@ai-rus.com>
     *
     * @since  2017-03-27
     *
     * @param bool $is_currency
     *
     * @return $this
     */
    public function currency($is_currency = false)
    {
        $this->is_currency = (bool) $is_currency;

        return $this;
    }

    /**
     * Showing a fractional number in a text equivalent.
     *
     * @param float $digit
     *
     * @return $this
     */
    public function number($digit = 0.0)
    {
        // Return text from php_intl library
        $intl = $this->intl($digit);
        if(!empty($intl)) {
            $this->result = $intl;

            return $this;
        }

        // Loading texts from locale page
        $this->loadTexts();

        if(empty($digit) || $digit == 0) {
            $this->result = $this->texts['zero'];

            return $this;
        }

        // Get the fractional part
        $this->fraction((float) $digit);

        // Get the integer part
        $digit = (int) str_replace(array(',', ' '), '', $digit);

        $groups = str_split($this->dsort((int) $digit), 3);
        $result = '';
        for($i = sizeof($groups) - 1; $i >= 0; $i--) {
            if((int) $groups[$i] > 0) {
                $result .= ' '.$this->digits($groups[$i], $i);
            }
        }

        $this->result = $this->is_currency ? $this->getCurrency($result) : trim($result);

        return $this;
    }

    /**
     * php_intl Loader.
     *
     * @author  Andrey Helldar <helldar@ai-rus.com>
     *
     * @since   2016-11-28
     * @since   2017-03-27 Refactoring code.
     *
     * @param float $digit
     *
     * @return string|void
     */
    private function intl($digit = 0.0)
    {
        if($this->is_currency) {
            if(extension_loaded('php_intl')) {
                return (new \MessageFormatter($this->lang, '{n, spellout}'))->format(array('n' => $digit));
            }
        }

        return;
    }

    /**
     * Loading localized data.
     *
     * @author Andrey Helldar <helldar@ai-rus.com>
     *
     * @since  2017-03-27
     */
    private function loadTexts()
    {
        $locale      = sprintf("%s/lang/%s.php", __DIR__, $this->lang);
        $lang        = file_exists($locale) ? $this->lang : $this->lang_fallback;
        $this->texts = require sprintf("%s/lang/%s.php", __DIR__, $lang);
    }

    /**
     * Get the fractional part.
     *
     * @param float $digit
     *
     * @return void
     */
    private function fraction($digit = null)
    {
        if(empty($digit)) {
            $this->surplus = 0;

            return;
        }

        $pos           = strripos((string) $digit, '.');
        $this->surplus = $pos === false ? 0 : mb_substr((string) $digit, $pos + 1);
    }

    /**
     * Sorting digits.
     *
     * @param string $digit
     *
     * @return string
     */
    private function dsort($digit = '0')
    {
        $digit       = (string) $digit;
        $sortedDigit = '';

        if($digit == '0') {
            return array(0 => 0);
        }

        for($i = strlen($digit) - 1; $i >= 0; $i--) {
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
    private function digits($digit = 0.0, $id = 0)
    {
        if($digit == 0) {
            return $this->texts['zero'];
        }

        $digitUnsorted = (int) $this->dsort($digit);

        $array  = str_split((string) $digit, 1);
        $result = '';

        for($i = sizeof($array) - 1; $i >= 0; $i--) {
            if($i === 1 && $array[$i] == '1') {
                $d      = $array[$i].$array[$i - 1];
                $result .= ' '.trim($this->texts[$id == 1 ? 3 : 0][(int) $d]);
                $i--;
            } elseif((int) $array[$i] > 0) {
                $result .= ' '.$this->texts[$id == 1 ? $i + 3 : $i][$array[$i]];
            }
        }

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
        $text   = (string) ((int) $digit);
        $text   = (int) $text[strlen($digit) - 1];
        $result = '';

        switch($group) {
            case 1:
                $result = ' '.$this->texts['thousands'][0];
                if($text == 1) {
                    $result = ' '.$this->texts['thousands'][1];
                } elseif($text >= 2 && $text <= 4) {
                    $result = ' '.$this->texts['thousands'][2];
                }
                break;

            case 2:
                $result = ' '.$this->texts['millions'][0];
                if($text >= 2 && $text <= 4) {
                    $result = ' '.$this->texts['millions'][1];
                } elseif(($text >= 5 && $text <= 9) || $text == 0) {
                    $result = ' '.$this->texts['millions'][2];
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
        if(empty($content)) {
            return '---';
        }

        if($this->texts['currency']['position'] == 'before') {
            $result = $this->texts['currency']['int'].' '.$content;

            if($this->surplus > 0) {
                $result .= '.'.$this->surplus;
            }
        } else {
            $result = trim($content).' '.$this->texts['currency']['int'];

            if($this->surplus > 0) {
                $result .= ' '.$this->surplus.' '.$this->texts['currency']['fraction'];
            } else {
                $result .= ' 00 '.$this->texts['currency']['fraction'];
            }
        }

        return $result;
    }
}
