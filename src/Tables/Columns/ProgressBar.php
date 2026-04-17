<?php

namespace Webkul\ProgressBar\Tables\Columns;

use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\Concerns\HasColor;
use Webkul\ProgressBar\Concerns\HasProgressBarStyle;

class ProgressBar extends Column
{
    use HasColor {
        getColor as getBaseColor;
    }

    use HasProgressBarStyle;

    protected string $view = 'progress-bar::columns.progress-bar';
}
