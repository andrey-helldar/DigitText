<?php

namespace Helldar\DigitText;

class DigitText
{
    private $texts = [
        '0' => 'ноль',
        '1' => 'один',
        '2' => 'два',
        '3' => 'три',
    ];

    /**
     *
     * @param type $digit
     * @return type
     */
    public function getText($digit = null)
    {
        if (is_null($digit)) {
            return $this->texts[0];
        }

        if ($digit > 0 && $digit < 10) {
            return $this->texts[$digit];
        }
    }
}
