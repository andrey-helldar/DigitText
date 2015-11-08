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
    public static $texts = [
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
    ];

    /**
     * Showing a fractional number in a text equivalent.
     *
     * @param int    $digit
     * @param string $lang
     *
     * @return string
     */
    public static function text($digit = null, $lang = 'ru')
    {
        if ($digit == 0) {
            return 'ноль';
        }

        $groups = str_split(self::dsort((int) $digit), 3);
        $result = '';

        for ($i = count($groups) - 1; $i >= 0; $i--) {
            $result .= ' '.trim(self::digits($groups[$i], $i));
        }

//        print_r($groups);
//        echo '<div><span style="display:inline-block; width:120px;">' . number_format((int)$digit) . '</span> ' . trim($result) . '</div>';
        return trim($result);
    }

    private static function digits($digit = 0, $id = 0)
    {
        if ($digit == 0) {
            return 'ноль';
        }

        $digitUnsorted = self::dsort($digit);

        if ($digitUnsorted > 0 && $digitUnsorted < 20) {
            return trim(self::$texts[$id == 1 ? 3 : 0][(int) $digitUnsorted].self::decline($id, $digitUnsorted));
        }

        $array = str_split((string) $digit, 1);

        $result = '';

        for ($i = count($array) - 1; $i >= 0; $i--) {
            $result .= ' '.self::$texts[$id == 1 ? $i + 3 : $i][$array[$i]];
        }

        return trim($result).self::decline($id, $digitUnsorted);
    }

    /**
     * Sorting digits
     *
     * @param string $digit
     *
     * @return string
     */
    private static function dsort($digit = '0')
    {
        $digit = (string) $digit;

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
     * Declination of discharges
     *
     * @param integer $group
     * @param string $digit
     *
     * @return string
     */
    private static function decline($group = 0, $digit = 0)
    {
        $text = (string) ((int) $digit);
        $text = (int) $text[strlen($digit) - 1];

        $result = '';

        switch ($group) {
            case 1:$result = ' тысяч';
                if ($text == 1) {
                    $result .= 'а';
                } elseif ($text >= 2 && $text <= 4) {
                    $result .= 'и';
                }
                break;

            case 2: $result = ' миллион';
                if ($text >= 2 && $text <= 4) {
                    $result .= 'а';
                } elseif (($text >= 5 && $text <= 9) || $text == 0) {
                    $result .= 'ов';
                }
                break;

            default :break;
        }

        return $result;
    }
}
