<?php

namespace Helldar\DigitText\Services;

class DigitText
{
    private $lang = [];

    public function get($digit = 0.0, string $lang = 'en', bool $is_currency = false): string
    {
        $this->setLang($lang);

        $digit   = $this->reverseString((string) $digit);
        $grouped = $this->groupDigits($digit);
        $result  = [];

        for ($i = 0; $i < sizeof($grouped); $i++) {
            $text = $this->toText($grouped[$i], $i);

            array_push($result, $text);
        }

        die(json_encode($result));
    }

    private function groupDigits(string $digit): array
    {
        $digit = str_split((string) $digit, 3);
        $digit = $this->reverseArray($digit);

        return array_map(function ($value) {
            return $this->reverseString((string) $value);
        }, $digit);
    }

    private function reverseArray(array $array = [], $force_reverse = false): array
    {
        if ($force_reverse) {
            return array_reverse($array);
        }

        return $array;
    }

    private function reverseString(string $string): string
    {
        return strrev($string);
    }

    private function toText(string $digit, int $index = 0): string
    {
        $array  = str_split((string) $digit);
        $array  = $this->reverseArray($array, true);
        $result = [];

        for ($i = 0; $i < sizeof($array); $i++) {
            $number = $array[$i];
            $text   = $this->lang[$i][$number];

            array_push($result, trim($text));
        }

        $result = $this->reverseArray($result, true);

        array_push($result, $this->getSuffix($index, (int) $digit));

        return implode(' ', array_filter($result));
    }

    private function getSuffix(int $index = 0, int $number = 0): ?string
    {
        $decline = $this->decline($number);

        switch ($index) {
            case 1:
                return $this->lang['thousands'][$decline] ?? null;

            case 2:
                return $this->lang['millions'][$decline] ?? null;

            case 3:
                return $this->lang['billions'][$decline] ?? null;

            default:
                return null;
        }
    }

    private function decline(int $number = 0): int
    {
        $last_number = (int) ($number % 10);

        if (($number > 4 && $number < 21) || ($last_number >= 5 && $last_number <= 9)) {
            return 2;
        }

        if ($last_number >= 2 && $last_number <= 4) {
            return 1;
        }

        return 0;
    }

    private function setLang(string $lang = 'en')
    {
        $filename = $this->getLangFilename($lang);

        $this->lang = require $filename;
    }

    private function getLangFilename(string $lang = 'en'): string
    {
        $filename = sprintf('%s/../lang/%s.php', __DIR__, $lang);

        if (!file_exists($filename)) {
            return $this->getLangFilename();
        }

        return $filename;
    }
}
