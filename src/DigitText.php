<?php
/*
 * The MIT License
 *
 * Copyright 2015 Andrey Helldar <helldar@ai-rus.com>.
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
    static $texts = [
        0 => [
            0  => '',
            1  => 'один',
            2  => 'два',
            3  => 'три',
            4  => 'четыре',
            5  => 'пять',
            6  => 'шесть',
            7  => 'семь',
            8  => 'восемь',
            9  => 'девять',
            10 => 'десять',
            11 => 'одиннадцать',
            12 => 'двенадцать',
            13 => 'тринадцать',
            14 => 'четырнадцать',
            15 => 'пятнадцать',
            16 => 'шестнадцать',
            17 => 'семнадцать',
            18 => 'восемнадцать',
            19 => 'девятнадцать',
        ],
        1 => [
            0 => '',
            2 => 'двадцать',
            3 => 'тридцать',
            4 => 'сорок',
            5 => 'пятьдесят',
            6 => 'шестьдесят',
            7 => 'семьдесят',
            8 => 'восемьдесят',
            9 => 'девяносто',
        ],
        2 => [
            0 => '',
            1 => 'сто',
            2 => 'двести',
            3 => 'триста',
            4 => 'четыреста',
            5 => 'пятьсот',
            6 => 'шестьсот',
            7 => 'семьсот',
            8 => 'восемьсот',
            9 => 'девятьсот',
        ],
        3 => [
            0  => '',
            1  => 'одна',
            2  => 'две',
            3  => 'три',
            4  => 'четыре',
            5  => 'пять',
            6  => 'шесть',
            7  => 'семь',
            8  => 'восемь',
            9  => 'девять',
            10 => 'десять',
            11 => 'одиннадцать',
            12 => 'двенадцать',
            13 => 'тринадцать',
            14 => 'четырнадцать',
            15 => 'пятнадцать',
            16 => 'шестнадцать',
            17 => 'семнадцать',
            18 => 'восемнадцать',
            19 => 'девятнадцать',
        ],
        4 => [
            0 => '',
            2 => 'двадцать',
            3 => 'тридцать',
            4 => 'сорок',
            5 => 'пятьдесят',
            6 => 'шестьдесят',
            7 => 'семьдесят',
            8 => 'восемьдесят',
            9 => 'девяносто',
        ],
        5 => [
            0 => '',
            1 => 'сто',
            2 => 'двести',
            3 => 'триста',
            4 => 'четыреста',
            5 => 'пятьсот',
            6 => 'шестьсот',
            7 => 'семьсот',
            8 => 'восемьсот',
            9 => 'девятьсот',
        ],
        6 => [
            0  => '',
            1  => 'один',
            2  => 'два',
            3  => 'три',
            4  => 'четыре',
            5  => 'пять',
            6  => 'шесть',
            7  => 'семь',
            8  => 'восемь',
            9  => 'девять',
            10 => 'десять',
            11 => 'одиннадцать',
            12 => 'двенадцать',
            13 => 'тринадцать',
            14 => 'четырнадцать',
            15 => 'пятнадцать',
            16 => 'шестнадцать',
            17 => 'семнадцать',
            18 => 'восемнадцать',
            19 => 'девятнадцать',
        ],
        7 => [
            0 => '',
            2 => 'двадцать',
            3 => 'тридцать',
            4 => 'сорок',
            5 => 'пятьдесят',
            6 => 'шестьдесят',
            7 => 'семьдесят',
            8 => 'восемьдесят',
            9 => 'девяносто',
        ],
        8 => [
            0 => '',
            1 => 'сто',
            2 => 'двести',
            3 => 'триста',
            4 => 'четыреста',
            5 => 'пятьсот',
            6 => 'шестьсот',
            7 => 'семьсот',
            8 => 'восемьсот',
            9 => 'девятьсот',
        ],
    ];
    static $group = [
        3 => [
            1  => 'тысяча',
            2  => 'тысячи',
            3  => 'тысячи',
            4  => 'тысячи',
            5  => 'тысяч',
            6  => 'тысяч',
            7  => 'тысяч',
            8  => 'тысяч',
            9  => 'тысяч',
            10 => 'тысяч',
            11 => 'тысяч',
            12 => 'тысяч',
            13 => 'тысяч',
            14 => 'тысяч',
            15 => 'тысяч',
            16 => 'тысяч',
            17 => 'тысяч',
            18 => 'тысяч',
            19 => 'тысяч',
        ],
        6 => [
            1 => 'миллион',
            2 => 'миллиона',
            3 => 'миллиона',
            4 => 'миллиона',
            5 => 'миллионов',
            6 => 'миллионов',
            7 => 'миллионов',
            8 => 'миллионов',
            9 => 'миллионов',
        ]
    ];

    /**
     * Showing a fractional number in a text equivalent.
     *
     * @param integer $digit
     * @param string  $lang
     *
     * @return string
     */
    static function getText($digit = null, $lang = 'ru')
    {
        $digit      = (int) $digit;
        $digitArray = str_split((string) $digit, 1);

        if (is_null($digit) || $digit == 0) {
            return 'ноль';
        }

        if ($digit > 0 && $digit < 20) {
            return self::$texts[0][$digit];
        }

        $result = "";

        for ($i = 0; $i < count($digitArray); $i++) {
            $k      = count($digitArray) - $i - 1;
            $result = self::$texts[$i][$digitArray[$k]] . DigitText::getGroup($i, $digitArray[$k]) . ' ' . $result;
        }

        echo '<div><span style="display:inline-block; width:120px;">' . number_format($digit) . '</span> ' . trim($result) . '</div>';
    }

    private function getGroup($id = null, $digit = null)
    {
        if (is_null($id)) {
            return '';
        }

        if (array_key_exists($id, self::$group)) {
            if (array_key_exists($digit, self::$group[$id])) {
                return ' ' . self::$group[$id][$digit];
            }
        }

        return '';
    }

    static function hundreds($digit = 0)
    {
        if ($digit == 0) {
            return 'ноль';
        }

        if ($digit > 0 && $digit < 20) {
            return self::$texts[0][$digit];
        }
    }

    static function thousands($digit = 0)
    {
        if ($digit == 0) {
            return 'ноль';
        }

        if ($digit > 0 && $digit < 20) {
            return self::$texts[0][$digit];
        }
    }

    static function millions($digit = 0)
    {
        if ($digit == 0) {
            return 'ноль';
        }

        if ($digit > 0 && $digit < 20) {
            return self::$texts[0][$digit];
        }
    }
}
