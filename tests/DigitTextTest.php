<?php

namespace Helldar\DigitText\Tests;

use Helldar\DigitText\DigitText;
use PHPUnit\Framework\TestCase;

class DigitTextTest extends TestCase
{
    /**
     * @var DigitText
     */
    protected $service;

    public function __construct()
    {
        $this->service = (new DigitText());

        parent::__construct();
    }

    /**
     * Russian localization testing.
     */
    public function testRu()
    {
        $this->assertEquals($this->service->get(0, 'ru'), 'ноль');
        $this->assertEquals($this->service->get(64.23, 'ru', true), 'шестьдесят четыре руб 23 коп');
        $this->assertEquals($this->service->get(764, 'ru'), 'семьсот шестьдесят четыре');
        $this->assertEquals($this->service->get(2866, 'ru'), 'две тысячи восемьсот шестьдесят шесть');
        $this->assertEquals($this->service->get(7700, 'ru'), 'семь тысяч семьсот');
        $this->assertEquals($this->service->get('10,000', 'ru'), 'десять тысяч');
        $this->assertEquals($this->service->get(14383, 'ru'), 'четырнадцать тысячи триста восемьдесят три');
        $this->assertEquals($this->service->get(20383, 'ru'), 'двадцать тысяч триста восемьдесят три');
        $this->assertEquals($this->service->get(700383, 'ru'), 'семьсот тысяч триста восемьдесят три');
        $this->assertEquals($this->service->get(7644383, 'ru'), 'семь миллионов шестьсот сорок четыре тысячи триста восемьдесят три');
        $this->assertEquals($this->service->get(70043783.65, 'ru', true), 'семьдесят миллионов сорок три тысячи семьсот восемьдесят три руб 65 коп');
        $this->assertEquals($this->service->get(786443783, 'ru'), 'семьсот восемьдесят шесть миллионов четыреста сорок три тысячи семьсот восемьдесят три');
        $this->assertEquals($this->service->get(109, 'ru'), 'сто девять');
        $this->assertEquals($this->service->get(110, 'ru'), 'сто десять');
        $this->assertEquals($this->service->get(111, 'ru'), 'сто одиннадцать');
        $this->assertEquals($this->service->get(112, 'ru'), 'сто двенадцать');
        $this->assertEquals($this->service->get(116, 'ru'), 'сто шестнадцать');
        $this->assertEquals($this->service->get(120, 'ru'), 'сто двадцать');
        $this->assertEquals($this->service->get(121, 'ru'), 'сто двадцать один');
        $this->assertEquals($this->service->get(10010, 'ru'), 'десять тысяч десять');
        $this->assertEquals($this->service->get(10110, 'ru'), 'десять тысяч сто десять');
        $this->assertEquals($this->service->get(510110, 'ru'), 'пятьсот десять тысяч сто десять');
    }

    /**
     * English localization testing.
     */
    public function testEn()
    {
        $this->assertEquals($this->service->get(), 'zero');
        $this->assertEquals($this->service->get(64.23, 'en', true), 'sixty four dollars 23 cents');
        $this->assertEquals($this->service->get(764), 'seven hundred sixty four');
        $this->assertEquals($this->service->get(2866), 'two thousands eight hundred sixty six');
        $this->assertEquals($this->service->get(7700), 'seven thousands seven hundred');
        $this->assertEquals($this->service->get('10,000'), 'ten thousands');
        $this->assertEquals($this->service->get(14383), 'fourteen thousands three hundred eighty three');
        $this->assertEquals($this->service->get(20383), 'twenty thousands three hundred eighty three');
        $this->assertEquals($this->service->get(700383), 'seven hundred thousands three hundred eighty three');
        $this->assertEquals($this->service->get(7644383), 'seven million six hundred forty four thousands three hundred eighty three');
        $this->assertEquals($this->service->get(70043783.65, 'en', true), 'seventy million forty three thousands seven hundred eighty three dollars 65 cents');
        $this->assertEquals($this->service->get(786443783), 'seven hundred eighty six million four hundred forty three thousands seven hundred eighty three');
        $this->assertEquals($this->service->get(109), 'one hundred nine');
        $this->assertEquals($this->service->get(110), 'one hundred ten');
        $this->assertEquals($this->service->get(111), 'one hundred eleven');
        $this->assertEquals($this->service->get(112), 'one hundred twelve');
        $this->assertEquals($this->service->get(115), 'one hundred fifteen');
        $this->assertEquals($this->service->get(116), 'one hundred sixteen');
        $this->assertEquals($this->service->get(120), 'one hundred twenty');
        $this->assertEquals($this->service->get(121), 'one hundred twenty one');
        $this->assertEquals($this->service->get(10010), 'ten thousands ten');
        $this->assertEquals($this->service->get(10110), 'ten thousands one hundred ten');
        $this->assertEquals($this->service->get(510110), 'five hundred ten thousands one hundred ten');
    }

