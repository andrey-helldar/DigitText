<?php

namespace Helldar\DigitText\Tests;

use Helldar\DigitText\Services\DigitText;
use PHPUnit\Framework\TestCase;

class DigitTextTestService extends TestCase
{
    /**
     * @var DigitText
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
    }
}
