<?php

namespace Webkul\ProgressBar\Tests\Feature\Fixtures;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum SampleLevel: int implements HasLabel, HasColor
{
    case Beginner = 20;
    case Intermediate = 50;
    case Advanced = 80;
    case Expert = 100;

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Beginner => 'Beginner',
            self::Intermediate => 'Intermediate',
            self::Advanced => 'Advanced',
            self::Expert => 'Expert',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Beginner => 'danger',
            self::Intermediate => 'warning',
            self::Advanced => 'info',
            self::Expert => 'success',
        };
    }
}
