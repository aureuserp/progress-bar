<?php

use Webkul\ProgressBar\Infolists\Components\ProgressBar;

it('defaults to min=0 and max=100', function () {
    $bar = ProgressBar::make('v');

    expect($bar->getMinValue())->toBe(0.0);
    expect($bar->getMaxValue())->toBe(100.0);
});

it('accepts min() and max() as scalars', function () {
    $bar = ProgressBar::make('v')->minValue(10)->maxValue(50);

    expect($bar->getMinValue())->toBe(10.0);
    expect($bar->getMaxValue())->toBe(50.0);
});

it('accepts min() and max() as closures', function () {
    $bar = ProgressBar::make('v')->minValue(fn () => 5)->maxValue(fn () => 25);

    expect($bar->getMinValue())->toBe(5.0);
    expect($bar->getMaxValue())->toBe(25.0);
});

it('uses ->value() override instead of getState()', function () {
    $bar = ProgressBar::make('v')->value(42);

    expect($bar->getCurrentValue())->toBe(42.0);
});

it('resolves numeric state from getState() when no value override', function () {
    $bar = ProgressBar::make('v')->state(73);

    expect($bar->getCurrentValue())->toBe(73.0);
});

it('treats non-numeric state as 0', function () {
    $bar = ProgressBar::make('v')->state('not a number');

    expect($bar->getCurrentValue())->toBe(0.0);
});

it('calculates percentage over min..max range', function () {
    $bar = ProgressBar::make('v')->minValue(0)->maxValue(100)->value(75);
    expect($bar->getPercentage())->toBe(75.0);

    $bar = ProgressBar::make('v')->minValue(0)->maxValue(200)->value(50);
    expect($bar->getPercentage())->toBe(25.0);

    $bar = ProgressBar::make('v')->minValue(10)->maxValue(20)->value(15);
    expect($bar->getPercentage())->toBe(50.0);
});

it('clamps percentage to 0..100', function () {
    $above = ProgressBar::make('v')->maxValue(10)->value(50);
    expect($above->getPercentage())->toBe(100.0);

    $below = ProgressBar::make('v')->minValue(10)->value(5);
    expect($below->getPercentage())->toBe(0.0);
});

it('returns 0 when min equals max (degenerate range)', function () {
    $bar = ProgressBar::make('v')->minValue(10)->maxValue(10)->value(10);

    expect($bar->getPercentage())->toBe(0.0);
});

it('isFull() is true only at 100%', function () {
    expect(ProgressBar::make('v')->value(99.5)->isFull())->toBeFalse();
    expect(ProgressBar::make('v')->value(100)->isFull())->toBeTrue();
    expect(ProgressBar::make('v')->value(150)->isFull())->toBeTrue();
});

it('getFormattedLabel() emits % with configured precision', function () {
    $bar = ProgressBar::make('v')->value(33)->precision(2);
    expect($bar->getFormattedLabel())->toBe('33.00%');

    $bar = ProgressBar::make('v')->value(33)->precision(0);
    expect($bar->getFormattedLabel())->toBe('33%');

    $bar = ProgressBar::make('v')->value(100)->precision(2);
    expect($bar->getFormattedLabel())->toBe('100%'); // always 0 decimals at 100
});

it('formatLabel() closure fully overrides the default label', function () {
    $bar = ProgressBar::make('v')
        ->value(42)
        ->formatLabel(fn ($value, $percentage, $min, $max) => "{$value} out of {$max}");

    expect($bar->getFormattedLabel())->toBe('42 out of 100');
});
