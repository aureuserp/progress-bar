<?php

namespace Webkul\ProgressBar\Enums;

enum LabelPosition: string
{
    case Inside = 'inside';
    case Outside = 'outside';
    case None = 'none';

    public static function default(): self
    {
        return self::Inside;
    }
}
