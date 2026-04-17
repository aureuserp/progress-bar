<?php

use Webkul\ProgressBar\Infolists\Components\ProgressBar;

it('striped() defaults to false and toggles', function () {
    $bar = ProgressBar::make('v');

    expect($bar->isStriped())->toBeFalse();
    $bar->striped();
    expect($bar->isStriped())->toBeTrue();
    $bar->striped(false);
    expect($bar->isStriped())->toBeFalse();
});

it('animated() auto-enables striped', function () {
    $bar = ProgressBar::make('v')->animated();

    expect($bar->isAnimated())->toBeTrue();
    expect($bar->isStriped())->toBeTrue();
});

it('indeterminate() toggles', function () {
    $bar = ProgressBar::make('v');

    expect($bar->isIndeterminate())->toBeFalse();
    $bar->indeterminate();
    expect($bar->isIndeterminate())->toBeTrue();
});

it('gradient() toggles', function () {
    $bar = ProgressBar::make('v');

    expect($bar->isGradient())->toBeFalse();
    $bar->gradient();
    expect($bar->isGradient())->toBeTrue();
});

it('behaviour setters return static for chaining', function () {
    $bar = ProgressBar::make('v');

    expect($bar->striped())->toBe($bar);
    expect($bar->animated())->toBe($bar);
    expect($bar->indeterminate())->toBe($bar);
    expect($bar->gradient())->toBe($bar);
});
