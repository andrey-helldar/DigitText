<?php

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

    private $precision = 2;

    /**
     * @var bool
     */
    private $is_currency = false;

    /**
     * @var float
     */
    private $digit = null;

    /**
     * Showing a fractional number in a text equivalent.
     *
     * TODO: Incorrect translation into German when specifying a fractional number.
     *
     * @param float|string $digit
     * @param string $lang
     * @param bool $is_currency
     *
     * @return null|string
     */
    public function get($digit = 0.0, string $lang = 'en', bool $is_currency = false): ?string
    {
        $this->setLang($lang);
        $this->setCurrency($is_currency);
        $this->fixDigit($digit);

        if ($intl = $this->intl()) {
            return $intl;
        }

        $this->loadTexts();

        if ($this->digit == 0 && !$is_currency) {
            return $this->texts['zero'];
        }

        return $this->getResult();
    }

    /**
     * Set lang.
     *
     * @param string $lang
     */
    private function setLang(string $lang = 'en')
    {
        $filename   = $this->getLangFile($lang);
        $this->lang = file_exists($filename) ? $lang : $this->lang_fallback;
    }

    /**
     * Set currency.
     *
     * @param bool $is_currency
     */
    private function setCurrency(bool $is_currency = false)
    {
        $this->is_currency = $is_currency;
    }

    /**
     * @return string
     */
    private function getResult(): string
    {
        $result  = $this->getFractional();
        $divider = $this->lang === 'de' ? 'und' : ' ';

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
    private function getFractional(): array
    {
        $this->fraction();

        $groups = str_split($this->digitReverse((int) $this->digit), 3);
        $result = [];
        $count  = count($groups);
        for ($i = $count - 1; $i >= 0; $i--) {
            if ($i === $count - 1 || (int) $groups[$i] > 0) {
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
        if (!$digit) {
            $this->digit = 0;

            return;
        }

        $digit = str_replace([',', '-', ' ', "'", '`'], '', (string) $digit);

        if (strripos((string) $digit, '.') === false) {
            $this->digit = (double) $digit;

            return;
        }

        $digit       = explode('.', $digit);
        $this->digit = (double) sprintf('%s.%s', intval($digit[0]), $digit[1]);
    }

    /**
     * php_intl Loader.
     *
     * @return null|string
     */
    private function intl(): ?string
    {
        if ($this->is_currency && extension_loaded('php_intl')) {
            return (new \MessageFormatter($this->lang, '{n, spellout}'))
                ->format(['n' => $this->digit]);
        }

        return null;
    }

    /**
     * Loading localized data.
     */
    private function loadTexts()
    {
        $this->texts = require $this->getLangFile();
    }

    /**
     * Get the fractional part.
     *
     * @return void
     */
    private function fraction()
    {
        if (!$this->digit) {
            $this->surplus = 0;

            return;
        }

        $pos = strripos((string) $this->digit, '.');

        $this->surplus = ($pos === false ? 0 : mb_substr((string) $this->digit, $pos + 1));
    }

    /**
     * Reverse digits.
     *
     * @param string $digit
     *
     * @return string
     */
    private function digitReverse($digit = '0'): string
    {
        return strrev((string) $digit);
    }

    /**
     * The conversion of numbers in text.
     *
     * @param float $digit
     * @param int $id
     *
     * @return string
     */
    private function digits($digit = 0.0, $id = 0): string
    {
        if ($digit == 0) {
            return $this->texts['zero'];
        }

        return $this->compactDigits($digit, $id);
    }

    /**
     * The compact digits to text.
     *
     * @param float $digit
     * @param int $id
     *
     * @return string
     */
    private function compactDigits($digit = 0.0, $id = 0): string
    {
        $array  = str_split((string) $digit, 1);
        $result = [];

        for ($i = sizeof($array) - 1; $i >= 0; $i--) {
            if ($i === 1 && $array[$i] == '1') {
                $d = ($array[$i] . $array[$i - 1]);
                array_push($result, trim($this->texts[$id == 1 ? 3 : 0][(int) $d]));
                $i--;
            } elseif ((int) $array[$i] > 0) {
                array_push($result, $this->texts[$id == 1 ? $i + 3 : $i][$array[$i]]);
            }
        }

        $reversed = (int) $this->digitReverse($digit);
        $divider  = ($this->lang === 'de' ? 'und' : ' ');
        $result   = implode($divider, $result);

        return trim(trim($result) . $this->decline($id, $reversed));
    }

    /**
     * Declination of discharges.
     *
     * @param int $group
     * @param float $digit
     *
     * @return string
     */
    private function decline($group = 0, $digit = 0.0): string
    {
        $text    = (string) ((int) $digit);
        $text    = (int) $text[strlen($digit) - 1];
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
    private function getCurrency(string $content = null): string
    {
        if (!$content) {
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
                str_pad((string) $this->surplus, $this->precision, '0', STR_PAD_RIGHT),
                $this->texts['currency']['fraction'],
            ]);
        }

        return $result;
    }

    private function getLangFile(string $lang = null): string
    {
        return sprintf('%s/lang/%s.php', __DIR__, $lang ?: $this->lang);
    }
}
