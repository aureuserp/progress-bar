<?php

use Webkul\ProgressBar\Infolists\Components\ProgressBar;

it('picks the matching threshold bucket for the current percentage', function () {
    $bar = ProgressBar::make('v')
        ->value(85)
        ->thresholds([
            80 => 'success',
            50 => 'warning',
            20 => 'info',
            0  => 'danger',
        ]);

    expect($bar->getResolvedColor())->toBe('success');
});

it('falls through to the next lower threshold when none matches exactly', function () {
    $bar = ProgressBar::make('v')
        ->value(55)
        ->thresholds([
            80 => 'success',
            50 => 'warning',
            20 => 'info',
            0  => 'danger',
        ]);

    expect($bar->getResolvedColor())->toBe('warning');
});

it('uses the lowest bucket as the ultimate fallback', function () {
    $bar = ProgressBar::make('v')
        ->value(5)
        ->thresholds([
            80 => 'success',
            50 => 'warning',
            20 => 'info',
            0  => 'danger',
        ]);

    expect($bar->getResolvedColor())->toBe('danger');
});

it('warnAbove() overrides thresholds when percentage exceeds the threshold', function () {
    $bar = ProgressBar::make('v')
        ->value(95)
        ->thresholds([0 => 'success'])
        ->warnAbove(90, 'danger');

    expect($bar->getResolvedColor())->toBe('danger');
});

it('warnAbove() does NOT fire below threshold', function () {
    $bar = ProgressBar::make('v')
        ->value(50)
        ->thresholds([0 => 'success'])
        ->warnAbove(90);

    expect($bar->getResolvedColor())->toBe('success');
});

it('falls back to primary when no threshold / warnAbove / color is set', function () {
    $bar = ProgressBar::make('v')->value(42);

    expect($bar->getResolvedColor())->toBe('primary');
});

it('trackColor() defaults to gray and can be overridden', function () {
    expect(ProgressBar::make('v')->getTrackColor())->toBe('gray');
    expect(ProgressBar::make('v')->trackColor('warning')->getTrackColor())->toBe('warning');
});
