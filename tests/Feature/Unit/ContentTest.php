<?php

use Webkul\ProgressBar\Enums\IconPosition;
use Webkul\ProgressBar\Infolists\Components\ProgressBar;

it('icon() stores an icon name and returns it', function () {
    $bar = ProgressBar::make('v')->icon('heroicon-m-check-circle');

    expect($bar->getBarIcon())->toBe('heroicon-m-check-circle');
});

it('icon() accepts a Closure', function () {
    $bar = ProgressBar::make('v')->icon(fn () => 'heroicon-m-sparkles');

    expect($bar->getBarIcon())->toBe('heroicon-m-sparkles');
});

it('returns null when no icon is configured', function () {
    expect(ProgressBar::make('v')->getBarIcon())->toBeNull();
});

it('iconPosition() defaults to start and accepts enum/string', function () {
    expect(ProgressBar::make('v')->getIconPosition())->toBe('start');
    expect(ProgressBar::make('v')->iconPosition(IconPosition::End)->getIconPosition())->toBe('end');
    expect(ProgressBar::make('v')->iconPosition('end')->getIconPosition())->toBe('end');
});

it('iconPosition() falls back to start for unknown values', function () {
    expect(ProgressBar::make('v')->iconPosition('middle')->getIconPosition())->toBe('start');
});

it('precision() affects label decimals', function () {
    $bar = ProgressBar::make('v')->value(33.3333)->precision(4);

    expect($bar->getFormattedLabel())->toBe('33.3333%');
});

it('formatLabel closure receives value/percentage/min/max', function () {
    $bar = ProgressBar::make('v')
        ->minValue(0)
        ->maxValue(200)
        ->value(50)
        ->formatLabel(fn ($value, $percentage, $min, $max) => "{$value}/{$max} = {$percentage}%");

    expect($bar->getFormattedLabel())->toBe('50/200 = 25%');
});
