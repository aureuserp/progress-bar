<?php

namespace Webkul\ProgressBar\Infolists\Components;

use Closure;
use Filament\Infolists\Components\Entry;
use Webkul\ProgressBar\Concerns\HasProgressBarStyle;

class ProgressBar extends Entry
{
    use HasProgressBarStyle;

    protected string $view = 'progress-bar::infolists.progress-bar';

    protected string | Closure | null $colorCallback = null;

    public function color(string | Closure | null $color): static
    {
        $this->colorCallback = $color;

        return $this;
    }

    public function getColor($state = null): ?string
    {
        if ($this->colorCallback === null) {
            return null;
        }

        $resolved = $this->evaluate($this->colorCallback);

        return is_string($resolved) && $resolved !== '' ? $resolved : null;
    }
}
