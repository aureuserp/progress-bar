<?php

namespace Webkul\ProgressBar\Enums;

enum Size: string
{
    case Tiny = 'xs';
    case Small = 'sm';
    case Medium = 'md';
    case Large = 'lg';

    public static function default(): self
    {
        return self::Medium;
    }
}
