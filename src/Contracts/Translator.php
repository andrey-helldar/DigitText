<?php

namespace Helldar\DigitText\Contracts;

use Helldar\DigitText\Variables\DigitTextConstants;

class Translator
{
    protected $locale = null;

    protected function trans(string $key, array $replace = []): string
    {
        $key = DigitTextConstants::LANG . $key;

        return app('translator')
            ->trans($key, $replace, $this->locale);
    }

    protected function transChoice(string $key, int $number = 0, array $replace = []): string
    {
        $key = DigitTextConstants::LANG . $key;

        return app('translator')
            ->transChoice($key, $number, $replace, $this->locale);
    }
}
