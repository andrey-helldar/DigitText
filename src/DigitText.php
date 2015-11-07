<?php

namespace Helldar\DigitText;

class DigitText
{
    public function getText($digit = null)
    {
        if(is_null($digit)) {
            return $this->getArray(0);
        }

        if($digit > 0 && $digit < 10) {
            return $this->getArray($digit);
        }
    }

    private function getArray($digit = 0)
    {
        return [
            '0' => 'ноль',
            '1' => 'один',
            '2' => 'два',
            '3' => 'три',
        ];
    }

}
