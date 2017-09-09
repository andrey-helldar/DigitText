<?php

declare(strict_types=1);

/**
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

namespace Helldar\DigitText\Tests;

use Helldar\DigitText\DigitText;

class DigitTextTest extends \GrahamCampbell\TestBench\AbstractTestCase
{
    /**
     * @var DigitText
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = (new DigitText());
    }

    /**
     * Russian localization testing.
     */
    public function testRu()
    {
        $result = [
            $this->object->get(0, 'ru')                 => 'ноль',
            $this->object->get(64.23, 'ru', true)       => 'шестьдесят четыре руб 23 коп',
            $this->object->get(764, 'ru')               => 'семьсот шестьдесят четыре',
            $this->object->get(2866, 'ru')              => 'две тысячи восемьсот шестьдесят шесть',
            $this->object->get(7700, 'ru')              => 'семь тысяч семьсот',
            $this->object->get('10,000', 'ru')          => 'десять тысяч',
            $this->object->get(14383, 'ru')             => 'четырнадцать тысячи триста восемьдесят три',
            $this->object->get(20383, 'ru')             => 'двадцать тысяч триста восемьдесят три',
            $this->object->get(700383, 'ru')            => 'семьсот тысяч триста восемьдесят три',
            $this->object->get(7644383, 'ru')           => 'семь миллионов шестьсот сорок четыре тысячи триста восемьдесят три',
            $this->object->get(70043783.65, 'ru', true) => 'семьдесят миллионов сорок три тысячи семьсот восемьдесят три руб 65 коп',
            $this->object->get(786443783, 'ru')         => 'семьсот восемьдесят шесть миллионов четыреста сорок три тысячи семьсот восемьдесят три',
            $this->object->get(109, 'ru')               => 'сто девять',
            $this->object->get(110, 'ru')               => 'сто десять',
            $this->object->get(111, 'ru')               => 'сто одиннадцать',
            $this->object->get(112, 'ru')               => 'сто двенадцать',
            $this->object->get(116, 'ru')               => 'сто шестнадцать',
            $this->object->get(118, 'ru')               => 'сто восемнадцать',
            $this->object->get(120, 'ru')               => 'сто двадцать',
            $this->object->get(121, 'ru')               => 'сто двадцать один',
            $this->object->get(10010, 'ru')             => 'десять тысяч десять',
            $this->object->get(10110, 'ru')             => 'десять тысяч сто десять',
            $this->object->get(510110, 'ru')            => 'пятьсот десять тысяч сто десять',
        ];

        $this->runTestDigits($result);
    }

    /**
     * English localization testing.
     */
    public function testEn()
    {
        $result = [
            $this->object->get()                        => 'zero',
            $this->object->get(64.23, 'en', true)       => 'sixty four dollars 23 cents',
            $this->object->get(764)                     => 'seven hundred sixty four',
            $this->object->get(2866)                    => 'two thousands eight hundred sixty six',
            $this->object->get(7700)                    => 'seven thousands seven hundred',
            $this->object->get('10,000')                => 'ten thousands',
            $this->object->get(14383)                   => 'fourteen thousands three hundred eighty three',
            $this->object->get(20383)                   => 'twenty thousands three hundred eighty three',
            $this->object->get(700383)                  => 'seven hundred thousands three hundred eighty three',
            $this->object->get(7644383)                 => 'seven million six hundred forty four thousands three hundred eighty three',
            $this->object->get(70043783.65, 'en', true) => 'seventy million forty three thousands seven hundred eighty three dollars 65 cents',
            $this->object->get(786443783)               => 'seven hundred eighty six million four hundred forty three thousands seven hundred eighty three',
            $this->object->get(109)                     => 'one hundred nine',
            $this->object->get(110)                     => 'one hundred ten',
            $this->object->get(111)                     => 'one hundred eleven',
            $this->object->get(112)                     => 'one hundred twelve',
            $this->object->get(115)                     => 'one hundred fifteen',
            $this->object->get(116)                     => 'one hundred sixteen',
            $this->object->get(118)                     => 'one hundred eighteen',
            $this->object->get(120)                     => 'one hundred twenty',
            $this->object->get(121)                     => 'one hundred twenty one',
            $this->object->get(10010)                   => 'ten thousands ten',
            $this->object->get(10110)                   => 'ten thousands one hundred ten',
            $this->object->get(510110)                  => 'five hundred ten thousands one hundred ten',
        ];

        $this->runTestDigits($result);
    }

    /**
     * Ukrainian localization testing.
     */
    public function testUk()
    {
        $result = [
            $this->object->get(0, 'uk')                 => 'нуль',
            $this->object->get(64.23, 'uk', true)       => 'шістдесят чотири грн 23 коп',
            $this->object->get(764, 'uk')               => 'сімсот шістдесят чотири',
            $this->object->get(2866, 'uk')              => 'дві тисячі вісімсот шістдесят шість',
            $this->object->get(7700, 'uk')              => 'сім тисяч сімсот',
            $this->object->get('10,000', 'uk')          => 'десять тисяч',
            $this->object->get(14383, 'uk')             => 'чотирнадцять тисячі триста вісімдесят три',
            $this->object->get(20383, 'uk')             => 'двадцять тисяч триста вісімдесят три',
            $this->object->get(700383, 'uk')            => 'сімсот тисяч триста вісімдесят три',
            $this->object->get(7644383, 'uk')           => 'сім мільйонів шістсот сорок чотири тисячі триста вісімдесят три',
            $this->object->get(70043783.65, 'uk', true) => 'сімдесят мільйонів сорок три тисячі сімсот вісімдесят три грн 65 коп',
            $this->object->get(786443783, 'uk')         => 'сімсот вісімдесят шість мільйонів чотириста сорок три тисячі сімсот вісімдесят три',
            $this->object->get(109, 'uk')               => 'сто дев\'ять',
            $this->object->get(110, 'uk')               => 'сто десять',
            $this->object->get(111, 'uk')               => 'сто одинадцять',
            $this->object->get(112, 'uk')               => 'сто дванадцять',
            $this->object->get(116, 'uk')               => 'сто шістнадцять',
            $this->object->get(118, 'uk')               => 'сто вісімнадцять',
            $this->object->get(120, 'uk')               => 'сто двадцять',
            $this->object->get(121, 'uk')               => 'сто двадцять один',
            $this->object->get(10010, 'uk')             => 'десять тисяч десять',
            $this->object->get(10110, 'uk')             => 'десять тисяч сто десять',
            $this->object->get(510110, 'uk')            => 'п\'ятсот десять тисяч сто десять',
        ];

        $this->runTestDigits($result);
    }

    /**
     * German localization testing.
     */
    public function testDe()
    {
        $result = [
            $this->object->get(null, 'de')              => 'null',
            $this->object->get(64.23, 'de', true)       => 'vierundsechzig Mark 23 Cent',
            $this->object->get(764, 'de')               => 'siebenhundertsechsundsechzig',
            $this->object->get(2866, 'de')              => 'zweitausendachthundertsechsundsechzig',
            $this->object->get(7700, 'de')              => 'siebentausendsiebenhundert',
            $this->object->get('10,000', 'de')          => 'zehntausend',
            $this->object->get(14383, 'de')             => 'vierzehntausenddreihundertsechsundachtzig',
            $this->object->get(20383, 'de')             => 'zwanzigtausenddreihundertsechsundachtzig',
            $this->object->get(700383, 'de')            => 'siebenhunderttausenddreihundertsechsundachtzig',
            $this->object->get(7644383, 'de')           => 'siebenmillionensechshundertvierundvierzigtausenddreihundertsechsundachtzig',
            $this->object->get(70043783.65, 'de', true) => 'siebzigmillionendreiundvierzigtausendsiebenhundertdreiundachtzig dollar 65 cents',
            $this->object->get(786443783, 'de')         => 'siebenhundertsechsundachtzigmillionenvierhundertdreiundvierzigtausendsiebenhundertdreiundachtzig',
            $this->object->get(109, 'de')               => 'einhundertneun',
            $this->object->get(110, 'de')               => 'einhundertzehn',
            $this->object->get(111, 'de')               => 'einhundertelf',
            $this->object->get(112, 'de')               => 'einhundertzwölf',
            $this->object->get(115, 'de')               => 'einhundertfünfzehn',
            $this->object->get(116, 'de')               => 'einhundertsechzehn',
            $this->object->get(118, 'de')               => 'einhundertachtzehn',
            $this->object->get(120, 'de')               => 'einhundertzwanzig',
            $this->object->get(121, 'de')               => 'einhunderteinundzwanzig',
            $this->object->get(10010, 'de')             => 'zehntausendzehn',
            $this->object->get(10110, 'de')             => 'zehntausendhundertzehn',
            $this->object->get(510110, 'de')            => 'fünfhundertzehntausendhundertzehn',
        ];

        $this->runTestDigits($result);
    }

    /**
     * Testing the translation of numbers to text equivalent.
     *
     * @param array $items
     */
    public function runTestDigits($items = [])
    {
        foreach ($items as $key => $result) {
            $this->assertEquals($result, $key);
        }
    }
}