    /**
     * Ukrainian localization testing.
     */
    public function testUk()
    {
        $this->assertEquals($this->service->get(0, 'uk'), 'нуль');
        $this->assertEquals($this->service->get(64.23, 'uk', true), 'шістдесят чотири грн 23 коп');
        $this->assertEquals($this->service->get(764, 'uk'), 'сімсот шістдесят чотири');
        $this->assertEquals($this->service->get(2866, 'uk'), 'дві тисячі вісімсот шістдесят шість');
        $this->assertEquals($this->service->get(7700, 'uk'), 'сім тисяч сімсот');
        $this->assertEquals($this->service->get('10,000', 'uk'), 'десять тисяч');
        $this->assertEquals($this->service->get(14383, 'uk'), 'чотирнадцять тисячі триста вісімдесят три');
        $this->assertEquals($this->service->get(20383, 'uk'), 'двадцять тисяч триста вісімдесят три');
        $this->assertEquals($this->service->get(700383, 'uk'), 'сімсот тисяч триста вісімдесят три');
        $this->assertEquals($this->service->get(7644383, 'uk'), 'сім мільйонів шістсот сорок чотири тисячі триста вісімдесят три');
        $this->assertEquals($this->service->get(70043783.65, 'uk', true), 'сімдесят мільйонів сорок три тисячі сімсот вісімдесят три грн 65 коп');
        $this->assertEquals($this->service->get(786443783, 'uk'), 'сімсот вісімдесят шість мільйонів чотириста сорок три тисячі сімсот вісімдесят три');
        $this->assertEquals($this->service->get(109, 'uk'), 'сто дев\'ять');
        $this->assertEquals($this->service->get(110, 'uk'), 'сто десять');
        $this->assertEquals($this->service->get(111, 'uk'), 'сто одинадцять');
        $this->assertEquals($this->service->get(112, 'uk'), 'сто дванадцять');
        $this->assertEquals($this->service->get(116, 'uk'), 'сто шістнадцять');
        $this->assertEquals($this->service->get(120, 'uk'), 'сто двадцять');
        $this->assertEquals($this->service->get(121, 'uk'), 'сто двадцять один');
        $this->assertEquals($this->service->get(10010, 'uk'), 'десять тисяч десять');
        $this->assertEquals($this->service->get(10110, 'uk'), 'десять тисяч сто десять');
        $this->assertEquals($this->service->get(510110, 'uk'), 'п\'ятсот десять тисяч сто десять');
    }

    /**
     * German localization testing.
     */
    public function testDe()
    {
        $this->assertEquals($this->service->get(null, 'de'), 'null');
        $this->assertEquals($this->service->get(64.23, 'de', true), 'vierundsechzig Mark 23 сent');
        $this->assertEquals($this->service->get(764, 'de'), 'siebenhundertsechsundsechzig');
        $this->assertEquals($this->service->get(2866, 'de'), 'zweitausendachthundertsechsundsechzig');
        $this->assertEquals($this->service->get(7700, 'de'), 'siebentausendsiebenhundert');
        $this->assertEquals($this->service->get('10,000', 'de'), 'zehntausend');
        $this->assertEquals($this->service->get(14383, 'de'), 'vierzehntausenddreihundertsechsundachtzig');
        $this->assertEquals($this->service->get(20383, 'de'), 'zwanzigtausenddreihundertsechsundachtzig');
        $this->assertEquals($this->service->get(700383, 'de'), 'siebenhunderttausenddreihundertsechsundachtzig');
        $this->assertEquals($this->service->get(7644383, 'de'), 'siebenmillionensechshundertvierundvierzigtausenddreihundertsechsundachtzig');
        $this->assertEquals($this->service->get(70043783.65, 'de', true), 'siebzigmillionendreiundvierzigtausendsiebenhundertdreiundachtzig dollar 65 cents');
        $this->assertEquals($this->service->get(786443783, 'de'),
            'siebenhundertsechsundachtzigmillionenvierhundertdreiundvierzigtausendsiebenhundertdreiundachtzig');
        $this->assertEquals($this->service->get(109, 'de'), 'einhundertneun');
        $this->assertEquals($this->service->get(110, 'de'), 'einhundertzehn');
        $this->assertEquals($this->service->get(111, 'de'), 'einhundertelf');
        $this->assertEquals($this->service->get(112, 'de'), 'einhundertzwölf');
        $this->assertEquals($this->service->get(115, 'de'), 'einhundertfünfzehn');
        $this->assertEquals($this->service->get(116, 'de'), 'einhundertsechzehn');
        $this->assertEquals($this->service->get(120, 'de'), 'einhundertzwanzig');
        $this->assertEquals($this->service->get(121, 'de'), 'einhunderteinundzwanzig');
        $this->assertEquals($this->service->get(10010, 'de'), 'zehntausendzehn');
        $this->assertEquals($this->service->get(10110, 'de'), 'zehntausendhundertzehn');
        $this->assertEquals($this->service->get(510110, 'de'), 'fünfhundertzehntausendhundertzehn');
    }
}
