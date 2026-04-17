<?php

use Filament\Infolists\Components\Entry;
use Webkul\ProgressBar\Infolists\Components\ProgressBar;

it('can be instantiated via make()', function () {
    expect(ProgressBar::make('progress'))->toBeInstanceOf(ProgressBar::class);
});

it('extends Filament Entry', function () {
    expect(ProgressBar::make('progress'))->toBeInstanceOf(Entry::class);
});

it('uses the expected infolist view path', function () {
    $entry = ProgressBar::make('progress');

    $reflection = new ReflectionProperty($entry, 'view');
    $reflection->setAccessible(true);

    expect($reflection->getValue($entry))->toBe('progress-bar::infolists.progress-bar');
});

it('color() stores and returns the callback result', function () {
    $entry = ProgressBar::make('progress')->color('warning');

    expect($entry->getColor())->toBe('warning');
});

it('color() accepts a closure', function () {
    $entry = ProgressBar::make('progress')->color(fn () => 'success');

    expect($entry->getColor())->toBe('success');
});

it('color() returns null when unset', function () {
    expect(ProgressBar::make('progress')->getColor())->toBeNull();
});
