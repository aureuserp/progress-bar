<?php

namespace Webkul\ProgressBar\Enums;

enum IconPosition: string
{
    case Start = 'start';
    case End = 'end';

    public static function default(): self
    {
        return self::Start;
    }
}
