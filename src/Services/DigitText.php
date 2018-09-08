<?php

namespace Helldar\DigitText\Services;

use Helldar\DigitText\Contracts\Translator;
use Helldar\DigitText\Traits\Initialize;
use Helldar\DigitText\Variables\DigitTextConstants;

class DigitText extends Translator
{
    use Initialize;

    private $is_currency = false;

    public function get(float $number = 0.0, string $locale = null, bool $is_currency = false): string
    {
        $this->locale      = $locale;
        $this->is_currency = $is_currency;

        if (!$number) {
            return $this->getNull();
        }

        return $this->getNumber($number);
    }

    private function getNull(): string
    {
        if ($this->is_currency) {
            $text   = $this->trans('lang.digits.zero');
            $suffix = '00 ' . $this->trans('lang.currency.floor');

            return $this->currencyBeforeOrAfter($text, $suffix);
        }

        return $this->trans('lang.digits.zero');
    }

    private function getNumber(float $number = 0.0): string
    {
        $integer = (int) $number;
        $floor   = floor($number);

        if ($result = $this->getNumberSimple($integer, $floor)) {
            return $result;
        }

        $group = $this->getFixedGroup($integer);

        for ($g = 0; $g < sizeof($group); $g++) {
            $sub_group  = str_split((string) $group[$g]);
            $sub_result = [];

            for ($i = 0; $i < sizeof($sub_group); $i++) {
                $text = $this->trans("lang.digits.{$g}.{$i}");

                array_unshift($sub_result, $text);
            }

            $group_suffix = $this->transChoice('lang.categories.' . $g, (int) $group[$g]);
            array_push($sub_result, $group_suffix);
        }

        $result = implode(' ', $sub_result);

        if ($this->is_currency) {
            $suffix = implode(' ', [
                $this->fixFloor($floor),
                $this->trans('lang.currency.floor'),
            ]);

            return $this->currencyBeforeOrAfter($result, $suffix);
        }

        return $result;
    }

    private function getNumberSimple(int $integer = 0, int $floor = 0): ?string
    {
        if ($integer >= 1 && $integer <= 19) {
            $text = $this->trans('lang.digits.0.' . $integer);

            if ($this->is_currency) {
                $suffix = implode(' ', [
                    $this->fixFloor($floor),
                    $this->trans('lang.currency.floor'),
                ]);

                return $this->currencyBeforeOrAfter($text, $suffix);
            }

            return $text;
        }

        return null;
    }

    private function reverse(int $number = 0, bool $is_force = false): string
    {
        if ($is_force || $this->trans('lang.settings.is_reverse')) {
            return strrev((string) $number);
        }

        return (string) $number;
    }

    private function group(string $number): array
    {
        return str_split($number, 3);
    }

    private function getFixedGroup(int $integer = 0): array
    {
        $reversed = $this->reverse($integer, true);
        $grouped  = $this->group($reversed);

        return array_map(function ($group) {
            return $this->reverse((int) $group, true);
        }, $grouped);
    }

    private function currencyBeforeOrAfter(string $text, string $suffix = null): string
    {
        if ($this->trans('lang.currency.position') === 'after') {
            $result = [$text, $this->trans('lang.currency.integer'), $suffix];
        } else {
            $result = [$this->trans('lang.currency.integer'), $text, $suffix];
        }

        return implode(' ', array_filter($result));
    }

    private function fixFloor(int $floor = 0): string
    {
        return str_pad((string) $floor, DigitTextConstants::PRECISION, '0', STR_PAD_RIGHT);
    }
}
