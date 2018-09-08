<?php

namespace Helldar\DigitText\Tests;

use Helldar\DigitText\Services\DigitText;
use PHPUnit\Framework\TestCase;

class DigitTextTest extends TestCase
{
    /**
     * @var \Helldar\DigitText\Services\DigitText
     */
    protected $service;

    public function __construct()
    {
        $this->service = new DigitText;

        parent::__construct();
    }

    /**
     * Currency text testing.
     */
    public function testCurrency()
    {
        $this->assertEquals($this->service->get(2866, 'ru'), 'две тысячи восемьсот шестьдесят шесть');
        $this->assertEquals($this->service->get(64, 'ru', true), 'шестьдесят четыре руб 00 коп');
        $this->assertEquals($this->service->get(64.01, 'ru', true), 'шестьдесят четыре руб 01 коп');
        $this->assertEquals($this->service->get(64.10, 'ru', true), 'шестьдесят четыре руб 10 коп');
        $this->assertEquals($this->service->get(0, 'ru', true), 'ноль руб 00 коп');
        $this->assertEquals($this->service->get(0.01, 'ru', true), 'ноль руб 01 коп');
        $this->assertEquals($this->service->get(0.10, 'ru', true), 'ноль руб 10 коп');
    }
}
