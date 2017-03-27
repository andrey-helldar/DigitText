<?php

namespace Helldar\DigitText;


class Facade
{
    /**
     * Facade for DigitText.
     *
     * @author Andrey Helldar <helldar@ai-rus.com>
     *
     * @since  2017-03-27
     *
     * @param null $digit
     *
     * @return string
     */
    public static function digit($digit = null)
    {
        return (new DigitText())->get($digit);
    }
}