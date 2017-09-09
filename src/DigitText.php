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
    private function setLang(string $lang = 'en')
    {
        $filename   = sprintf('%s/lang/%s.php', __DIR__, trim($lang));
        $this->lang = (file_exists($filename) ? trim($lang) : $this->lang_fallback);
    }

    /**
     * Set currency.
     *
     * @param bool $is_currency
     */
    private function setCurrency(bool $is_currency = false)
    {
        $this->is_currency = (bool)$is_currency;
    }

    /**
     * Showing a fractional number in a text equivalent.
     *
     * TODO: Incorrect translation into German when specifying a fractional number.
     *
     * @param float|string $digit
     * @param string       $lang
     * @param bool         $is_currency
     *
     * @return null|string
     */
    public function get($digit = 0.0, string $lang = 'en', bool $is_currency = false)
    {
        $this->setLang($lang);
        $this->setCurrency($is_currency);
        $this->fixDigit($digit);

        if ($intl = $this->intl()) {
            return $intl;
        }

        $this->loadTexts();

        if ($this->digit == 0) {
            return $this->texts['zero'];
        }

        return $this->getResult();
    }

    /**
     * @return string
     */
    private function getResult()
    {
        $result  = $this->getFractional();
        $divider = ($this->lang == 'de' ? 'und' : ' ');

        if ($this->lang === 'de') {
            $result = array_reverse($result);
        }

        $result = implode($divider, $result);

        return $this->is_currency ? $this->getCurrency($result) : trim($result);
    }

    /**
     * Get the fractional part.
     *
     * @return array
     */
    private function getFractional()
    {
        $this->fraction();

        $groups = str_split($this->digitReverse((int)$this->digit), 3);
        $result = [];

        for ($i = sizeof($groups) - 1; $i >= 0; $i--) {
            if ((int)$groups[$i] > 0) {
                array_push($result, $this->digits($groups[$i], $i));
            }
        }

        return $result;
    }

    /**
     * Fix input digits.
     *
     * @param null|string $digit
     */
    private function fixDigit($digit = null)
    {
        if (empty($digit)) {
            $this->digit = 0;

            return;
        }

        $digit = str_replace([',', '-', ' ', "'", '`'], '', (string)$digit);

        if (strripos((string)$digit, '.') === false) {
            $this->digit = (float)$digit;

            return;
        }

        $digit       = explode('.', $digit);
        $this->digit = (float)sprintf('%s.%s', intval($digit[0]), intval($digit[1]));
    }

    /**
     * php_intl Loader.
     *
     * @return null|string
     */
    private function intl()
    {
        if ($this->is_currency && extension_loaded('php_intl')) {
            return (new \MessageFormatter($this->lang, '{n, spellout}'))->format(['n' => $this->digit]);
        }

        return null;
    }

    /**
     * Loading localized data.
     */
    private function loadTexts()
    {
        $filename    = sprintf('%s/lang/%s.php', __DIR__, $this->lang);
        $lang        = file_exists($filename) ? $this->lang : $this->lang_fallback;
        $this->texts = (require sprintf('%s/lang/%s.php', __DIR__, $lang));
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

        $pos = strripos((string)$this->digit, '.');

        $this->surplus = ($pos === false ? 0 : mb_substr((string)$this->digit, $pos + 1));
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
        return strrev((string)$digit);
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

        $array  = str_split((string)$digit, 1);
        $result = [];

        for ($i = sizeof($array) - 1; $i >= 0; $i--) {
            if ($i === 1 && $array[$i] == '1') {
                $d = ($array[$i] . $array[$i - 1]);
                array_push($result, trim($this->texts[$id == 1 ? 3 : 0][(int)$d]));
                $i--;
            } elseif ((int)$array[$i] > 0) {
                array_push($result, $this->texts[$id == 1 ? $i + 3 : $i][$array[$i]]);
            }
        }

        $reversed = (int)$this->digitReverse($digit);
        $divider  = ($this->lang == 'de' ? 'und' : ' ');
        $result   = implode($divider, $result);

        return trim(trim($result) . $this->decline($id, $reversed));
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
        $text    = (string)((int)$digit);
        $text    = (int)$text[strlen($digit) - 1];
        $result  = '';
        $divider = ($this->lang == 'de' ? '' : ' ');

        switch ($group) {
            case 1:
                $result = ($divider . $this->texts['thousands'][0]);
                if ($text == 1) {
                    $result = ($divider . $this->texts['thousands'][1]);
                } elseif ($text >= 2 && $text <= 4) {
                    $result = ($divider . $this->texts['thousands'][2]);
                }
                break;

            case 2:
                $result = ($divider . $this->texts['millions'][0]);
                if ($text >= 2 && $text <= 4) {
                    $result = ($divider . $this->texts['millions'][1]);
                } elseif (($text >= 5 && $text <= 9) || $text == 0) {
                    $result = ($divider . $this->texts['millions'][2]);
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
    private function getCurrency(string $content = null)
    {
        if (empty($content)) {
            return '---';
        }

        if ($this->texts['currency']['position'] == 'before') {
            $result = implode(' ', [
                $this->texts['currency']['int'],
                $content,
            ]);

            if ($this->surplus > 0) {
                $result .= ('.' . $this->surplus);
            }
        } else {
            $result = implode(' ', [
                trim($content),
                $this->texts['currency']['int'],
            ]);

            if ($this->surplus > 0) {
                $result .= implode(' ', [
                    '',
                    $this->surplus,
                    $this->texts['currency']['fraction'],
                ]);
            } else {
                $result .= implode(' ', [
                    ' 00',
                    $this->texts['currency']['fraction'],
                ]);
            }
        }

        return $result;
    }
}
