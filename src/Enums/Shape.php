<?php

namespace Webkul\ProgressBar\Enums;

enum Shape: string
{
    case Rounded = 'rounded';
    case Pill = 'pill';
    case Square = 'square';

    public static function default(): self
    {
        return self::Rounded;
    }
}
